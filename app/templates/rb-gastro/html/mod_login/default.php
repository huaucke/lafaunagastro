<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

?>
<div class="mod-login">
	<div id="acceslogin" class="btn-acceslogin">Admin</div>
	<div id="form-signin" class="popup form-signin">
		<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure', 0)); ?>" method="post" id="login-form">
			<div class="btn-close">
				<span></span>
				<span></span>
			</div>
			<?php if ($params->get('pretext')): ?>
				<h3 class="pretext">
					<?php echo $params->get('pretext'); ?>
				</h3>
			<?php endif;?>
			<?php if ($params->get('posttext')): ?>
				<div class="posttext">
					<p><?php echo $params->get('posttext'); ?></p>
				</div>
			<?php endif;?>
			<div id="form-login-username" class="form-floating userdata">
				<?php if (!$params->get('usetext', 0)): ?>
					<span class="icon-user hasTooltip" title="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?>"></span>
					<label for="modlgn-username" class="element-invisible"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
					<input id="modlgn-username" type="text" name="username" class="form-control" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?>" />
				<?php else: ?>
					<input id="modlgn-username" type="text" name="username" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?>" />
					<label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
				<?php endif;?>
			</div>
			<div id="form-login-password" class="form-floating password">
				<?php if (!$params->get('usetext', 0)): ?>
					<span class="icon-lock hasTooltip" title="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>"></span>
					<label for="modlgn-passwd" class="element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
					<input id="modlgn-passwd" type="password" name="password" class="form-control " placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" />
				<?php else: ?>
					<input id="modlgn-passwd" type="password" name="password" class="form-control " placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" />
					<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
				<?php endif;?>
			</div>
			<?php if (count($twofactormethods) > 1): ?>
				<div id="form-login-secretkey" class="form-floating ">
					<?php if (!$params->get('usetext', 0)): ?>
						<div class="input-prepend input-append">
							<span class="icon-star hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>"></span>
							<label for="modlgn-secretkey" class="element-invisible"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
							<input id="modlgn-secretkey" autocomplete="one-time-code" type="text" name="secretkey" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" />
							<span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
								<span class="icon-help"></span>
							</span>
						</div>
					<?php else: ?>
						<label for="modlgn-secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
						<input id="modlgn-secretkey" autocomplete="one-time-code" type="text" name="secretkey" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" />
						<span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
							<span class="icon-help"></span>
						</span>
					<?php endif;?>
				</div>
			<?php endif;?>
			<?php if (JPluginHelper::isEnabled('system', 'remember')): ?>
				<div id="form-login-remember" class="remember">
					<label for="modlgn-remember">
						<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
						<?php echo JText::_('MOD_LOGIN_REMEMBER_ME'); ?>
					</label>
				</div>
			<?php endif;?>
				<div id="form-login-submit">
					<button type="submit" tabindex="0" name="Submit" class="btn-login"><?php echo JText::_('JLOGIN'); ?></button>
				</div>
			<?php $usersConfig = JComponentHelper::getParams('com_users');?>
			<ul class="unstyled">
				<?php if ($usersConfig->get('allowUserRegistration')): ?>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
						<?php echo JText::_('MOD_LOGIN_REGISTER'); ?>
						<span class="icon-arrow-right"></span>
					</a>
				</li>
				<?php endif;?>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
						<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
						<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?>
					</a>
				</li>
			</ul>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="user.login" />
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</form>
	</div>
</div>