<?php

    define("WEBSITE_TITLE","MY SHOP");
    define("DB_NAME","eshop_db");
    define("DB_USER","root");
    define("DB_PASS","");
    define("DB_TYPE","mysql");
    define("DB_HOST","localhost");
    
    //(assset and view)'s directory name for admin,customer,user
    define("CUSTOMER_DIR","customer/");
    define("USER_DIR","user/");
    define("ADMIN_DIR","admin/");
    
    
    define("DEBUG",true);

    if(DEBUG)
    {
        ini_set('display_errors',1);
    }
    else
    {
        ini_set('display_errors',0);
    }

?>