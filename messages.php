<?php
        include('Config.php');                                                  //Main Configuration File
        include('Functions.php');                                               // Common Defined PHP Functions
        if(loginCheck() || ( isset($_COOKIE['type']) && ($_COOKIE['type'] == 'G' || $_COOKIE['type'] == 'T')))                            // Main PHP Content In Here
        {    if(isset($_GET['id']))
            {
                $con    = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
                mysql_select_db($Database, $con) or die ("Database Error");
                $usn = trim(mysql_real_escape_string($_COOKIE['user']));
                $type = $_COOKIE['type'];
                switch($_GET['id'])
                {                
                case 0:  echo "<div class='sem-tabs'><ul>";
                         echo "<li><a href='messages.php?id=1'>SEND NEW</a></li>";
                         echo "<li><a href='messages.php?id=2'>INBOX</a></li>";
                         echo "<li><a href='messages.php?id=3'>OUTBOX</a></li>";
                         echo "</ul></div>";
                break;
                case 1:
                         echo "<h4> <b>Enter Message for Recepient</b></h4>";
                         
                         if($type = 'T')
                            $res =  mysql_query("SELECT GID,NAME FROM GUARDIAN",$con);
                         else
                            $res = mysql_query("SELECT EMPCODE,NAME FROM TEACHER",$con);
                         echo "<form id='frm1'><div class='form-field afill-overide'><select id='address' class='autofill-combo'><option>--Select--</option>";
                         while($row = mysql_fetch_row($res))
                        {
                            echo "<option>{$row[0]} -- {$row[1]}</option>";
                            
                        }
                        echo "</select></div>";
                        echo "<div class='msg-field'><textarea id='msg'></textarea></div><br>";
                        echo "<div class='form-submit'><input type=button class='ajx-button' value='Send' onclick='sendMsg()'></div></form>";
                break;
                case 2:
                        if($type=='G')                            
                            $res = mysql_query("SELECT TEACHER.EMPCODE, NAME, MESSAGE FROM TEACHER JOIN MESSAGES ON TEACHER.EMPCODE = MESSAGES.EMPCODE AND GID = '$usn' AND TYPE=1",$con);
                        else
                            $res = mysql_query("SELECT GUARDIAN.GID, NAME, MESSAGE FROM GUARDIAN JOIN MESSAGES ON GUARDIAN.GID = MESSAGES.GID AND EMPCODE = '$usn' AND TYPE=0",$con);
                       while($row = mysql_fetch_row($res))
                       {
                        echo "<div class='msg-box'><img src='img.php?id={$row[0]}' height=66px width=102px><span class='msg-content'><span class='msg-from'>From {$row[0]} -- {$row[1]}</span><br><span class='msg-text'>{$row[2]}</span> </span></div><br>";
                
                       }

                break;
                case 3:
                        if($type=='G')                            
                            $res = mysql_query("SELECT TEACHER.EMPCODE, NAME, MESSAGE FROM TEACHER JOIN MESSAGES ON TEACHER.EMPCODE = MESSAGES.EMPCODE AND GID = '$usn' AND TYPE=0",$con);
                        else
                            $res = mysql_query("SELECT GUARDIAN.GID, NAME, MESSAGE FROM GUARDIAN JOIN MESSAGES ON GUARDIAN.GID = MESSAGES.GID AND EMPCODE = '$usn' AND TYPE=1",$con);
                       while($row = mysql_fetch_row($res))
                       {
                        echo "<div class='msg-box'><img src='img.php?id={$row[0]}' height=66px width=102px><span class='msg-content'><span class='msg-from'>To {$row[0]} -- {$row[1]}</span><br><span class='msg-text'>{$row[2]}</span> </span></div><br>";
                
                       }


                break;
                case 4:
                        $add = mysql_real_escape_string($_POST['add']);
                        $msg = htmlentities(mysql_real_escape_string($_POST['msg']));
                        if ($type == 'G')
                            mysql_query("INSERT INTO MESSAGES (GID,EMPCODE,TYPE,MESSAGE) VALUES ('$usn','$add',0,'$msg')",$con);
                        else if ($type == 'T')
                            mysql_query("INSERT INTO MESSAGES (GID,EMPCODE,TYPE,MESSAGE) VALUES ('$add','$usn',1,'$msg')",$con);
                        echo "DONE";
                break;
                }
                 echo "<script>$('.sem-tabs').tabs();$('.autofill-combo').sexyCombo({autoFill: true}); </script>";        
     
            }
    }
