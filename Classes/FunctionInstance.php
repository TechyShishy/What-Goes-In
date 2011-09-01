<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FunctionInstance
 *
 * @author shishire
 */
class FunctionInstance {
	private $call_event;
	private $return_event;
	private $parent;
	private $children;
	
	public function __construct($call_event)
	{
		$this->set_call_event($call_event);
	}

	private function set_parent($parent)
	{
		$this->parent = $parent;
	}
	private function set_call_event($call_event)
	{
		$this->call_event = $call_event;
	}
	protected function set_return_event($return_event)
	{
		$this->return_event = $return_event;
	}
	
	public function get_parent()
	{
		return $this->parent;
	}
	public function get_call_event()
	{
		return $this->call_event;
	}
	public function get_return_event()
	{
		return $this->return_event;
	}
	
	public function do_call($call_event)
	{
		$child = new self($call_event);
		$child->set_parent($this);
		$this->children[] = $child;
		return $child;
	}
	
	public function do_return($return_event)
	{
		$this->set_return_event($return_event);
		return $this->parent;
	}
}

?>
