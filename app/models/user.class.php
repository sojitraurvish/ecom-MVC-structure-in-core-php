<?php

Class User
{
    private $error="";

    public function signup($POST)
    {
        $data=array();
        $db=Database::getInstance();

        $data["name"]=trim($POST['name']);
        $data["email"]=trim($POST['email']);
        $data["password"]=trim($POST['password']);
        $password2=trim($POST['password2']);

        if(empty($data["email"]) || !preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z]+.[a-zA-Z]+$/",$data["email"]))
        {
            $this->error.="Please enter a valid email <br>";
        }
        
        if(empty($data["name"]) || !preg_match("/^[a-zA-Z]+$/",$data["name"]))
        {
            $this->error.="Please enter a valid name <br>";
        }
        
        if($data["password"] !== $password2)
        {
            $this->error.="Password do not match <br>";
        }

        if(strlen($data["password"]) < 4)
        {
            $this->error.="Password must be 4 character long <br>";
        }

        //check if email is already exists or not
        $sql="select * from users where email=:email limit 1";
        $arr['email']=$data['email'];
        $check=$db->read($sql,$arr);
        if(is_array($check))
        {
            $this->error.="This email is already exists <br>";
        }

        //check for url_address 
        $data["url_address"]=$this->get_random_siring_max(60);
        
        $arr=false;
        $sql="select * from users where url_address=:url_address limit 1";
        $arr['url_address']=$data['url_address'];
        $check=$db->read($sql,$arr);
        if(is_array($check))
        {
            $data["url_address"]=$this->get_random_siring_max(60);
            //$this->error.="This email is already exists <br>";
        }

        if($this->error == "")
        {
            $data["rank"]="customer";
            
            $data["date"]=date("Y-m-d H:i:s"); 
            $data["password"] =hash('sha1',$data["password"] );
            $query="insert into users(url_address,name,email,password,rank,date) values(:url_address,:name,:email,:password,:rank,:date)";
            
            $result=$db->write($query,$data);
            
            if($result)
            {
                header("Location:".ROOT."login");
                die();
            }
        }

        $_SESSION['error']=$this->error;
    }

    public function login($POST)
    {
        $data=array();
        $db=Database::getInstance();

        $data["email"]=trim($POST['email']);
        $data["password"]=trim($POST['password']);
         

        if(empty($data["email"]) || !preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z]+.[a-zA-Z]+$/",$data["email"]))
        {
            $this->error.="Please enter a valid email <br>";
        }
        
        if(strlen($data["password"]) < 4)
        {
            $this->error.="Password must be 4 character long <br>";
        }

        

        if($this->error == "")
        {
            //conform
            
            $data["password"] =hash('sha1',$data["password"] );
            
            //check if email is already exists or not
            $sql="select * from users where email=:email and password=:password limit 1";
            $result=$db->read($sql,$data);
            if(is_array($result))
            {
                // foreach($rows as $row) {
                    
                //     $_SESSION['URL_ADDRESS']=$row["url_address"];
                //     // show($rows);
                //     // show($_SESSION['URL_ADDRESS']);
                //     // die();
                //     header("Location:".ROOT."home");
                //     die();
                //   }

                $_SESSION['URL_ADDRESS']=$result[0]->url_address;
                
                header("Location:".ROOT."home");
                die();
            }

            $this->error.="Wrong Email Or Password <br>";
            
        }

        $_SESSION['error']=$this->error;
    }

    public function check_login($redirect=false)
    {
        if(isset($_SESSION["URL_ADDRESS"]))
        {
            $arr['url_address']=$_SESSION["URL_ADDRESS"];
            $query="select * from users where url_address=:url_address";
            $db=Database::getInstance();

            $result=$db->read($query,$arr);

            if(is_array($result))
            {
                return $result[0];
            }

            
        }

        if($redirect)
            {
                header("Location:".ROOT."login");
                die();
            }
        
        return false;
    }

    public function logout()
    {
        if(isset($_SESSION['URL_ADDRESS']))
        {
            unset($_SESSION["URL_ADDRESS"]);
        }
    
        header("Location:".ROOT."home");
        die();
    }
    
    public function get_user($url)
    {

    }

    private function get_random_siring_max($length)
    {
        $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $text="";

        $length=rand(4,$length);

        for($i=0;$i<$length;$i++)
        {
            $random=rand(0,61);

            $text .= $array[$random];
        }

        return $text;

    }

}