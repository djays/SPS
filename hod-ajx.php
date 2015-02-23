<?php
        include('Config.php');                                                  //Main Configuration File
        include('Functions.php');                                               // Common Defined PHP Functions
        if(loginCheck() || ( isset($_COOKIE['type']) && ($_COOKIE['type'] == 'H' || $_COOKIE['type'] == 'D')))                            // Main PHP Content In Here
        {    if(isset($_GET['id']))
            {
                $con    = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
                mysql_select_db($Database, $con) or die ("Database Error");
                $usn = trim(mysql_real_escape_string($_COOKIE['user']));
                $dept = '';                
                if($_COOKIE['type'] == 'D')
                    $dept = mysql_real_escape_string($_REQUEST['dept']);
                else
                {   
                    $arr = explode('-',$usn);
                    $dept = $arr[1];
                }
                switch($_GET['id'])
                {                
                 case 1: 
                        echo '<h2 class="form-head"> VIEW SESSIONAL MARKS</h2><br>';
                        echo '<h4> Select Student </h4>';
                        echo '<form>';
                        echo "<div class='form-field afill-overide'><select class='autofill-combo' id='reg' >";
                        echo "<option>--Select--</option>";
                        $res=  mysql_query('SELECT distinct(STUDENT.REGNO),NAME FROM `STUDENT` JOIN SESS_MARKS ON STUDENT.REGNO = SESS_MARKS.REGNO',$con);
                        while($row = mysql_fetch_row($res))
                            echo "<option>".trim($row[0])." -- {$row[1]}</option>";
                        echo "</select></div>";          
                        echo "<div class='form-submit'> <input type='button' class='ajx-button' value='Get' onclick=sessfromHod()> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></form>";                                  
                 break;
                case 2:
                        echo '<h2 class="form-head"> VIEW SEMESTER GRADES</h2><br>';
                        echo '<h4> Select Student </h4>';
                        echo '<form>';
                        echo "<div class='form-field afill-overide'><select class='autofill-combo' id='reg' >";
                        echo "<option>--Select--</option>";
                        $res=  mysql_query('SELECT distinct(STUDENT.REGNO),NAME FROM `STUDENT` JOIN END_SEM_GRADE ON STUDENT.REGNO = END_SEM_GRADE.REGNO',$con);
                        while($row = mysql_fetch_row($res))
                            echo "<option>".trim($row[0])." -- {$row[1]}</option>";
                        echo "</select></div>";        
                        echo "<div class='form-submit'> <input type='button' class='ajx-button' value='Get' onclick=gradefromHod()> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></form>";                                    
                break;
                }
                 echo '<script>$(".autofill-combo").sexyCombo({autoFill: true}); </script>';        
                 
            }
    }
