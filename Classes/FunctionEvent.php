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
class TraceFileLineBase
{

    private $level;
    private $function_number;
    private $time;
    private $memory;

    public static function new_line($line) {
        //Slightly hacky way to get it to recognize the difference between entry and exit lines.
        $temp = explode("\t", $line);
        if($temp[3] == 0)
        {
            return new TraceFileLineEntry($line);
        }
        else
        {
            return new TraceFileLineExit($line);
        }
    }

}

?>
