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
    /**
     *
     * @var FunctionEventCall Call Event
     */
	private $call_event;
    /**
     *
     * @var FunctionEventReturn Return Event
     */
	private $return_event;
    /**
     *
     * @var FunctionInstance Parent
     */
	private $parent;
    /**
     *
     * @var array Array of FunctionInstance
     */
	private $children = array();
	
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

    public function get_total_time()
    {
        return $this->return_event->get_time() - $this->call_event->get_time();
    }
    public function get_execution_time()
    {
        $time = $this->get_total_time();
        foreach($this-children as $child)
        {
            $time -= $child->get_total_time();
        }
        return $time;
    }

    public function get_params()
    {
        return $this->call_event->get_params();
    }
    public function get_name()
    {
        return $this->get_call_event()->get_function_name();
    }
    public function do_print()
    {
        $html = '<h>'.$this->get_name().'</h> '.$this->get_call_event()->get_include_file().'<br />';
        foreach($this->get_params() as $param)
        {
            $html .= '<span>'.htmlspecialchars($param).'</span><br />';
        }
        $html .= '<ol>';

        foreach($this->children as $child)
        {
            $html .= '<li>';
            $html .= $child->do_print();
            $html .= '</li>';
        }

        $html .= '</ol>';

        return $html;
    }
}

?>
