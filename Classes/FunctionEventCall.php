<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('Classes/FunctionEvent.php');

/**
 * Description of FunctionEventCall
 *
 * @author shishire
 */
class FunctionEventCall extends FunctionEvent
{
	private $function_name;
	private $user_defined;
	private $include_file;
	private $filename;
	private $line_number;
	private $params = array();
	
	public function __construct($parsed_line) {
		parent::__construct($parsed_line);
		
		$this->set_function_name($parsed_line['function_name']);
		$this->set_user_defined($parsed_line['user_defined']);
		$this->set_include_file($parsed_line['include_file']);
		$this->set_filename($parsed_line['filename']);
		$this->set_line_number($parsed_line['line_number']);
        if(isset($parsed_line['params']))
    		$this->set_params($parsed_line['params']);
        else {
            $this->set_params(array());
        }
	}
	
	private function set_function_name($function_name)
	{
		$this->function_name = $function_name;
	}
	private function set_user_defined($user_defined)
	{
		if($user_defined === "1")
			$this->user_defined = true;
		else
			$this->user_defined = false;
	}
	private function set_include_file($include_file)
	{
		$this->include_file = $include_file;
	}
	private function set_filename($filename)
	{
		$this->filename = $filename;
	}
	private function set_line_number($line_number)
	{
		$this->line_number = $line_number;
	}
	private function set_params($params)
	{
		$this->params = $params;
	}
    
    public function get_function_name()
    {
        return $this->function_name;
    }
    public function get_user_defined()
    {
        return $this->user_defined;
    }
    public function get_include_file()
    {
        return $this->include_file;
    }
    public function get_filename()
    {
        return $this->filename;
    }
    public function get_line_number()
    {
        return $this->line_number;
    }
    public function get_params()
    {
        return $this->params;
    }
}

?>
