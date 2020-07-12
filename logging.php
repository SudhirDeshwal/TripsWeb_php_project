<?php

function fileLog($log_msg) {
 
    // $log_filename = $_SERVER['DOCUMENT_ROOT']."/log";
    $log_filename = "./log";
  
    if (!file_exists($log_filename))
    { 
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
    file_put_contents($log_file_data,  date("F j, Y, g:i a : ") . $log_msg . "\n", FILE_APPEND);
}

?>