<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

$dispatcher = JEventDispatcher::getInstance();

$this->category->text = $this->category->description;
$dispatcher->trigger('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $dispatcher->trigger('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));

?>
<div id="intro" class="intro-grid">
<?php if ($this->params->get('show_category_title', 1) || $this->params->def('show_description_image', 1)): ?>
	<div class="page-header">
		<div class="imgintro">
			<div class="darker"></div>
			<div class="bg-blur" style="background-image: url('<?php echo $this->category->getParams()->get('image'); ?>');" alt="<?php echo htmlspecialchars($this->category->getParams()->get('image_alt')); ?>" itemprop="image" class="lazy" > </div>
		</div>
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif;?>
	<?php if ($this->params->get('show_page_heading')): ?>
	<div class="page-header show_page_heading">
		<div class="imgintro">
			<div class="darker"></div>
			<div class="bg-blur" style="background-image: url('<?php echo $this->category->getParams()->get('image'); ?>');" alt="<?php echo htmlspecialchars($this->category->getParams()->get('image_alt')); ?>" itemprop="image" class="lazy"> </div>
		</div>
		<div class="avatar" style="background-image: url('<?php echo htmlspecialchars($images->image_intro); ?>');" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" itemprop="image" class="lazy" data-src="<?php echo htmlspecialchars($images->image_intro); ?>" > </div>
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif;?>
	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')): ?>
		<div class="page-subheading">
			<h2>
				<?php echo $this->escape($this->params->get('page_subheading')); ?>
				<?php if ($this->params->get('show_category_title')): ?>
					<span class="subheading-category"><?php echo $this->category->title; ?></span>
				<?php endif;?>
			</h2>
		</div>
	<?php endif;?>
	<?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)): ?>
		<?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags');?>
		<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
	<?php endif;?>
	<?php if ($this->params->get('show_description', 1)) {;}?>
		<?php if ($this->params->get('show_description') && $this->category->description): ?>
		<div class="category-desc clearfix">
				<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
			<?php endif;?>
	<?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)): ?>
		<?php if ($this->params->get('show_no_articles', 1)): ?>
			<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
		<?php endif;?>
	<?php endif;?>
</div>

<div id="grid" class="grid <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog">
	<?php $leadingcount = 0;?>
	<?php if (!empty($this->lead_items)): ?>
		<?php foreach ($this->lead_items as &$item): ?>
			<div class="grid-item item-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
				itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
				<div class="item-box">
					<?php $this->item = &$item;
echo $this->loadTemplate('item');
?>
				</div>
			</div>
			<?php $leadingcount++;?>
		<?php endforeach;?>
	<?php endif;?>
	<?php
$introcount = (count($this->intro_items));
$counter = 0;?>
	<?php if (!empty($this->intro_items)): ?>
		<?php foreach ($this->intro_items as $key => &$item): ?>
			<?php $rowcount = ((int) $key % (int) $this->columns) + 1;?>
			<?php if ($rowcount == 1): ?>
				<?php $row = $counter / $this->columns;?>
				<section class="item col-<?php echo (int) $this->columns; ?> <?php echo 'row-' . $row; ?>"  id="<?php echo $this->escape($item->alias); ?>"	itemprop="blogPost">
					<?php endif;?>
					<div class="column-<?php echo $rowcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
						itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
						<?php
$this->item = &$item;
echo $this->loadTemplate('item');
?>
					</div>
					<!-- end column -->
					<?php $counter++;?>
					<?php if (($rowcount == $this->columns) or ($counter == $introcount)): ?>
				</section>
			<!-- end row -->
			<?php endif;?>
		<?php endforeach;?>
	<?php endif;?>
					</div>
	<div class="clearfix"></div>
	<?php if (!empty($this->link_items)): ?>
		<div class="items-more">
			<?php echo $this->loadTemplate('links'); ?>
		</div>
	<?php endif;?>
	<?php if (!empty($this->children[$this->category->id]) && $this->maxLevel != 0): ?>
	<div class="sub-cats">
		<div class="intro-carta">
			<div class="content">
				<?php if ($this->params->get('show_category_heading_title_text', 1) == 1): ?>
				<h2 class="title"> <?php echo JTEXT::_('NUESTRA_CARTA'); ?> </h2>
				<?php endif;?>
			</div>
		</div>
		<?php echo $this->loadTemplate('accordion'); ?> </div>
		<?php endif;?>
		<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)): ?>
		<div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)): ?>
				<p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
			<?php endif;?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif;?>
</div>