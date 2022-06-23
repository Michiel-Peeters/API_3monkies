<?php

namespace App\services;

class Logger
{
    private $fp;
    private $logfile;

    public function __construct( $logfile = "log.txt" )
    {
        $this->logfile = $logfile;
        $this->fp = fopen( $this->logfile, "a+");
    }

    public function Log( $msg )
    {
        fwrite( $this->fp, $msg . "\r\n" );
    }

    public function ShowLog()
    {
        return file_get_contents( $this->logfile );
    }
}