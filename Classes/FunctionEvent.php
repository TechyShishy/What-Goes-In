<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TraceFileLine
 *
 * @author shishire
 */
class FunctionEvent
{
    private $level;
    private $function_number;
    private $time;
    private $memory;
	
	public function __construct($parsed_line) {
		$this->set_level($parsed_line['level']);
		$this->set_function_number($parsed_line['function_number']);
		$this->set_time($parsed_line['time']);
		$this->set_memory($parsed_line['memory']);
	}
	
	protected function set_level($level)
	{
		$this->level = $level;
	}
	protected function set_function_number($function_number)
	{
		$this->function_number = $function_number;
	}
	protected function set_time($time)
	{
		$this->time = $time;
	}
	protected function set_memory($memory)
	{
		$this->memory = $memory;
	}

}

?>
