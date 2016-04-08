<?php

//This is index controller class. Loads index page of the site
class Index extends BaseController
{
    public function __construct() 
    {
        parent::__construct("View");
    }
    
    // index page
    public function index()
    {
        $this->model->display('index/index');
    }
    
}

