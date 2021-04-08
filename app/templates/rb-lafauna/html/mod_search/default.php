<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Including fallback code for the placeholder attribute in the search field.
//JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

if ($width)
{
	$moduleclass_sfx .= ' ' . 'mod_search' . $module->id;
	$css = 'div.mod_search' . $module->id . ' input[type="search"]{ width:auto; }';
	JFactory::getDocument()->addStyleDeclaration($css);
	$width = ' size="' . $width . '"';
}
else
{
	$width = '';
}
?>
<div id="mod-finder" class="mod-finder search<?php echo $moduleclass_sfx; ?>">
	<div class="finder-content">
		<button class="btn-close">
			<span></span>
			<span></span>
		</button
		<div class="buscador">
		<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form">
			<?php
				$output = '<label for="mod-search-searchword' . $module->id . '" class="sr-only">' . $label . '</label> ';
				$output .= '<input name="searchword" id="mod-search-searchword' . $module->id . '" maxlength="' . $maxlength . '"  class="inputbox search-query input-medium" type="search"' . $width;
				$output .= ' placeholder="' . $text . '" />';
				if ($button) :
					if ($imagebutton) :
						$btn_output = ' <button class="btn-search" onclick="this.form.searchword.focus();"><i class="icon-search"></i></button>';
						//$btn_output = ' <input type="image" alt="' . $button_text . '" class="btn-search" src="' . $img . '" onclick="this.form.searchword.focus();"/>';
					else :
						$btn_output = ' <button class="btn-search" onclick="this.form.searchword.focus();">' . $button_text . '</button>';
					endif;

					switch ($button_pos) :
						case 'top' :
							$output = $btn_output . '<br />' . $output;
							break;

						case 'bottom' :
							$output .= '<br />' . $btn_output;
							break;

						case 'right' :
							$output .= $btn_output;
							break;

						case 'left' :
						default :
							$output = $btn_output . $output;
							break;
					endswitch;
				endif;

				echo $output;
			?>
			<input type="hidden" name="task" value="search" />
			<input type="hidden" name="option" value="com_search" />
			<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
		</form>
		</div>
	</div>
</div>
