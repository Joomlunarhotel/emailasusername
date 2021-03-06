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

class le_com_virtuemart extends lunarExtention {
	
	function __construct( $name, & $parentObject ) {
		parent::__construct( $name, $parentObject );
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
		// check to see if bypv_OPC checkout system plugin is installed.
		// rather than look for the extension (another database call)
		// we'll look for key post variables
		if(@$this->pageData->bypv_customer_type) {
			// yep there is one, we need to include the bypv_OPC extension class
			require_once( JPATH_ROOT . DS . "plugins" . DS . "system" . 	DS . "emailasusername" . DS . 
				"template_overrides" . DS . "opc_for_vm_bypv" . DS . "le_opc_for_vm_bypv.php");
			// create a new instance
			// dummy gets overloaded anyway
			$bypvOPC= new le_opc_for_vm_bypv("dummy", $this->parentObj);
			$bypvOPC->processInput();
			// there's nothing left to do.
			$this->log("com_virtuemart:Ive called processInput in opc_for_vm so Im quitting processInput");
			return true;
		}
		
		@$this->pageData->task=strtolower( $this->pageData->task );
		if(@$this->pageData->task=="registercartuser" || @$this->pageData->task=="savecheckoutuser" || 
			@$this->pageData->task=="registercheckoutuser" || @$this->pageData->task=="saveuser" ||
			@$this->pageData->ctask=="register") {
			//| (@$this->pagedata->task=="save" && @$this->pagedata->view=="user")) {
			
			$this->log("com_virtuemart:Editing the billing / shipping details / registration");
			
			// need to generate a username, hopefully at least one of these will give us a seed
			if(@!$usernameseed=$this->pageData->first_name . @$this->pageData->middle_name . @$this->pageData->last_name) {
			  if(@!$usernameseed=$this->pageData->name) {
				  if(@!$usernameseed=$this->pageData->company) {
					  $usernameseed=$this->pageData->email;
				  }
			  }
			 }
			
			$username = $this->genUserName($usernameseed);
			$this->log("com_virtuemart:setting username to " . $username);
			if(!@$this->pageData->name) {
			  // the name field was probably hidden
			  if(!$usernameseed=@$this->pageData->first_name . @$this->pageData->middle_name . @$this->pageData->last_name) {
			      // use the username as a last resort
			      $users_name=$username;
			    } else {
			      // make sure the users name looks nice.
			      $users_name=trim(@$this->pageData->first_name . " " . @$this->pageData->last_name);
			  }
			  $this->log("com_virtuemart:setting user's NAME (not username) to " . $users_name);
			  JRequest::set(array("name" => $users_name),"post");
			 }
			// now set the value in the post variable
			JRequest::set(array("username" => $username),"post");
			
			return;
		}
		
		
		$this->log("processInput for com_users complete");
	}
	
}
?>