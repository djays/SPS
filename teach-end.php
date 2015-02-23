<?php
        include('Config.php');                                                  //Main Configuration File
        include('Functions.php');                                               // Common Defined PHP Functions
        if(loginCheck() || ( isset($_COOKIE['type']) && ($_COOKIE['type'] == 'T')))                            // Main PHP Content In Here
        {    if(isset($_GET['id']))
            {
                $con    = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
                mysql_select_db($Database, $con) or die ("Database Error");
                $usn = $_COOKIE['user'];
                switch($_GET['id'])
                {                
                 case 1: 
                        $dept = mysql_real_escape_string($_POST['dept']);
                        $sec = mysql_real_escape_string($_POST['sec']);
                        $sem = mysql_real_escape_string($_POST['sem']);
                        $sub = mysql_real_escape_string($_POST['sub']);
                        echo "<h2 class='form-head'>Enter Sessional Marks</h2>";
                        $res = mysql_query("SELECT REGNO ,NAME FROM STUDENT WHERE dept='$dept' AND sem = '$sem' AND sec = '$sec' ",
$con);           
                        echo "<br><div class='wrapper'><b>  RegNo </b>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";                        
                        echo " <b>Name</b>";
                        echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>1</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> 2</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>3</b>";
                        echo "</div>";
                        echo " <ul id='sessMarks'>";       
                        while($row = mysql_fetch_row($res))
                        {
                            echo "<li><span onclick=getSesMarks('{$row[0]}','{$sub}')>{$row[0]} &nbsp;&nbsp; - &nbsp;&nbsp; {$row[1]}</span>";
                            echo "<br><div class='invisible' id='li{$row[0]}'></div></li>";
                        }
                        echo "</ul>";
                 break;
                 case 2:
                        $reg = mysql_real_escape_string($_POST['reg']);
                        $sub = mysql_real_escape_string($_POST['sub']);
                        $res = mysql_query("SELECT MARKS FROM SESS_MARKS WHERE REGNO='$reg' AND SUBCODE = '$sub' AND SESS=1",$con);
                        $s1 = 0;
                        if ($row = mysql_fetch_row($res))
                        {
                            $s1 = $row[0];
                        }
                        $res = mysql_query("SELECT MARKS FROM SESS_MARKS WHERE REGNO='$reg' AND SUBCODE = '$sub' AND SESS=2",$con);
                        $s2 = 0;
                        if ($row = mysql_fetch_row($res))
                        {
                            $s2 = $row[0];
                        }
                        $res = mysql_query("SELECT MARKS FROM SESS_MARKS WHERE REGNO='$reg' AND SUBCODE = '$sub' AND SESS=3",$con);
                        $s3 = 0;
                        if ($row = mysql_fetch_row($res))
                        {
                            $s3 = $row[0];
                        }
                        
                        echo "<br><form id='frm$reg'>";
                        echo "<input type='text class='form-input2' id='marksSess1' value=$s1 onclick=return false><input type='text class='form-input2' value=$s2 id='marksSess2'><input type='text class='form-input2' id='marksSess3' value=$s3></form>";
                        echo "<input type=button class='ajx-button' value='Save' onclick=saveMarks('$reg','$sub')>";
                        echo "<img class='done' src='Resources/done.png'>";
                        echo "</form>";
                        
                break;
                case 3:
                        $sub = mysql_real_escape_string($_POST['sub']);
                        $reg = mysql_real_escape_string($_POST['reg']);
                        $m1 = mysql_real_escape_string($_POST['m1']);                     
                        $m2 = mysql_real_escape_string($_POST['m2']);
                        $m3 = mysql_real_escape_string($_POST['m3']);
                        mysql_query("DELETE FROM SESS_MARKS WHERE REGCODE = '$reg' AND SUBCODE = '$sub'",$con);
                        mysql_query("INSERT INTO SESS_MARKS VALUES ('$reg',1,'$sub',$m1),('$reg',2,'$sub',$m2),('$reg',3,'$sub',$m3)",$con) or die("ERROR");
                        echo "DONE";
                break;
                }
            }
        }
