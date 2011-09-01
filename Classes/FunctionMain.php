<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('Classes/FunctionInstance.php');

/**
 * Description of FunctionMain
 *
 * @author shishire
 */
class FunctionMain extends FunctionInstance
{
	public function __construct() {
		
	}
	
	// This is the root node, so there can't be a parent.
	public function get_parent() {
        return null;
	}
	public function do_return($return_event) {
		$this->set_return_event($return_event);
		return null;
	}
}

?>
