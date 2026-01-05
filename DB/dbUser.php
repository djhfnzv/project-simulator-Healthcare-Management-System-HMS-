<?php
    $host   = '127.0.0.1';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'project';

    function connection()
    {
        global $host, $dbuser, $dbpass, $dbname;

        $con = mysqli_connect($host, $dbuser, $dbpass, $dbname);

        return $con;
    }
?>