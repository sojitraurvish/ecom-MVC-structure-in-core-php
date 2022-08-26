<?php

Class Logout extends Controller
{
    public function index($a='',$b='')
    {
        $User=$this->load_model("User");
        $User->logout();
    }

}

?>