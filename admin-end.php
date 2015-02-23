<?php
        include('Config.php');                                                  //Main Configuration File
        include('Functions.php');                                               // Common Defined PHP Functions
        if(loginCheck() || ( isset($_COOKIE['type']) && ($_COOKIE['type'] == 'A')))                           
        {    if(isset($_POST['id']))
            {
                $con    = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
                mysql_select_db($Database, $con) or die ("Database Error");
                switch($_POST['id'])
                {
                 case 1:
                        $dept = mysql_real_escape_string($_POST['Dept']);
                        $gid = mysql_real_escape_string($_POST['GID']);
                        $name = mysql_real_escape_string($_POST['Name']);
                        $sec = mysql_real_escape_string($_POST['Sec']);
                        $sem = mysql_real_escape_string($_POST['Sem']);
                        $regno = mysql_real_escape_string($_POST['regno']);
                        $res = mysql_query("SELECT * FROM STUDENT WHERE REGNO = '$regno'",$con);
                        if ($row = mysql_fetch_row($res) )
                            die('This Registration Number is already present in the database');
                        $query="INSERT INTO STUDENT (`REGNO`,`NAME`,`DEPT`,`SEM`,`SEC`,`GID`) VALUES('$regno','$name','$dept',$sem,'$sec','$gid')";
                        mysql_query($query,$con) or die(mysql_error());
                        echo "<center><h2>Entry Added to Database!</h2></center>";                   
                        break;
                case 2:
                        $dept = mysql_real_escape_string($_POST['Dept']);
                        $empcode = mysql_real_escape_string($_POST['empcode']);
                        $name = mysql_real_escape_string($_POST['Name']);
                        $res = mysql_query("SELECT * FROM TEACHER WHERE EMPCODE = '$empcode'",$con);
                        if ($row = mysql_fetch_row($res) )
                            die('This Employee Number is already present in the database');
                        $query="INSERT INTO TEACHER (`EMPCODE`,`NAME`,`DEPT`) VALUES('$empcode','$name','$dept')";
                        mysql_query($query,$con) or die(mysql_error());
                        echo "<center><h2>Entry Added to Database!</h2></center>";                   
                        break;
                case 3:
                        $gid = mysql_real_escape_string($_POST['GID']);
                        $name = mysql_real_escape_string($_POST['Name']);
                        $res = mysql_query("SELECT * FROM GUARDIAN WHERE GID = '$gid'",$con);
                        if ($row = mysql_fetch_row($res) )
                            die('This Employee Number is already present in the database');
                        $query="INSERT INTO GUARDIAN (`GID`,`NAME`) VALUES('$gid','$name')";
                        mysql_query($query,$con) or die(mysql_error());
                        echo "<center><h2>Entry Added to Database!</h2></center>";                   
                        break;
                case 4:
                        $usern = mysql_real_escape_string($_POST['usern']);
                        $pass = mysql_real_escape_string($_POST['Pass']);
                        $chk = substr($usern,0,1);
                        $type = '';
                        switch($chk)
                        { 
                            case 'M': $type='T'; break;
                            case 'H': $type='H'; break;    
                            case '0': $type='S'; break;       
                        }
                        if ($usern == 'Director')
                            $type='D';
                        if (substr($usern,0,4) == 'Dept')
                            $type ='DA';

                        $res = mysql_query("SELECT * FROM LOGIN WHERE USERID = '$usern'",$con);
                        if ($row = mysql_fetch_row($res) )
                            die('This Login is already present in the database');
                        $pass = md5(trim($pass).$Salt);
                        $query="INSERT INTO LOGIN VALUES('$usern','$pass','$type')";
                        mysql_query($query,$con) or die(mysql_error());
                        echo "<center><h2>Entry Added to Database!</h2></center>";                   
                        echo "<br><br><center>UserName : $usern </center>";
                        break;
                }
            }   
       }
        else
        {
            echo "<center>Please login</center>";
        }
?>
