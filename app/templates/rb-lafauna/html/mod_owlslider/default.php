<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="slide <?php if ($params->get('backgroundimage')) : ?>owl-lazy<?php endif;?>"
	<?php if ($params->get('backgroundimage')) : ?>
		data-src="<?php echo JUri::root(true)."/".str_replace(" ","%20",$params->get('backgroundimage'));?>"
	<?php endif;?>
    >
	<div class="content-slide">
		<?php echo $module->content;?>
    </div>
</div>