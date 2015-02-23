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
                        echo '<h2 class="form-head"> ADD SESSIONAL MARKS</h2><br>';
                        echo "<h4>Choose Subjet</h4>";
                        $res = mysql_query("SELECT T.SUBCODE,I.SUBNAME,T.SEM,T.SEC,T.DEPT,T.YEAR FROM TSMAP T , INFO I WHERE T.EMPCODE = '$usn' AND  I.SUBCODE = T.SUBCODE",$con);

                        while($row = mysql_fetch_row($res))
                        {
                         echo "<div class='form-field3' onclick=getContents('{$row[0]}',{$row[2]},'{$row[3]}','{$row[4]}')>{$row[0]} &nbsp;&nbsp;&nbsp;&nbsp;{$row[1]} <br><span id='lshift'> {$row[4]} - {$row[2]} - {$row[3]}</span><span id='rshift'> {$row[5]}</span></div>";
                        }

                 break;
                }
            }
        }
