<?php

defined('_JEXEC') or die('');


/**
 * Renders the email for the user send in the registration process
 * @package	VirtueMart
 * @subpackage User
 * @author Max Milbers
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 2459 2010-07-02 17:30:23Z milbo $
 */
$li = "\n";

echo vmText::sprintf('COM_VIRTUEMART_WELCOME_USER') . $li . $li; 
echo "Ciao , Grazie per esserti registrato. Ora è possibile accedere utilizzando l'indirizzo email e la password che hai scelto durante la registrazione.";
if (!empty($this->activationLink)) {
    $activationLink = '<a class="default" href="' . JURI::root() . $this->activationLink . '>' . vmText::_('COM_VIRTUEMART_LINK_ACTIVATE_ACCOUNT') . '</a>';
}
echo $activationLink . $li;
echo vmText::_('COM_VIRTUEMART_SHOPPER_REGISTRATION_DATA') . $li;

echo vmText::_('COM_VIRTUEMART_YOUR_LOGINAME') . ' : ' . $this->user->email . $li;
if ($this->password) {
	echo vmText::_('COM_VIRTUEMART_YOUR_PASSWORD') . ' : ' . $this->password . $li;
}
echo $li.vmText::_('COM_VIRTUEMART_YOUR_ADDRESS') . ' : ' . $li;

echo $li;
echo $activationLink . $li;


echo $li;

