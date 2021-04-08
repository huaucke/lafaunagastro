<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.H-INTI
 *
 * @copyright   Copyright (C) 2005 - 2017 HUAUCKE, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}
$doc = JFactory::getDocument();

$headData = $doc->getHeadData();
$scripts = $headData['scripts'];

//scripts to remove, customise as required

unset($scripts[JUri::root(true) . '/media/system/js/mootools-core.js']);
unset($scripts[JUri::root(true) . '/media/system/js/mootools-more.js']);
unset($scripts[JUri::root(true) . '/media/system/js/core.js']);
unset($scripts[JUri::root(true) . '/media/system/js/modal.js']);
unset($scripts[JUri::root(true) . '/media/system/js/caption.js']);
unset($scripts[JUri::root(true) . '/media/jui/js/jquery.min.js']);
unset($scripts[JUri::root(true) . '/media/jui/js/jquery-noconflict.js']);
unset($scripts[JUri::root(true) . '/media/jui/js/bootstrap.min.js']);
unset($scripts[JUri::root(true) . '/media/jui/js/jquery-migrate.min.js']);

$headData['scripts'] = $scripts;
$doc->setHeadData($headData);
// Add JavaScript Frameworks
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/jquery.js');
//$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/bootstrap.js');
//$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/pace.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/cookieconsent.min.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/jssocials.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/owl.carousel.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/jquery.lazyload.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/modernizr.custom.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/jquery.easing.js');

$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/jquery.sticky.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/jquery.slimscroll.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/isotope.pkgd.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/imagesloaded.pkgd.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/infinite-scroll.pkgd.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/video.min.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/jquery.textillate.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/Youtube.min.js');
/*


$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/youtubefeed.js');

$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/blueimp-gallery.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/libs/jquery.blueimp-gallery.js');*/


$doc->addScript($this->baseurl . '/templates/' . $this->template . '/scripts/main.js');

// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/styles/site.css');

// Load optional RTL Bootstrap CSS
//JHtml::_('bootstrap.loadCss', false, $this->direction);

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img class="logo" src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<jdoc:include type="head" />
	<link rel="apple-touch-icon" sizes="57x57" href="images/favicons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="images/favicons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/favicons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="images/favicons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/favicons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="images/favicons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/favicons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="images/favicons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="images/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="images/favicons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/favicons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicons/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="images/favicons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<?php // Use of Google Font ?>
	<?php if ($this->params->get('googleFont')) : ?>
		<link href='https://fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName'); ?>' rel='stylesheet' type='text/css' />
	<?php endif; ?>
	<!--[if lt IE 9]>
		<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->

</head>

<body data-target="mainmenu">
	<!--Header-->
	<header id="header" class="header" role="banner">
		<div id="quick-info" class="quick-info">
			<?php if ($this->countModules('quick-info')) : ?>
			<jdoc:include type="modules" name="quick-info" style="none" />
			<?php endif; ?>
		</div>
		<div class="header-content">
<!--		<nav class="navbar  navbar-light bg-light header-content">-->
			<nav class="navbar navbar-expand-md">
				<a class="brand" href="<?php echo $this->baseurl; ?>/">
					<?php echo $logo; ?>
					<?php if ($this->params->get('sitedescription')) : ?>
						<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription')) . '</div>'; ?>
					<?php endif; ?>
				</a>
				<button class="navbar-toggler btn-togglemenu" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Toggle navigation">
					<span></span>
					<span></span>
					<span></span>
				</button>
				
				<?php if ($this->countModules('mainmenu')) : ?>
					<div id="mainmenu" class="mainmenu navbar-collapse collapse">
						<jdoc:include type="modules" name="mainmenu" style="none" />
					</div>
				<?php endif; ?>
			</nav>
		</div>
	</header>	
	<!--Search-->
	<jdoc:include type="modules" name="search" style="none" />
	<main id="content" class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?> <?php echo $option
		. ' view-' . $view
		. ($layout ? ' layout-' . $layout : ' no-layout')
		. ($task ? ' task-' . $task : ' no-task')
		. ($itemid ? ' itemid-' . $itemid : '')
		. ($params->get('fluidContainer') ? ' fluid' : '');
		?>">
		<!--Slider-->
		<div id="slider-intro" class="owl-carousel">
			<jdoc:include type="modules" name="slider-intro" style="xhtml" />
		</div>
		<!-- Content -->
		<jdoc:include type="modules" name="img-intro" style="xhtml" />
		<jdoc:include type="modules" name="main-top" style="xhtml" />
		<jdoc:include type="modules" name="menu-sticky" style="none" />
		<jdoc:include type="modules" name="submenu" style="xhtml" />
		<!-- Begin Content -->
		<jdoc:include type="message" />
		<jdoc:include type="component" />
		<!-- End Content -->
		<jdoc:include type="modules" name="main-bottom" style="none" />
	</main>
	<footer class="footer">
		<div class="content">
			<jdoc:include type="modules" name="breadcrumb" style="none" />
			<jdoc:include type="modules" name="footer" style="xhtml" />
			<div class="footermenu" role="complementary">
			<?php if ($this->countModules('footer-cols')) : ?>
				<jdoc:include type="modules" name="footer-cols" style="none" />
			<?php endif; ?>
			</div>
		</div>
	<div class="copyright">&copy; <?php echo date("Y") ?> <?php echo $sitename; ?>. <?php echo JText::_('COPYRIGHT_CONTENT_FOOTER'); ?>
		<?php if ($this->countModules('legalmenu')) : ?>
		<jdoc:include type="modules" name="legalmenu" style="none" />
		<?php endif; ?>
	</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
	
	<div id="flying" class="floater_banner">
		<jdoc:include type="modules" name="flying" style="none" />
		<button id="back-top" class="btn-totop" href="#content">
			<span></span>
			<span></span>
		</button>
	</div>
	
	<jdoc:include type="modules" name="hidden" style="none" />
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-header">
				<button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-content"></div>
		</div>
	</div>
	<!-- Modal
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
			</div>
		</div>
	</div> -->
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122973524-1"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-122973524-1');
		</script>
	</body>
</html>
