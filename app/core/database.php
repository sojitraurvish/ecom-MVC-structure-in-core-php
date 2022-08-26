<?php

Class Database
{
    /*
    *
    *This is database calls
    *
    */
    public static $con;
    
    public function __construct()
    {
        try{
            $string=DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME;
            self::$con = new PDO($string,DB_USER,DB_PASS );
        }
        catch(PDOException $e)
        {
            die ($e->getMessage());
        }
    } 

    public static function getInstance()
    {
        if(self::$con)
        {
            return self::$con;
        }   
        
        return $instance =new self();
        //return self::$con;
    }

    /*
    *
    *read from database
    *
    */

    public function read($query,$data=array())
    {
        //https://phpdelusions.net/pdo/fetch_modes#:~:text=I%20decided%20to%20take%20the,possible%20return%20formats%20even%20mere.
        $stm=self::$con->prepare($query);
        $rows=$stm->execute($data);

        if($rows)
        {
            $data=$stm->fetchAll(PDO::FETCH_OBJ);//PDO::FETCH_ASSOC
            if(is_array($data) && count($data) >0)
            {
                return $data;
            }
        }

        return false;
        
    }

    /*
    *
    *wrire from database 
    *
    */
    public function write($query,$data=array())
    {
        $stm=self::$con->prepare($query);
        $result=$stm->execute($data);

        if($result)
        {
            return true;
        }

        return false;
    }

}

// $db=Database::getInstance();

// $data=$db->read("describe users");
// show($data);
?>

<?php
// public static function getInstance()
    // {
    //     if(!self::$con)
    //     {
    //         try{
    //                 $string=DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME;
    //                 self::$con = new PDO($string,DB_USER,DB_PASS );
    //                 return self::$con;
    //         }
    //         catch(PDOException $e)
    //         {
    //             die ($e->getMessage());
    //         }
    //     } 

    //     return self::$con;
    // }
?>