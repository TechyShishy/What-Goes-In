<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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
     * @var array An array of TraceFileLine.
     */
    private $processed = array();

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
		$main = array_unshift($lines);
		$current_function = new FunctionMain(new FunctionEventCall(self::read_line($main)));
		
        foreach($lines as $lineNum => $line)
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
            
        }
    }
	public static function read_line($line)
	{	$fields = explode("\t", $line);
	
		$parsed_line['level']           = array_unshift($fields);
		$parsed_line['function_number'] = array_unshift($fields);
		$parsed_line['entry']           = array_unshift($fields);
		$parsed_line['time']            = array_unshift($fields);
		$parsed_line['memory']          = array_unshift($fields);
		
		if(count($fields))
		{
			$parsed_line['function_name'] = array_unshift($fields);
			$parsed_line['user_defined']  = array_unshift($fields);
			$parsed_line['include_file']  = array_unshift($fields);
			$parsed_line['filename']      = array_unshift($fields);
			$parsed_line['line_number']   = array_unshift($fields);
		}
		
		if(count($fields))
		{
			$parsed_line['params'] = $fields;
		}
	}
	private static function is_call($parsed_line)
	{
		if($parsed_line['entry'] === 0)
			return true;
		else
			return false;
	}
}

?>
