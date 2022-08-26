<?php

Class App
{
    protected $controller="home";
    protected $method="index";
    protected $params;

    private function parseURL()
    {
        $url=isset($_GET['url']) ? $_GET['url'] : "home" ;
        return explode("/",filter_var(trim($url,"/"),FILTER_SANITIZE_URL));
    }

    public function __construct()
    {
        $url=$this->parseURL();    //if url is localhost/eshop/home/index/d1/d2
        // show($url);

        //to check controller or file name is exists or not
        $url[0]=strtolower($url[0]);
        if(file_exists("../app/controllers/".$url[0].".php"))
        {
            $this->controller=$url[0];
            unset($url[0]);
        }
        require "../app/controllers/".$this->controller.".php";
        $this->controller=new $this->controller;

        //show($url); 

        //to check inside above created class having that method or not
        if(isset($url[1]))
        {
            //method_exists(object,method_name); 
            $url[1]=strtolower($url[1]);
            if(method_exists($this->controller,$url[1]))
            {
                $this->method=$url[1];
                unset($url[1]);
            }
        }

        $this->params=(count($url)>0) ? $url : ["home"];
        //array_values($arr) create new array from index 0
        // show(array_values($url)); 
        call_user_func_array([$this->controller,$this->method],$this->params);
        
    }

    
}

?>