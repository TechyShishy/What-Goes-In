<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TraceFileLineExit
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
