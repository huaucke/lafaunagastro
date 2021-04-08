var gulp = require('gulp');
var gulpLoadPlugins = require('gulp-load-plugins');
var browserSync = require('browser-sync');
var del = require('del');
var php = require('gulp-connect-php7');
var runSequence = require('run-sequence');

const $ = gulpLoadPlugins();
const reload = browserSync.reload;

var paths = {
    virtualPathName: "app/templates/rb-lafauna/"  
};

function lint(files, options) {
    return () => {
        return gulp.src(files)
            .pipe(reload({ stream: true, once: true }))
            //.pipe($.jshint());
    };
}

function errorHandler(err) {
    $.util.log(
        $.util.colors.red('Unhandled Error - ') + $.util.colors.cyan(err.plugin + '\n'),
        err.toString()
    );
    this.emit('end');
} lint

gulp.task('watch', function () {
    console.log('watch')
    gulp.watch('app/templates/rb-lafauna/styles/less/*.less', ['styles']);
});

gulp.task('lint', lint('app/templates/rb-lafauna/scripts/template.js'));

gulp.task('styles', () => {
    return gulp.src('app/templates/rb-lafauna/styles/less/site.less')
        .pipe($.plumber({
            errorHandler: errorHandler
        }))
        .pipe($.sourcemaps.init())
        .pipe($.less({
            paths: ['.']
        }))
        .pipe($.autoprefixer({
            browsers: ['last 5 version']
        }))
        .pipe($.sourcemaps.write('./', {
            includeContent: false,
            sourceRoot: '/src'
        }))
        .pipe(gulp.dest('app/templates/rb-lafauna/styles'))
        .pipe($.size({
            showFiles: true
        }))
        .pipe(reload({
            stream: true
        }));
});

gulp.task('min', ["min:assets", "min:images"]);

gulp.task('min:styles', function () {
    return gulp.src('app/templates/rb-lafauna/styles/site.css')
        .pipe($.minifyCss({ compatibility: '*' }))
        .pipe($.size({ showFiles: true }))
        .pipe($.rename({ suffix: '.min' }))
        .pipe(gulp.dest('app/templates/rb-lafauna/styles'));
});

gulp.task('min:images', function () {
    return gulp.src('app/templates/rb-lafauna/img/**/*', { base: 'app/templates/rb-lafauna/img' })
    .pipe(
        $.if(
            $.if.isFile,
            $.cache(
                $.imagemin({
                    progressive: true,
                    interlaced: true,
                    // don't remove IDs from SVGs, they are often used as hooks for embedding and styling
                    svgoPlugins: [{ cleanupIDs: false }]
                })
            )
        )
        )
        .pipe($.size({ showFiles: true }))
        .pipe(gulp.dest('build/templates/rb-lafauna/img'));
});


gulp.task('extras', () => {
    return gulp.src([
        'app/*.*',
        'app/templates/rb-lafauna/fonts/*.*',
        'app/templates/rb-lafauna/images/**/*',
        '!app/*.html'
    ], {
            dot: true,
            base: 'app'
        })
        .pipe($.size({ showFiles: true }))
        .pipe(gulp.dest('build'));
});

gulp.task('clean', del.bind(null, ['build']));

gulp.task('php:app', function() {
    php.server({ base: 'app', port: 8013, keepalive: true});
});

gulp.task('php:build', function() {
    php.server({ base: 'build', port: 8011, keepalive: true});
});

gulp.task('build',function(done) {
    runSequence('styles','lint', function () {
        done();
    });
});
/*
gulp.task('serve', ['build','watch'], function(done) {
    browserSync({
        port: 9000,
        notify: true,
        server: {
			baseDir: ['app'],
			routes: {

			}
		}
    });
*/
gulp.task('serve', ['build','watch'], (done) => {
    browserSync({
        port: 9002,
        notify: true,                          
        proxy: 'lafaunagastro.local',
    });
    gulp.watch([
        'app/templates/rb-lafauna/**/*.php',
        'app/templates/rb-lafauna/**/*.html',
        'app/templates/rb-lafauna/scripts/**/*.js',
        'app/templates/rb-lafauna/styles/**/*.css',
        'app/templates/rb-lafauna/images/**/*',
        'app/templates/rb-lafauna/fonts/**/*'
    ]).on('change', reload);
    gulp.watch('app/templates/rb-lafauna/styles/less/**/*', function () {
        gulp.run('styles');
    });
});

gulp.task('serve:deploy', ['deploy','php:build'],function(done) {
    browserSync({
        notify: false,
	    proxy: '127.0.0.1:8011',
        port: 9001,
        server: {
            baseDir: ['build']
        }
    }, done);
});


gulp.task('deploy', (done) => {
    runSequence('build', ['min', 'extras'], function () {
        done();
    });
});