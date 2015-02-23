<?php
        include('Config.php');                                                  //Main Configuration File
        include('Functions.php');                                               // Common Defined PHP Functions
        if(loginCheck() || ( isset($_COOKIE['type']) && ($_COOKIE['type'] == 'A')))                            // Main PHP Content In Here
        {    if(isset($_GET['id']))
            {
                $con    = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
                mysql_select_db($Database, $con) or die ("Database Error");
                switch($_GET['id'])
                {
                
                case 1: 
                        echo '<h2 class="form-head"> ADD STUDENT</h2><br>';
                        echo '<form>';
                        echo "<div class='form-field'><label class='form-label' >Registraion Number</label> <input class='form-input required' type='text' id='regno' ></div>";
                        echo "<div class='form-field'><label class='form-label' >Name</label> <input class='form-input required' type='text' id='Name'></div>";
                        echo "<div class='form-field'><label class='form-label' >Department</label> <input class='form-input required' type='text' id='Dept' ></div>";
                        echo "<div class='form-field'><label class='form-label' >Semester</label> <input class='form-input required' type='text' id='Sem' ></div>";
                        echo "<div class='form-field'><label class='form-label' >Section</label> <input class='form-input required' type='text' id='Sec'></div>";
                        echo "<div class='form-field afill-overide2'><label class='form-label' >GID</label> <select class='form-input required autofill-combo2'   id='GID'><option>-- Select --</option>";
                        
                        $result = mysql_query("SELECT GID FROM GUARDIAN ORDER BY GID",$con);
                        
                        while ($row = mysql_fetch_row($result))
                            echo "<option> {$row[0]} </option>";
                        echo "</select></div>";
                        echo "<div class='form-submit'> <input type='button' class='ajx-button' value='Submit' onclick=validate1()> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='reset' class='ajx-button' value='Reset'></div></form>";
                        

                        break;
                case 2: 
                        echo '<h2 class="form-head"> ADD TEACHER</h2><br>';
                        echo "<form>";
                        echo "<div class='form-field'><label class='form-label' >Empcode</label> <input class='form-input required' type='text' id='empcode' ></div>";
                        echo "<div class='form-field'><label class='form-label' >Name</label> <input class='form-input required' type='text' id='Name'></div>";
                        echo "<div class='form-field'><label class='form-label' >Department</label> <input class='form-input required' type='text' id='Dept' ></div>";
                        echo "<div class='form-submit'> <input type='button' class='ajx-button' value='Submit' onclick=validate2()> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='reset' class='ajx-button' value='Reset'></div></form>";
                        break;
                 case 3: 
                        echo '<h2 class="form-head"> ADD GUARDIAN</h2><br>';
                        echo "<form>";
                        echo "<div class='form-field'><label class='form-label' >Guardian ID</label> <input class='form-input required' type='text' id='GID' ></div>";
                        echo "<div class='form-field'><label class='form-label' >Name</label> <input class='form-input required' type='name' id='Name'></div>";                        
                        echo "<div class='form-submit'> <input type='button' class='ajx-button' value='Submit' onclick=validate3()> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='reset' class='ajx-button' value='Reset'></div></form>";
                        break;
                case 4:
                        echo '<h2 class="form-head"> ADD LOGIN</h2><br>';
                        echo "<form>";
                        
                        echo "<div class='form-field afill-overide2 '><label class='form-label' >Username</label> <select class='form-input autofill-combo2 required' id='usern' onChange='showDept()'><option>-- Select --</option><option>Director</option><option>DeptAdmin</option><option>HOD</option>";
                                             
                        $res = mysql_query("SELECT EMPCODE AS UID FROM TEACHER 
UNION SELECT GID AS UID FROM GUARDIAN
UNION SELECT REGNO FROM STUDENT",$con);
                        while($row = mysql_fetch_row($res))
                            echo "<option>{$row[0]}</option>";
                        echo "</select></div>";
                        echo "<div class='form-field' id='sDept'><label class='form-label' >Department Code</label> <input class='form-input required' type='text' id='dept' value''></div>";
                        echo "<div class='form-field'><label class='form-label' >Password</label> <input class='form-input required' type='password' id='Pass'></div>";                        
                        echo "<div class='form-field'><label class='form-label' >Password Again</label> <input class='form-input required' type='password' id='PassRe'></div>";                        
                        echo "<div class='form-submit'> <input type='button' class='ajx-button' value='Submit' onclick=validate4()> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='reset' class='ajx-button' value='Reset'></div></form>";
                        


                        break;            
                case 5:
                        echo "<center><h2> Assign Photo</h2></center>";
                        echo "<form enctype=multipart/form-data method=post>";
                        echo "<center><h4> Select User</h4></center>";
                        echo "<div class='form-field afill-overide'><select class='form-input required autofill-combo'   id='uid'><option>-- Select --</option>";
                        
                        $result = mysql_query("SELECT GID,NAME FROM GUARDIAN ORDER BY GID",$con);                        
                        while ($row = mysql_fetch_row($result))
                            echo "<option> {$row[0]} -- {$row[1]} </option>";
                        $result = mysql_query("SELECT EMPCODE,NAME FROM TEACHER ORDER BY EMPCODE",$con);                        
                        while ($row = mysql_fetch_row($result))
                            echo "<option> {$row[0]} -- {$row[1]} </option>";
                        $result = mysql_query("SELECT REGNO,NAME FROM STUDENT ORDER BY REGNO",$con);                        
                        while ($row = mysql_fetch_row($result))
                            echo "<option> {$row[0]} -- {$row[1]} </option>";

                        echo "</select></div>";
                        echo "<center><h4> Select Photograph</h4>";
                      //  echo "<img id='image-frame' height=66px width=102px>";
                        echo "<input type=file id='imgfil' name=imagefile>";
                        echo "<input type='button'  value='Submit' onclick=uploadPhoto()></center></form>";                
            
               break;
               case 6:
                        move_uploaded_file($_FILES['photo']['tmp_name'],"temp/latest.img");
                        $instr = fopen("temp/latest.img","rb")or die('File/Permission Error');
                        $image = addslashes(fread($instr,filesize("temp/latest.img")));
               break;

                }      
            echo '<script>$(".autofill-combo").sexyCombo({autoFill: true});$(".autofill-combo2").sexyCombo({autoFill: true});</script>';                                              
            }   
        }
        else
        {
            echo "<center>Please login</center>";
        }
?>
