<?php
/**
* @version		$Id: LunarHotel EmailAsUsername Extention class instance (com_users) $
* @package		Joomla 1.6 Native version
* @copyright	Copyright (C) 2011 LunarHotel.co.uk. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* 
*/

require_once( JPATH_ROOT . DS . "plugins" . DS . "system" . 
	DS . "emailasusername" . DS . "lunarExtention.php" );

// now we can inherit the class in lunarExtention.php, and make it specific to com_users
// there wont be much work customising it.

class le_com_hikashop extends lunarExtention {
	
	function __construct( $name, & $parentObject ) {
		parent::__construct( $name, $parentObject );
		$this->manifestFile="hikashop_j3.xml";
	}
	
	/*function hideUsername() {
		// get the extension version
		parent::hideUsername();
	}*/
	
	// this function will process the input from pages affected by the template
	// overrides. in most cases this will mean generating a username from the posted
	// information, and adding the generated username to the post variable, for processing
	// by the target extension.
	
	function processInput() {
		// get the pagedata so we have a fresh copy.
		parent::processInput();
// 		die("<pre>" . print_r($this->pageData,true) . "</pre>");
		//
 		if(@$this->pageData->task=="step" || @$this->pageData->task=="register") {
			//| (@$this->pagedata->task=="save" && @$this->pagedata->view=="user")) {
			
			$this->log("com_hikashop:Normal registration ");

			// need to generate a username
			@$username = $this->genUserName($this->pageData->data['address']['address_firstname'] . " " 
			  . $this->pageData->data['address']['address_lastname']);
			$this->log("com_hikashop:setting username to " . $username);
			
			//data[register][username]
			$jinput = JFactory::getApplication()->input;
			@$this->pageData->data['register']['username'] = $username;
			@$jinput->post->set("data",$this->pageData->data);
			$jinput->set("data",$this->pageData->data);
			
			
			//$jform=$jinput->get('data', array(), 'array');
  			//die("<pre>" . print_r($jform,true) . "</pre>");
		}
		
		$this->log("processInput for com_hikashop complete");
	}
	
}
?>