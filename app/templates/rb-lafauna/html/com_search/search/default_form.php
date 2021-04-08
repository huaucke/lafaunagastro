<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();

?>
<form id="searchForm" class="searchForm" action="<?php echo JRoute::_('index.php?option=com_search'); ?>" method="post">
	<div class="search-bar">
		<input type="text" name="searchword" title="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="inputbox search-query input-medium" />
		<button name="Search" onclick="this.form.submit()" class="btn hasTooltip" title="<?php echo JHtml::_('tooltipText', 'COM_SEARCH_SEARCH');?>">
			<span class="icon-search"></span>
		</button>
		<input type="hidden" name="task" value="search" />
		<div class="clearfix"></div>
		<div class="searchintro<?php echo $this->params->get('pageclass_sfx'); ?>">
			<?php if (!empty($this->searchword)) : ?>
			<p>
				<?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', '<span class="badge badge-info">' . $this->total . '</span>'); ?>
			</p>
			<?php endif; ?>
		</div>
	</div>
	<?php if ($this->params->get('search_phrases', 1)) : ?>
		<h3>
			<?php echo JText::_('COM_SEARCH_FOR'); ?>
		</h3>
		<fieldset class="phrases">
			<div class="phrases-box">
				<?php echo $this->lists['searchphrase']; ?>
			</div>
			<div class="ordering-box">
				<label for="ordering" class="ordering">
					<?php echo JText::_('COM_SEARCH_ORDERING'); ?>
				</label>
				<?php echo $this->lists['ordering']; ?>
			</div>
		</fieldset>
	<?php endif; ?>
	<?php if ($this->params->get('search_areas', 1)) : ?>
		<h3>
			<?php echo JText::_('COM_SEARCH_SEARCH_ONLY'); ?>
		</h3>
		<fieldset class="only">
			<?php foreach ($this->searchareas['search'] as $val => $txt) : ?>
				<?php $checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : ''; ?>
				<label for="area-<?php echo $val; ?>" class="checkbox">
					<input type="checkbox" name="areas[]" value="<?php echo $val; ?>" id="area-<?php echo $val; ?>" <?php echo $checked; ?> />
					<?php echo JText::_($txt); ?>
				</label>
			<?php endforeach; ?>
		</fieldset>
	<?php endif; ?>
	<?php if ($this->total > 0) : ?>
		<div class="form-limit">
			<label for="limit">
				<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
			</label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
		<p class="counter">
			<?php echo $this->pagination->getPagesCounter(); ?>
		</p>
	<?php endif; ?>
</form>
