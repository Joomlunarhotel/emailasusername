<?php
/**
* @package   Super Login Pro
* @author    Mustaq Sheikh http://www.herdboy.com
* @copyright Copyright (C) HerdBoy Web Design cc
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');

?>

<form class="uk-form" action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post">

	<?php if ($params->get('pretext')) : ?>
	<div class="">
		<?php echo $params->get('pretext'); ?>
	</div>
	<?php endif; ?>
    <div class="uk-width-1-1">

		<input  class="uk-form-width-small uk-form-large" type="text" name="username" size="10" placeholder="<?php echo JText::_('JGLOBAL_EMAIL') ?>">
		<div class="uk-form-password"><input  class="uk-form-width-small uk-form-large" type="password" name="password" size="10" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>"><a href="" class="uk-form-password-toggle" data-uk-form-password="{lblShow:'<?php echo JText::_('JSHOW') ?>', lblHide:'<?php echo JText::_('JHIDE') ?>'}"><i class='uk-icon-eye'></i></a></div>
		<?php if ((version_compare(JVERSION,'3.2','ge')) && ((count($twofactormethods) > 1))) : ?>
		<input class="uk-form-width-small uk-form-large" id="modlgn-secretkey" type="text" name="secretkey" size="10" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
        <?php endif; ?>
		<button class="uk-button uk-button-primary uk-icon-sign-in uk-icon-large" data-uk-tooltip title="<?php echo JText::_('JLOGIN') ?>" value="<?php echo JText::_('JLOGIN') ?>" name="Submit" type="submit"></button>
	    <?php if ($slp_hfpass == ("0")) : ?>
		<a class="uk-button uk-button-default uk-icon-key uk-icon-large" data-uk-tooltip title="<?php echo JText::_('MOD_SUPERLOGINPRO_FORGOT_YOUR_PASSWORD'); ?>" href="<?php echo JRoute::_($prlink); ?>"></a>
        <?php endif; ?>
	    <?php if ($slp_huse == ("0")) : ?>
		<a class="uk-button uk-button-default uk-icon-user uk-icon-large" data-uk-tooltip title="<?php echo JText::_('MOD_SUPERLOGINPRO_FORGOT_YOUR_USERNAME'); ?>" href="<?php echo JRoute::_($urlink); ?>"></a>
        <?php endif; ?>
		<?php $usersConfig = JComponentHelper::getParams('com_users'); ?>
		<?php if ($usersConfig->get('allowUserRegistration')) : ?>
	    <?php if ($slp_hreg == ("0")) : ?>
		<a class="uk-button uk-button-default uk-icon-edit uk-icon-large" data-uk-tooltip title="<?php echo JText::_('MOD_SUPERLOGINPRO_REGISTER'); ?>" href="<?php echo JRoute::_($reglink); ?>"></a>
		<?php endif; ?>
        <?php endif; ?>

	</div>

	<?php if ($slp_remember == ("0")) : ?>
	<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
		<?php $number = rand(); ?>
	<div class="uk-form-row">        
		<label for="modlgn-remember-<?php echo $number; ?>"><?php echo JText::_('MOD_SUPERLOGINPRO_REMEMBER_ME') ?></label>
		<input id="modlgn-remember-<?php echo $number; ?>" type="checkbox" name="remember" value="yes" checked>
	</div>
	<?php endif; ?>
	<?php endif; ?>

	<?php if($params->get('posttext')) : ?>
	<div class="uk-form-row">
		<?php echo $params->get('posttext'); ?>
	</div>
	<?php endif; ?>
	
	<input type="hidden" name="option" value="com_users">
	<input type="hidden" name="task" value="user.login">
	<input type="hidden" name="return" value="<?php echo $return; ?>">
	<?php echo JHtml::_('form.token'); ?>
</form>