<?php
        include('Config.php');                                                  //Main Configuration File
        include('Functions.php');                                               // Common Defined PHP Functions
        if(loginCheck() || ( isset($_COOKIE['type']) && ($_COOKIE['type'] == 'DA')))                           
        {    if(isset($_POST['id']))
            {
                $con    = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
                mysql_select_db($Database, $con) or die ("Database Error");
                switch($_POST['id'])
                {
                case 1:
                        $emp = mysql_real_escape_string($_POST['emp']);
                        $sec = mysql_real_escape_string($_POST['sec']);
                        $sem = mysql_real_escape_string($_POST['sem']);
                        $sub = mysql_real_escape_string($_POST['sub']);
                        $year = mysql_real_escape_string($_POST['year']);
                        $dept = mysql_real_escape_string($_POST['dept']);
                        $sec = strtoupper($sec);
                        $dept = strtoupper($dept);
                        mysql_query("INSERT INTO TSMAP VALUES('$emp','$sub','$sem','$sec','$dept','$year')",$con);
                        echo "<center><h2>Entry Added !!!</h2></center>";
                        break;
                case 2:
                        $reg = mysql_real_escape_string($_POST['reg']);
                        $sem = mysql_real_escape_string($_POST['sem']);
                        $dept = substr($_COOKIE['user'],10,strlen($_COOKIE['user']));
                        $res = mysql_query("SELECT SUBCODE , SUBNAME FROM INFO WHERE DEPT = '$dept' AND SEM ={$sem} ORDER BY SEM ",$con);
                        while($row= mysql_fetch_row($res))
                        {
                        echo "<div class='form-field2'><label class='form-label' >{$row[0]} - {$row[1]} </label> <input class='form-input2 required ucase' type='text' id='grade' name='grade'></div>";
                        echo "<input type=hidden name='subcode' id='subcode' value='{$row[0]}'>";

                        }
                        echo "<div class='form-submit'> <input type='button' class='ajx-button' value='Submit' onclick='validate6()'>   <input type='reset' class='ajx-button' value='Reset'> </div></form>";
                        break;
                case 3:
                        $i=0;
                        $len = count($_POST['grades']);
                        $grades = $_POST['grades'];
                        $subcodes = $_POST['subcodes'];
                        $regcode = $_POST['regcode'];
                        while($i<$len)
                        {
                            $grades[$i] = strtoupper($grades[$i]); 
                            mysql_query("DELETE  FROM END_SEM_GRADE WHERE REGNO = '$regcode' AND SUBCODE = '{$subcodes[$i]}'",$con) or die(mysql_error());
                            mysql_query("REPLACE INTO END_SEM_GRADE VALUES('$regcode','{$subcodes[$i]}','{$grades[$i]}')",$con) or die(mysql_error());
                            $i+=1;
                        }
                        echo "<h2><center>GRADES UPDATED!!</center></h2>";
                        break;
                }

            }
       }
        else
        {
            echo "<center>Please login</center>";
        }
?>
