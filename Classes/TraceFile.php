<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('Classes/FunctionEventCall.php');
include_once('Classes/FunctionEventReturn.php');
include_once('Classes/FunctionInstance.php');

/**
 * Description of TraceFile
 *
 * @author shishire
 */
class TraceFile
{
    /**
     *
     * @var array The raw contents of the file.
     */
    private $unprocessed;

    /**
     *
     * @var FunctinoMain The root (main) level function.  Forms the root node of a doubly linked tree structure.
     */
    private $main_function;

    public function __construct($filename) {
        $this->unprocessed = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if($this->unprocessed === false)
        {
            throw new RuntimeException('File not processable: '.$filename);
        }
        if(count($this->unprocessed) === 0)
        {
            throw new RuntimeException("File empty: ".$filename);
        }

        $this->parse($this->unprocessed);
    }
    private function parse($lines)
    {
        $version = array_shift($lines);
        $format = array_shift($lines);
        $start = array_shift($lines);
        $end = array_pop($lines);

		$main = array_shift($lines);
		$current_function = new FunctionInstance(new FunctionEventCall(self::read_line($main)));
        $this->main_function = $current_function;
        
        // Assumes perfect hierarchy.  Don't disappoint it.
        // Probably does not handle exceptions correctly.
        // TODO: Don't assume a perfect world.
        foreach($lines as $line_num => $line)
        {
			$parsed_line = self::read_line($line);

			if(self::is_call($parsed_line))
			{
				$current_function = $current_function->do_call(new FunctionEventCall($parsed_line));
			}
			else
			{
				$current_function = $current_function->do_return(new FunctionEventReturn($parsed_line));
			}
            
            // Currently doesn't handle Uncaught Exceptions or Errors.
            if($current_function === null)
                break;
        }
    }
	public static function read_line($line)
	{
        $parsed_line = array();
        $fields = explode("\t", $line);
	
		$parsed_line['level']           = array_shift($fields);
		$parsed_line['function_number'] = array_shift($fields);
		$parsed_line['entry']           = array_shift($fields);
		$parsed_line['time']            = array_shift($fields);
		$parsed_line['memory']          = array_shift($fields);
        
		if(count($fields))
		{
			$parsed_line['function_name'] = array_shift($fields);
			$parsed_line['user_defined']  = array_shift($fields);
			$parsed_line['include_file']  = array_shift($fields);
			$parsed_line['filename']      = array_shift($fields);
			$parsed_line['line_number']   = array_shift($fields);
            $parsed_line['unknown']       = array_shift($fields);
		}
		
		if(count($fields))
		{
			$parsed_line['params'] = $fields;
		}

        return $parsed_line;
	}
	private static function is_call($parsed_line)
	{
        // Because it's still a string.
		if($parsed_line['entry'] === "0")
			return true;
		else
			return false;
	}

    public function get_main()
    {
        return $this->main_function;
    }
}

?>
