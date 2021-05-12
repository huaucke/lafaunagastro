<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_fields
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Check if we have all the data
if (!key_exists('item', $displayData) || !key_exists('context', $displayData))
{
	return;
}

// Setting up for display
$item = $displayData['item'];

if (!$item)
{
	return;
}

$context = $displayData['context'];

if (!$context)
{
	return;
}

JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');

$parts     = explode('.', $context);
$component = $parts[0];
$fields    = null;

if (key_exists('fields', $displayData))
{
	$fields = $displayData['fields'];
}
else
{
	$fields = $item->jcfields ?: FieldsHelper::getFields($context, $item, true);
}

if (empty($fields))
{
	return;
}

$output = array();

foreach ($jcFields as $field)
{
	// If the value is empty do nothing
	if (!isset($field->value) || trim($field->value) === '')
	{
		continue;
	}

	$class = $field->params->get('render_class');
	$layout = $field->params->get('layout', 'render');

	if($field->type != 'checkboxes')
	{
		$content = FieldsHelper::render($context, 'field.' . $layout, array('field' => $field));		
	}
	else
	{		
		$content = "<div class='alerg-list'>";
		
		foreach($field->rawvalue as $val)
		{
			$content = $content."
			<i class='hasTooltip tip ".$val."' alt='".$val."' data-original-title='".$val."' ></i>";
		}
		$content = $content."
						</div>";
	}

	// If the content is empty do nothing
	if (trim($content) === '') 
	{
		continue;
	}

	$output[] = '<div class="field-entry ' . $class . '">' . $content . '</div>';
}

if (empty($output))
{
	return;
}

?>
<div class="fields-container">
	<?php echo implode("\n", $output); ?>
</div>