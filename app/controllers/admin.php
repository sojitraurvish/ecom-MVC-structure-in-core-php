<?php

Class Admin extends Controller
{
    public function index($a='',$b='')
    {
        $User=$this->load_model("User");
        $user_data=$User->check_login();
        if(is_object($user_data))
        {
            $data['user_data']=$user_data;
        }
        // echo $a,$b;
        // $this->view("home");
        $data["page_title"]="Admin";
        $this->view(ADMIN_DIR,"index",$data);
    }

}

?>