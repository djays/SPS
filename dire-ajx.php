<?php
        include('Config.php');                                                  //Main Configuration File
        include('Functions.php');                                               // Common Defined PHP Functions
        if(loginCheck() || ( isset($_COOKIE['type']) && ($_COOKIE['type'] == 'D')))                            // Main PHP Content In Here
        {    if(isset($_GET['id']))
            {
                $con    = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
                mysql_select_db($Database, $con) or die ("Database Error");                                
                switch($_GET['id'])
                {                
                 case 1: 
                        echo '<h2 class="form-head"> VIEW SESSIONAL MARKS</h2><br>';
                        echo '<h4> Select Department </h4>';
                        echo '<form>';
                        echo "<div class='form-field afill-overide'><select class='autofill-combo' id='dept' >";
                        echo "<option>--Select--</option>";
                        $res=  mysql_query('SELECT DISTINCT(DEPT) FROM STUDENT WHERE REGNO IN ( SELECT DISTINCT(REGNO) FROM `SESS_MARKS`)',$con);
                        while($row = mysql_fetch_row($res))
                            echo "<option>".trim($row[0])."</option>";
                        echo "</select></div>";          
                        echo "<div class='form-submit'> <input type='button' class='ajx-button' value='Get' onclick='sessfromDir()'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></form>";                                  
                 break;
                case 2:
                        echo '<h2 class="form-head"> VIEW SEMESTER GRADES</h2><br>';
                        echo '<h4> Select Department </h4>';
                        echo '<form>';
                        echo "<div class='form-field afill-overide'><select class='autofill-combo' id='dept' >";
                        echo "<option>--Select--</option>";
                        $res=  mysql_query('SELECT DISTINCT(DEPT) FROM STUDENT WHERE REGNO IN ( SELECT DISTINCT(REGNO) FROM `END_SEM_GRADE`)',$con);
                        while($row = mysql_fetch_row($res))
                            echo "<option>".trim($row[0])."</option>";
                        echo "</select></div>";        
                        echo "<div class='form-submit'> <input type='button' class='ajx-button' value='Get' onclick=gradefromDir()> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></form>";                                    
                break;
                }
                 echo '<script>$(".autofill-combo").sexyCombo({autoFill: true}); </script>';        
                 
            }
    }
