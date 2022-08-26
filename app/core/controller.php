<?php

Class Controller
{
    public function view($directory,$file,$data=[])
    {
        if(file_exists("../app/views/".$directory.$file.".php"))
        {
            include "../app/views/".$directory.$file.".php";
        }
        else
        {
            include "../app/views/".$directory."404.php";
        }
    }
    
    public function load_model($model)
    {
        if(file_exists("../app/models/".strtolower($model).".class.php"))
        {
            include "../app/models/".strtolower($model).".class.php";
            return $a=new $model;
        }
        
        return false;
    }
}
?>