<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$class = ' class="accordion open"';
$lang  = JFactory::getLanguage();

$db = JFactory::getDbo();

// Create a shortcut for params.
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);

if ($this->maxLevel != 0 && count($this->children[$this->category->id]) > 0) : ?>

<div class="block-accordion">
	<?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
		<?php
		if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) :
			if (!isset($this->children[$this->category->id][$id + 1])) :
				$class = ' class="accordion last"';
			endif;
		?>
		<?php /*<div <?php echo $class; ?>>*/?>
			<?php $class = 'class="accordion"'; ?>
			<?php if ($lang->isRtl()) : ?>
			<h3 class="page-header item-title">
				<?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
					<span class=" tip hasTooltip" title="<?php echo JHtml::_('tooltipText', 'COM_CONTENT_NUM_ITEMS_TIP'); ?>">
						<?php echo $child->getNumItems(true); ?>
					</span>
				<?php endif; ?>
				<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id)); ?>">
					<?php echo $this->escape($child->title); ?>
				</a>
				<?php if ($this->maxLevel > 1 && count($child->getChildren()) > 0) : ?>
				<a href="#category-<?php echo $child->id; ?>" data-toggle="collapse" data-toggle="button" class="btn btn-mini pull-right">
					<span class="icon-plus"></span>
				</a>
				<?php endif; ?>
			</h3>
			<?php else : ?>
			<button class="accordion-button" type="button">
				<?php echo $this->escape($child->title); ?>
				<div class="num-items">
				<?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
					<span class=" tip hasTooltip" title="<?php echo JHtml::_('tooltipText', 'COM_CONTENT_NUM_ITEMS_TIP'); ?>">
						<?php echo JText::_('COM_CONTENT_NUM_ITEMS'); ?>;
						<?php echo $child->getNumItems(true); ?>
					</span>
				<?php endif; ?>
				<?php if ($this->maxLevel > 1 && count($child->getChildren()) > 0) : ?>
					<a href="#category-<?php echo $child->id; ?>" data-toggle="collapse" data-toggle="button" class="btn btn-mini pull-right">
						<span class="icon-plus"></span>
					</a>
				<?php endif; ?>
				</div>
			</button>
			<?php /*
			<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id)); ?>">
				<?php echo $this->escape($child->title); ?>
			</a>
			*/?>				
			<div class="accordion-panel">
				<?php echo $category->title; ?>
				<?php if ($this->params->get('show_subcat_desc') == 1) : ?>
				<?php if ($child->description) : ?>
					<div class="category-desc">
						<?php echo JHtml::_('content.prepare', $child->description, '', 'com_content.category'); ?>
					</div>
				<?php endif; ?>
				<?php endif; ?>
				<ul class="subcat-list">	
					<?php
						$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));
						$model->setState('params', JFactory::getApplication()->getParams());
						$model->setState('filter.category_id', $child->id);
						$articles = $model->getItems();
					?>
					<?php foreach ($articles as &$art): ?>			    
						<li class="item-carta">
							<?php $this->item = &$art; echo $this->loadTemplate('subitem'); ?>				
						</li>						
					<?php endforeach;?>			
				</ul>
				
				<?php endif; ?>
				<?php if ($this->maxLevel > 1 && count($child->getChildren()) > 0) : ?>
				<div class="collapse fade" id="category-<?php echo $child->id; ?>">
					<?php
					$this->children[$child->id] = $child->getChildren();
					$this->category = $child;
					$this->maxLevel--;
					echo $this->loadTemplate('children');
					$this->category = $child->getParent();
					$this->maxLevel++;
					?>
				</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
			</div>
<?php endif;
