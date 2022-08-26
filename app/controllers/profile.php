<?php

Class Profile extends Controller
{
    public function index($a='',$b='')
    {
        $User=$this->load_model("User");
        $user_data=$User->check_login(true);
        if(is_object($user_data))
        {
            $data['user_data']=$user_data;
        }
        // echo $a,$b;
        // $this->view("home");
        $data["page_title"]="Profile";
        $this->view(CUSTOMER_DIR,"profile",$data);
    }

}

?>