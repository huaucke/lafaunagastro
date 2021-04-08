<?php
/**
 * @package     Joomla.Cms
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\Registry\Registry;

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');

?>
<?php if (!empty($displayData)) : ?>
	<?php foreach ($displayData as $i => $tag) : ?>
		<?php if (in_array($tag->access, JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id')))) : ?>
			<?php $tagParams = new Registry($tag->params); ?>
				<div class="tag <?php echo $tag->alias; ?> tag-<?php echo $tag->tag_id; ?> tag-list<?php echo $i ?>" itemprop="keywords">
					<?php echo $this->escape($tag->title); ?>
				</div>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
