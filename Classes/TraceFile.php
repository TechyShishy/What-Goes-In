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
        foreach($lines as $lineNum => $line)
        {
            $this->processed[$lineNum] = TraceFileLineBase::new_line($line);
            
        }
    }
}

?>
