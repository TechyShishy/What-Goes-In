<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('Classes/FunctionEvent.php');

/**
 * Description of FunctionEventReturn
 *
 * @author shishire
 */
class FunctionEventReturn extends FunctionEvent
{
    public function __construct($parsed_line) {
		parent::__construct($parsed_line);
	}
}

?>
