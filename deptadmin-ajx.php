<?php
        include('Config.php');                                                  //Main Configuration File
        include('Functions.php');                                               // Common Defined PHP Functions
        if(loginCheck() || ( isset($_COOKIE['type']) && ($_COOKIE['type'] == 'DA')))                            // Main PHP Content In Here
        {    if(isset($_GET['id']))
            {
                $con    = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
                mysql_select_db($Database, $con) or die ("Database Error");
                switch($_GET['id'])
                {
                
                 case 1: 
                        echo '<h2 class="form-head"> ADD SEMESTER GRADES</h2><br>';
                        echo '<h4> Select Student</h4>';
                        $dept = substr($_COOKIE['user'],10,strlen($_COOKIE['user']));
                        echo '<form>';
                        echo "<div class='form-field afill-overide'><select class='form-input autofill-combo required' id='regno' ><option>--Select--</option>";
                        $res = mysql_query("SELECT REGNO,NAME FROM STUDENT WHERE dept ='$dept'",$con);
                        while($row = mysql_fetch_row($res))
                            echo "<option>".trim($row[0])." -- {$row[1]} </option>";
                        echo "</select></div>";
                        echo "<div class='form-field afill-overide2'><label class='form-label' >Enter Semester</label> <input class='form-input ucase  required' type='text' id='sem' ></div>";
                        echo "</form>";
                        echo "<div class='form-submit'> <input type='button' class='ajx-button' value='Get' onclick=getSubj()>    </div></form>";
                        echo "<br><form><div id='data1'></form></div>";
                 break;
                 case 2:
                        $dept = substr($_COOKIE['user'],10,strlen($_COOKIE['user']));
                        echo '<h2 class="form-head"> SUBJECT MAPPING</h2><br>';
                        echo '<h4> Select Subject </h4>';
                        echo '<form>';
                        echo "<div class='form-field afill-overide'><select class='autofill-combo' id='sub' >";
                        $res = mysql_query("SELECT SUBCODE,SUBNAME FROM INFO WHERE dept ='$dept'",$con);
                        while($row = mysql_fetch_row($res))
                            echo "<option>".trim($row[0])." -- {$row[1]}</option>";
                        echo "</select></div>";

                        echo '<h4> Select Teacher </h4>';
                        echo '<form>';
                        echo "<div class='form-field afill-overide'><select class='autofill-combo' id='teach' >";
                        $res = mysql_query("SELECT EMPCODE,NAME FROM TEACHER WHERE dept ='$dept'",$con);
                        while($row = mysql_fetch_row($res))
                            echo "<option>".trim($row[0])." -- {$row[1]}</option>";
                        echo "</select></div>";
                        echo "<div class='form-field'><label class='form-label' >Semester</label> <input class='form-input required' type='text' id='sem' ></div>";
                        echo "<div class='form-field'><label class='form-label' >Department</label> <input class='form-input ucase required' type='text' id='dept' ></div>";
                        echo "<div class='form-field'><label class='form-label' >Section</label> <input class='form-input ucase  required' type='text' id='sec' ></div>";
                        echo "<div class='form-field'><label class='form-label' >Year</label> <input class='form-input required' type='text' id='year' ></div>";
                         echo "<div class='form-submit'> <input type='button' class='ajx-button' value='Submit' onclick=validate5()> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='reset' class='ajx-button' value='Reset'></div></form>";
                 break;
                }
                echo '<script>$(".autofill-combo").sexyCombo({autoFill: true}); </script>';                                              
            }
        }
