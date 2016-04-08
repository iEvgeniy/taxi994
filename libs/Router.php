<?php

// class which routes all queries of the site
class Router 
{
    private $url;
    private $userError; 
    private $controller;
    
   public function __construct() 
    {
      if (isset($_GET['url'])) 
      {
        $this->url = $_GET['url'];
        $this->url  = trim($this->url, '/');
        $this->url = explode('/', $this->url);
       }
    }
       

//    if you enter an incorrect URL it will be displayed error
    private function error() 
    {
        require 'controllers/error.php';
        $this->userError = new Error();
        $this->userError->index();
        return false;
    }
    
    // interface of routes
    public function  run()
    {
        $this->logic();
    }
    
    //logic of routes. Used in method 'run'
    private function logic()
    {
        
        if ($this->isEmptyQuery())
        {
            
            return;
        }
       
        $this->ControllerInitializationLogic();
        $this->MethodAndArgumentLogic();
    }
    
    // get bool info is query empty or not
    private function  isEmptyQuery()
    {
        
        if( !$this->url )
        {
            require_once 'controllers/index.php';
            $indexController = new Index();
            $indexController->index();
            return true;
        }
          return false;   
    }
    
    // logic of set controllers
    private function  ControllerInitializationLogic()
    {
        $loadedFile = 'controllers/' .  $this->url[CONTROLLER] . '.php';
        if (file_exists($loadedFile)) 
        {
            require_once $loadedFile;
        } 
        else 
        {
            $this->error();
            die;
        }
        $this->controller = new $this->url[CONTROLLER]();
    }
    
    
    // logic which calls methods and set them arguments if they exist
    private function MethodAndArgumentLogic ()
    {
         if (!isset($this->url[METHOD]))
         { 
             $this->controller->index();
             return false;
         }
         else if (isset($this->url[METHOD]) && method_exists($this->controller, $this->url[METHOD]))
        {
            
            if ( count($this->url) == ARGUMENT + 1) 
            {
                $this->controller->{$this->url[METHOD]}($this->url[ARGUMENT]);
                return;
            } 
            else if ( count($this->url) ==SECOND_ARGUMENT + 1 ) 
            {
                $this->controller->{$this->url[METHOD]}($this->url[ARGUMENT], $this->url[SECOND_ARGUMENT]);
                return;
            }
            $string = $this->url[METHOD];
            if ($string != 'index')
                $this->controller->{ $this->url[METHOD] }();
            else
                $this->controller->index();
        }
        else 
        {
            $this->error();
            die;
        }
    }
}

