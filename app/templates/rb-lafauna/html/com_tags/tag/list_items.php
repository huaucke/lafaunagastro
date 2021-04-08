<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.core');
JHtml::_('formbehavior.chosen', 'select');

$n         = count($this->items);
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
JFactory::getDocument()->addScriptDeclaration("
		var resetFilter = function() {
		document.getElementById('filter-search').value = '';
	}
");
?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<?php if ($this->params->get('filter_field') || $this->params->get('show_pagination_limit')) : ?>
	<fieldset class="filters btn-toolbar">
		<?php if ($this->params->get('filter_field')) :?>
			<div class="btn-group">
				<label class="filter-search-lbl element-invisible" for="filter-search">
					<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL') . '&#160;'; ?>
				</label>
				<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="inputbox" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_TAGS_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL'); ?>" />
				<button type="button" name="filter-search-button" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>" onclick="document.adminForm.submit();" class="btn">
					<span class="icon-search"></span>
				</button>
				<button type="reset" name="filter-clear-button" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>" class="btn" onclick="resetFilter(); document.adminForm.submit();">
					<span class="icon-remove"></span>
				</button>
			</div>
		<?php endif; ?>
		<?php if ($this->params->get('show_pagination_limit')) : ?>
			<div class="btn-group pull-right">
				<label for="limit" class="element-invisible">
					<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		<?php endif; ?>

		<input type="hidden" name="filter_order" value="" />
		<input type="hidden" name="filter_order_Dir" value="" />
		<input type="hidden" name="limitstart" value="" />
		<input type="hidden" name="task" value="" />
		<div class="clearfix"></div>
	</fieldset>
	<?php endif; ?>

	<?php if ($this->items == false || $n == 0) : ?>
		<p> <?php echo JText::_('COM_TAGS_NO_ITEMS'); ?></p>
	<?php else : ?>
		<table class="lalala category table table-striped table-bordered table-hover">
			<?php if ($this->params->get('show_headings')) : ?>
			<thead>
				<tr>
					<th id="categorylist_header_title">
						<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'c.core_title', $listDirn, $listOrder); ?>
					</th>
					<?php if ($date = $this->params->get('tag_list_show_date')) : ?>
						<th id="categorylist_header_date">
							<?php if ($date == "created") : ?>
								<?php echo JHtml::_('grid.sort', 'COM_TAGS_' . $date . '_DATE', 'c.core_created_time', $listDirn, $listOrder); ?>
							<?php elseif ($date == "modified") : ?>
								<?php echo JHtml::_('grid.sort', 'COM_TAGS_' . $date . '_DATE', 'c.core_modified_time', $listDirn, $listOrder); ?>
							<?php elseif ($date == "published") : ?>
								<?php echo JHtml::_('grid.sort', 'COM_TAGS_' . $date . '_DATE', 'c.core_publish_up', $listDirn, $listOrder); ?>
							<?php endif; ?>
						</th>
					<?php endif; ?>

				</tr>
			</thead>
			<?php endif; ?>
			<tbody>
				<?php foreach ($this->items as $i => $item) : ?>
					<?php if ($this->items[$i]->core_state == 0) : ?>
					 <tr class="system-unpublished cat-list-row<?php echo $i % 2; ?>">
					<?php else: ?>
					<tr class="cat-list-row<?php echo $i % 2; ?>" >
					<?php endif; ?>
						<td <?php if ($this->params->get('show_headings')) echo "headers=\"categorylist_header_title\""; ?> class="list-title">
							<a href="<?php echo JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias, $item->core_catid, $item->core_language, $item->type_alias, $item->router)); ?>">
								<?php echo $this->escape($item->core_title); ?>
							</a>
							<?php if ($item->core_state == 0) : ?>
								<span class="list-published label label-warning">
									<?php echo JText::_('JUNPUBLISHED'); ?>
								</span>
							<?php endif; ?>
						</td>
						<?php if ($this->params->get('tag_list_show_date')) : ?>
							<td headers="categorylist_header_date" class="list-date small">
								<?php
								echo JHtml::_(
									'date', $item->displayDate,
									$this->escape($this->params->get('date_format', JText::_('DATE_FORMAT_LC3')))
								); ?>
							</td>
						<?php endif; ?>

					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<h1>Isotope - vertical table-like</h1>

<div id="sorts" class="button-group">
  <button class="button is-checked" data-sort-value="original-order">original order</button>
  <button class="button" data-sort-value="name">name</button>
  <button class="button" data-sort-value="symbol">symbol</button>
  <button class="button" data-sort-value="number">number</button>
  <button class="button" data-sort-value="weight">weight</button>
  <button class="button" data-sort-value="category">category</button>
</div>


<ul class="table-like">
    
  <li class="table-like__item">
    <div class="name">Mercury</div>
    <div class="symbol">Hg</div>
    <div class="number">80</div>
    <div class="weight">200.59</div>
    <div class="category">transition</div>
  </li>

  <li class="table-like__item">
    <div class="name">Tellurium</div>
    <div class="symbol">Te</div>
    <div class="number">52</div>
    <div class="weight">127.6</div>
    <div class="category">metalloid</div>
  </li>

  <li class="table-like__item">
    <div class="name">Bismuth</div>
    <div class="symbol">Bi</div>
    <div class="number">83</div>
    <div class="weight">208.980</div>
    <div class="category">post-transition</div>
  </li>

  <li class="table-like__item">
    <div class="name">Lead</div>
    <div class="symbol">Pb</div>
    <div class="number">82</div>
    <div class="weight">207.2</div>
    <div class="category">post-transition</div>
  </li>

  <li class="table-like__item">
    <div class="name">Gold</div>
    <div class="symbol">Au</div>
    <div class="number">79</div>
    <div class="weight">196.967</div>
    <div class="category">transition</div>
  </li>

  <li class="table-like__item">
    <div class="name">Potassium</div>
    <div class="symbol">K</div>
    <div class="number">19</div>
    <div class="weight">39.0983</div>
    <div class="category">alkali</div>
  </li>

  <li class="table-like__item">
    <div class="name">Sodium</div>
    <div class="symbol">Na</div>
    <div class="number">11</div>
    <div class="weight">22.99</div>
    <div class="category">alkali</div>
  </li>

  <li class="table-like__item">
    <div class="name">Cadmium</div>
    <div class="symbol">Cd</div>
    <div class="number">48</div>
    <div class="weight">112.411</div>
    <div class="category">transition</div>
  </li>

  <li class="table-like__item">
    <div class="name">Calcium</div>
    <div class="symbol">Ca</div>
    <div class="number">20</div>
    <div class="weight">40.078</div>
    <div class="category">alkaline-earth</div>
  </li>

  <li class="table-like__item">
    <div class="name">Rhenium</div>
    <div class="symbol">Re</div>
    <div class="number">75</div>
    <div class="weight">186.207</div>
    <div class="category">transition</div>
  </li>

  <li class="table-like__item">
    <div class="name">Thallium</div>
    <div class="symbol">Tl</div>
    <div class="number">81</div>
    <div class="weight">204.383</div>
    <div class="category">post-transition</div>
  </li>

  <li class="table-like__item">
    <div class="name">Antimony</div>
    <div class="symbol">Sb</div>
    <div class="number">51</div>
    <div class="weight">121.76</div>
    <div class="category">metalloid</div>
  </li>

  <li class="table-like__item">
    <div class="name">Cobalt</div>
    <div class="symbol">Co</div>
    <div class="number">27</div>
    <div class="weight">58.933</div>
    <div class="category">transition</div>
  </li>

  <li class="table-like__item">
    <div class="name">Ytterbium</div>
    <div class="symbol">Yb</div>
    <div class="number">70</div>
    <div class="weight">173.054</div>
    <div class="category">lanthanoid</div>
  </li>

  <li class="table-like__item">
    <div class="name">Argon</div>
    <div class="symbol">Ar</div>
    <div class="number">18</div>
    <div class="weight">39.948</div>
    <div class="category">noble-gas</div>
  </li>

  <li class="table-like__item">
    <div class="name">Nitrogen</div>
    <div class="symbol">N</div>
    <div class="number">7</div>
    <div class="weight">14.007</div>
    <div class="category">diatomic</div>
  </li>

  <li class="table-like__item">
    <div class="name">Uranium</div>
    <div class="symbol">U</div>
    <div class="number">92</div>
    <div class="weight">238.029</div>
    <div class="category">actinoid</div>
  </li>

  <li class="table-like__item">
    <div class="name">Plutonium</div>
    <div class="symbol">Pu</div>
    <div class="number">94</div>
    <div class="weight">(244)</div>
    <div class="category">actinoid</div>
  </li>

</ul>



	<?php endif; ?>

<?php // Add pagination links ?>
<?php if (!empty($this->items)) : ?>
	<?php if (($this->params->def('show_pagination', 2) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
	<div class="pagination">

		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter pull-right">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php endif; ?>

		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>
<?php endif; ?>
</form>
