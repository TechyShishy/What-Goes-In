<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FunctionMain
 *
 * @author shishire
 */
class FunctionMain extends FunctionInstance
{
	public function __construct() {
		
	}
	
	
	// Forcibly break inheritance here
	// This is the root node, so there can't be a parent.
	private function get_parent() {
	}
	public function do_return($return_event) {
		$this->set_return_event($return_event);
		return null;
	}
}

?>
