<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('app_log')) {
    function app_log($arg) {
        //this is the log file
        $log = './applog.htm';
        
        //to empty the file and start over the first call should begin with init_log
        if(preg_match("/^init_log/", $arg)) {
            //writes the file name and whatever the arg is at the start of the file
            if(!write_file($log, ''.$arg, 'w')) {
                //or dies
                die('Unable to write to log file.');
            }
        } else {
            //adds whatever the $arg is to the end of the file
            if(!write_file($log, ''.$arg, 'a+')) {
                //or dies
                die('Unable to write to log file.');
            }
        }
    }
}
