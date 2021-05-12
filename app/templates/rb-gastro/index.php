<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.RB_GASTRO
 *
 * @copyright   Copyright (C) 2005 - 2021 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *  ADAPTADO A BOOTSTRAP 5
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$app = JFactory::getApplication();
$user = JFactory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option = $app->input->getCmd('option', '');
$view = $app->input->getCmd('view', '');
$layout = $app->input->getCmd('layout', '');
$task = $app->input->getCmd('task', '');
$itemid = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

if ($task === 'edit' || $layout === 'form') {
    $fullWidth = 1;
} else {
    $fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

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
// Add template js
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

//JHtml::_('script', 'templates/rb-gastro/scripts/libs/jquery.easing.js', array('version' => 'auto'));
JHtml::_('script', 'templates/rb-gastro/scripts/libs/isotope.pkgd.js', array('version' => 'auto'));
JHtml::_('script', 'templates/rb-gastro/scripts/libs/imagesloaded.pkgd.js', array('version' => 'auto'));
JHtml::_('script', 'templates/rb-gastro/scripts/libs/jssocials.js', array('version' => 'auto'));
//JHtml::_('script', 'templates/rb-gastro/scripts/libs/cookieconsent.min.js', array('version' => 'auto'));
JHtml::_('script', 'templates/rb-gastro/scripts/main.js', array('version' => 'auto'));
JHtml::_('script', 'templates/rb-gastro/scripts/libs/scrollspy.js', array('version' => 'auto'));

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
//JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));
//JHtml::_('stylesheet', 'templates/rb-gastro/styles/frontedit.css', array('version' => 'auto'));
JHtml::_('stylesheet', 'templates/rb-gastro/styles/site.css', array('version' => 'auto'));

// Use of Google Font
if ($this->params->get('googleFont')) {
    $font = $this->params->get('googleFontName');

    // Handle fonts with selected weights and styles, e.g. Source+Sans+Condensed:400,400i
    $fontStyle = str_replace('+', ' ', strstr($font, ':', true) ?: $font);

    JHtml::_('stylesheet', 'https://fonts.googleapis.com/css?family=' . $font);
    $this->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . $fontStyle . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor')) {
    $this->addStyleDeclaration('
	body.site {
		border-top: 3px solid ' . $this->params->get('templateColor') . ';
		background-color: ' . $this->params->get('templateBackgroundColor') . ';
	}
	a {
		color: ' . $this->params->get('templateColor') . ';
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: ' . $this->params->get('templateColor') . ';
	}');
}

// Check for a custom CSS file
JHtml::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));

// Check for a custom js file
JHtml::_('script', 'user.js', array('version' => 'auto', 'relative' => true));

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
$position7ModuleCount = $this->countModules('position-7');
$position8ModuleCount = $this->countModules('position-8');

if ($position7ModuleCount && $position8ModuleCount) {
    $span = 'span6';
} elseif ($position7ModuleCount && !$position8ModuleCount) {
    $span = 'span9';
} elseif (!$position7ModuleCount && $position8ModuleCount) {
    $span = 'span9';
} else {
    $span = 'span12';
}

// Logo file or site title param
if ($this->params->get('logoFile')) {
    $logo = '<img src="' . htmlspecialchars(JUri::root() . $this->params->get('logoFile'), ENT_QUOTES) . '" alt="' . $sitename . '" />';
} elseif ($this->params->get('sitetitle')) {
    $logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
} else {
    $logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<jdoc:include type="head" />
	</head>
	<body data-target="mainmenu" class="site <?php echo $option
		. ' view-' . $view
		. ($layout ? ' layout-' . $layout : ' no-layout')
		. ($task ? ' task-' . $task : ' no-task')
		. ($itemid ? ' itemid-' . $itemid : '')
		. ($params->get('fluidContainer') ? ' fluid' : '')
		. ($this->direction === 'rtl' ? ' rtl' : '');
	?>">
		<!-- Body -->
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<!--Header-->
			<header id="header" class="header" role="banner">
				<div id="quick-info" class="quick-info">
					<div id="contacto" class="panel">
						<div class="btn-close">
							<span></span>
							<span></span>
						</div>
						<?php if ($this->countModules('quick-info')): ?>
						<jdoc:include type="modules" name="quick-info" style="none" />
						<?php endif;?>
					</div>
				</div>
				<div class="header-content">
					<a class="brand" href="<?php echo $this->baseurl; ?>/">
						<?php echo $logo; ?>
						<?php if ($this->params->get('sitedescription')): ?>
							<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription')) . '</div>'; ?>
						<?php endif;?>
					</a>
					<nav id="mainmenu" class="mainmenu">
					<?php if ($this->countModules('mainmenu')): ?>
						<jdoc:include type="modules" name="mainmenu" style="none" />
						<?php endif;?>
					</nav>
				</div>
			</header>
			<!--Slider-->
			<div id="slider-intro" class="owl-carousel">
				<jdoc:include type="modules" name="slider-intro" style="xhtml" />
			</div>
			<jdoc:include type="modules" name="banner" style="xhtml" />
			<div class="row-fluid" data-bs-spy="scroll" data-bs-target="#mainmenu" data-bs-offset="0" tabindex="0">
				<?php if ($position8ModuleCount): ?>
				<!-- Begin Sidebar -->
				<div id="sidebar" class="span3">
					<div class="sidebar-nav">
						<jdoc:include type="modules" name="position-8" style="xhtml" />
					</div>
				</div>
			<!-- End Sidebar -->
			<?php endif;?>
			<main id="content" role="main" class="<?php echo $span; ?>">
				<!-- Begin Content -->
				<jdoc:include type="modules" name="main-top" style="xhtml" />
				<jdoc:include type="message" />
				<jdoc:include type="component" />
				<div class="clearfix"></div>
				<jdoc:include type="modules" name="position-2" style="none" />
				<jdoc:include type="modules" name="main-bottom" style="xhtml" />
				<!-- End Content -->
			</main>
			<?php if ($position7ModuleCount): ?>
			<div id="aside" class="span3">
				<!-- Begin Right Sidebar -->
				<jdoc:include type="modules" name="position-7" style="well" />
				<!-- End Right Sidebar -->
			</div>
			<?php endif;?>
			</div>
		</div>
		<!-- Footer -->
		<footer class="footer" role="contentinfo">
			<button href="#top" id="back-top" class="btn-totop">
				<span></span>
				<span></span>
			</button>
			<div class="footermenu">
				<div class="legalmenu">
					<jdoc:include type="modules" name="legalmenu" style="none" />
				</div>
				<div class="usermenu">
					<jdoc:include type="modules" name="footer" style="none" />
				</div>
			</div>
			<div class="lastline">
				<div class="copyright">&copy;<?php echo date("Y") ?> <?php echo $sitename; ?> · </div>
				<div class="credito">Desarrollo <a href="https://riobabel.com" target="_blank"> Río Babel</a></div>
			</div>
		</footer>
		<jdoc:include type="modules" name="debug" style="none" />
		<div id="flying" class="floater_banner">
			<jdoc:include type="modules" name="flying" style="none" />
		</div>
	</body>
</html>
