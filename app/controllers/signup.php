<?php

Class Signup extends Controller
{
    public function index($a='',$b='')
    {
        // echo $a,$b;
        // $this->view("home");
        $data["page_title"]="signup";

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //show($_POST);
            $user=$this->load_model("User");
            $user->signup($_POST);
        }
        $this->view(CUSTOMER_DIR,"signup",$data);
    }

}

?>