<?php

// abstract class for controllers
abstract class BaseController implements IController
{
    protected $model; 
    public function __construct($nameOfModel) 
    {
       
        if (!is_string($nameOfModel))
        {
             throw new Exception('In BaseController constr argument must be string');
        }

        $this->model = ModelFactory::CreateModel($nameOfModel);
    }
}

