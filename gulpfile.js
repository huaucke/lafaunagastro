var gulp = require('gulp');
var gulpLoadPlugins = require('gulp-load-plugins');
var browserSync = require('browser-sync');
var del = require('del');
var php = require('gulp-connect-php7');
var eventStream = require('event-stream');
var runSequence = require('run-sequence');
var autoprefixer = require('autoprefixer');

const $ = gulpLoadPlugins();
const reload = browserSync.reload;

var paths = {
    virtualPathName: "app/templates/rb-gastro/"  
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
    gulp.watch('app/**/*.scss', ['styles']);
});

gulp.task('lint', lint('' + paths.virtualPathName + 'scripts/template.js'));

gulp.task('styles', () => {    
    return compileSass(paths.virtualPathName + 'styles/scss/site.scss',paths.virtualPathName  + 'styles');
});

function compileSass(src, dest) {
    $.util.log("compiling sass from " + src + " to " + dest);
    return gulp.src(src)
        .pipe($.plumber({ errorHandler: errorHandler }))
        .pipe($.sourcemaps.init())
        .pipe($.sass({ paths: ['.'] }))
        .pipe($.postcss([autoprefixer()]))
        .pipe($.sourcemaps.write('./', { includeContent: false, sourceRoot: '.' }))
        .pipe($.size({ showFiles: true }))
        .pipe(gulp.dest(dest));
}

gulp.task('min', ["min:assets", "min:images"]);

gulp.task('min:assets', function () {
    const assets = $.useref.assets({ searchPath: ['app', '.'] });
    return gulp.src('app/*.html')
        .pipe(assets)
        .pipe($.if('*.js', $.uglify()))
        .pipe($.if('*.css', $.minifyCss({ compatibility: '*' })))
        .pipe(assets.restore())
        .pipe($.useref())
        .pipe($.if('*.html', $.minifyHtml({ conditionals: true, loose: true })))
        .pipe($.size({ showFiles: true }))
        .pipe(gulp.dest('build'));
});

gulp.task('min:images', function () {
    return gulp.src('' + paths.virtualPathName + 'img/**/*', { base: '' + paths.virtualPathName + 'img' })
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
        .pipe(gulp.dest('' + paths.virtualPathName + 'img-min'));
});


gulp.task('extras', () => {
    return gulp.src([
        'app/*.*',
        '' + paths.virtualPathName + 'fonts/*.*',
        '' + paths.virtualPathName + 'images/**/*',
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
        port: 9000,
        notify: true,
        proxy: 'lafaunagastro.local',
    });
    gulp.watch([
        paths.virtualPathName + '**/*.php',
        paths.virtualPathName + '**/*.html',
        paths.virtualPathName + '**/*.js',
        paths.virtualPathName + '**/*.css',
        paths.virtualPathName + 'images/**/*',
        paths.virtualPathName + 'fonts/**/*'
    ]).on('change', reload);    
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


gulp.task('deploy', ['clean'], (done) => {
    runSequence('build', ['min', 'extras'], function () {
        done();
    });
});