<?php
        include('Config.php');                                                  //Main Configuration File
        include('Functions.php');                                               // Common Defined PHP Functions
        if(loginCheck() || ( isset($_COOKIE['type'])))                            // Main PHP Content In Here
        {    if(isset($_GET['id']))
            {
                $con    = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
                mysql_select_db($Database, $con) or die ("Database Error");
                $usn = mysql_real_escape_string($_COOKIE['user']);
                if (isset($_REQUEST['regno']))
                        $usn = trim($_REQUEST['regno']);
                switch($_GET['id'])
                {
                
                 case 1: 
                        $query = "SELECT DISTINCT (SEM) FROM `INFO` JOIN `SESS_MARKS` WHERE INFO.SUBCODE = SESS_MARKS.SUBCODE AND REGNO ='$usn' ORDER BY SEM ASC";
                        $res = mysql_query($query,$con);                        
                        echo "<div class='sem-tabs'><ul>";
                        while($row = mysql_fetch_row($res))
                        {
                        echo "<li><a href='view-ajx.php?id=2&regno=$usn&sem={$row[0]}'> SEM {$row[0]}</a></li>";
                         }

                        echo "</ul></div>";
                                                
                 break;
                case 2:
                        $sem = mysql_real_escape_string($_GET['sem']);
                        $query = "SELECT  DISTINCT (INFO.SUBCODE),SUBNAME FROM `INFO` JOIN `SESS_MARKS` WHERE INFO.SUBCODE = SESS_MARKS.SUBCODE AND REGNO='$usn' AND INFO.SEM=$sem";
                        $res = mysql_query($query,$con);    
                        echo "<div class='tab-head'>";
                        echo "SEMESTER $sem </div>";
                        echo "<div class='tab-body'>";
                        echo "<table class='tbl1'>";
                        echo "<tr class='table-head'><td>Code </td><td> Subject </td><td> Sessional 1 </td><td> Sessional 2 </td><td>Sessional 3</td></tr>";
                        while ($row = mysql_fetch_row($res))
                        {
                            $subc = $row[0];                                            
                            $subname = $row[1];
                            $s1 = 0;
                            $s2 = 0;
                            $s3 = 0;
                            $query2 = "SELECT  MARKS FROM `SESS_MARKS` WHERE REGNO='$usn' AND SUBCODE='$subc'";
                            
                            $res2 = mysql_query($query2.' AND SESS = 1',$con);
                            if($row = mysql_fetch_row($res2))
                                $s1 = $row[0];
                            $res2 = mysql_query($query2.' AND SESS = 2',$con);
                            if($row = mysql_fetch_row($res2))
                                $s2 = $row[0];
                            $res2 = mysql_query($query2.' AND SESS = 3',$con);
                            if($row = mysql_fetch_row($res2))
                                $s3 = $row[0];

                            echo "<tr><td>{$subc}</td><td>{$subname}</td><td>$s1</td><td>$s2</td><td>$s3</td></tr>";

                        }
                        echo "</table></div>";
                break;
                case 3:
                     $query = "SELECT DISTINCT (SEM) FROM `INFO` JOIN `END_SEM_GRADE` WHERE INFO.SUBCODE = END_SEM_GRADE.SUBCODE AND REGNO ='$usn' ORDER BY SEM ASC";
                     $res = mysql_query($query,$con);                        
                     echo "<div class='sem-tabs'><ul>";
                     while($row = mysql_fetch_row($res))
                      echo "<li><a href='view-ajx.php?id=4&sem={$row[0]}&regno=$usn'> SEM {$row[0]}</a></li>";
                     

                        echo "</ul></div>";
                                                
                 break;

                break;
                case 4:
                    
                    $sem =  mysql_real_escape_string($_GET['sem']);
                    echo "<div class='tab-head'>";
                    echo "SEMESTER $sem </div>";
                    echo "<div class='tab-body'>";
                    echo "<table class='tbl2'>";
                    echo "<tr class='table-head'><td>Code </td><td> Subject </td><td> Grade</td></tr>";
                    $query = "SELECT INFO.SUBCODE,SUBNAME,GRADES FROM `INFO` JOIN `END_SEM_GRADE` WHERE INFO.SUBCODE = END_SEM_GRADE.SUBCODE AND REGNO='$usn' AND INFO.SEM=$sem";
                    $res = mysql_query($query,$con);
                    while($row = mysql_fetch_row($res))
                        echo "<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td></tr>";
                     echo "</table></div>";
                break;
                }

                echo "<script>$('.sem-tabs').tabs();</script>";
            }
        }
