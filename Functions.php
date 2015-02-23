<?php

    function loginCheck()
    {
        include('Config.php');
        if(isset($_COOKIE['user']) && isset($_COOKIE['pass']))
        {
            $con = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
            mysql_select_db($Database, $con) or die ("Database Error");
            $query = "SELECT * FROM `LOGIN` where USERID ='".mysql_real_escape_string($_COOKIE['user'])."'";
            $result = mysql_query($query, $con);
            if($row = mysql_fetch_row($result))
            {
                 if ( ($_COOKIE['pass']== $row[1]) && ($_COOKIE['type'] == $row[2] ))
                             	return True;              
            }
        }
        
        return False;             
    }
    
    function logout()
    {
        include('Config.php');
        if(isset($_COOKIE['user']))
            setcookie('user','',(time()-$Duration));

        if(isset($_COOKIE['pass']))
            setcookie('pass','',(time()-$Duration));

        if(isset($_COOKIE['type']))
            setcookie('type','',(time()-$Duration));
    }
    
    function loginUser($usn,$pass)
    {
        logout();
        include('Config.php');
        $con    = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
        mysql_select_db($Database, $con) or die ("Database Error");
        $usn    = mysql_real_escape_string($usn);
        $pass   = mysql_real_escape_string($pass);
        $query  = "SELECT * FROM `LOGIN` where USERID ='$usn'";
        $result = mysql_query($query, $con);
        if($row = mysql_fetch_row($result))
        {
             if ($row[1] == md5(trim($pass).$Salt)) 
              {
                    setcookie('user',$usn,(time()+$Duration));
                    setcookie('pass',$row[1],(time()+$Duration));
                    setcookie('type',$row[2],(time()+$Duration));
                    return True;
              }              
        }
        
        return False;
    }

?>
