<?php

Class Login extends Controller
{
    public function index($a='',$b='')
    {
        // echo $a,$b;
        // $this->view("home");
        $data["page_title"]="Login";

        // show($_POST);
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //show($_POST);
            $user=$this->load_model("User");
            $user->login($_POST);
        }
        $this->view(CUSTOMER_DIR,"login",$data);
    }

}

?>