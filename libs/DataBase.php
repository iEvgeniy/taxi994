<?php


// base class for models which connect to database
abstract class DataBase extends PDO
{
    function __construct() 
    {
        try 
        {
             parent::__construct(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS); 
        }
        catch (Exception $err )
        {
            print $err;
        }
    }

}


