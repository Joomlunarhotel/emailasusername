<?php
/**
 *---------------------------------------------------------------------------------------
 * @package       VP Framework for Joomla!
 *---------------------------------------------------------------------------------------
 * @copyright     Copyright (C) 2012-2015 VirtuePlanet Services LLP. All rights reserved.
 * @license       GNU General Public License version 2 or later; see LICENSE.txt
 * @authors       Abhishek Das
 * @email         info@virtueplanet.com
 * @link          http://www.virtueplanet.com
 *---------------------------------------------------------------------------------------
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
?>
<div class="reset-confirm<?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
		</div>
	<?php endif; ?>
	<form action="<?php echo JRoute::_('index.php?option=com_users&task=reset.confirm'); ?>" method="post" class="form-validate old-forml">
		<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
			<fieldset>
				<p><?php echo JText::_($fieldset->label); ?></p>
				<?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field) : ?>
					<?php if ($field->hidden) :// If the field is hidden, just display the input.?>
						<?php echo $field->input;?>
					<?php else : ?>
						<div class="form-group">
							<?php if($field->name=="jform[username]") { 
								$label=JText::_('JGLOBAL_EMAIL'); 
								}  else {
								$label=$field->label;
							}
							?>
							<?php echo plgSystemVPFrameworkHelper::getTemplate()->addHTMLClass($label, 'label', 'control-label'); ?>
							<?php echo $field->input; ?>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</fieldset>
		<?php endforeach; ?>
		<div class="form-group">
			<button type="submit" class="btn btn-base btn-lg validate"><?php echo JText::_('JSUBMIT'); ?></button>
			&nbsp;<a class="btn btn-default btn-lg" href="<?php echo JRoute::_('index.php?option=com_users&view=login'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
