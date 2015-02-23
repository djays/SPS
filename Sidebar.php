<?php 
        require_once('Config.php');                 //Main Configuration File
        require_once('Functions.php');              // Common Defined PHP Functions

        echo '<div id="navigation-block">';
        echo "<ul id='sliding-navigation'> ";
        echo "<li class='sliding-element'><a href='ajx.php?id=2'>HOME</a></li>";
        
        if(loginCheck())                            // Main PH Content In Here
        {
                                         
          echo "<li class='sliding-element'><a href='ajx.php?id=0'>LOGOUT</a></li>";
          $type = $_COOKIE['type'];
          switch($type)
          {
            case 'A':
                      echo "<li class='sliding-element'><a href='admin-ajx.php?id=4'>ADD LOGIN</a></li>";
                     // echo "<li class='sliding-element'><a href='admin-ajx.php?id=5'>ASSIGN PHOTO </a></li>";
                      echo "<li class='sliding-element'><a href='admin-ajx.php?id=1'>ADD STUDENT</a></li>";
                      echo "<li class='sliding-element'><a href='admin-ajx.php?id=2'>ADD TEACHER</a></li>";
                      echo "<li class='sliding-element'><a href='admin-ajx.php?id=3'>ADD GUARDIAN</a></li>";
            break;
            case 'G': echo "<li class='sliding-element'><a href='guardian-ajx.php?id=1'>VIEW SESSIONAL MARKS</a></li>";            
                      echo "<li class='sliding-element'><a href='guardian-ajx.php?id=2'>VIEW SEMESTER GRADES</a></li>"; 
                      echo "<li class='sliding-element'><a href='messages.php?id=0'>MESSAGES</a></li>";
            break;
            case 'S':
                      echo "<li class='sliding-element'><a href='view-ajx.php?id=1'>VIEW SESSIONAL MARKS</a></li>";            
                      echo "<li class='sliding-element'><a href='view-ajx.php?id=3'>VIEW SEMESTER GRADES</a></li>";                        
            break;
            case 'H':
                      echo "<li class='sliding-element'><a href='hod-ajx.php?id=1'>VIEW SESSIONAL MARKS</a></li>";
                      echo "<li class='sliding-element'><a href='hod-ajx.php?id=2'>VIEW SEMESTER GRADES</a></li>";                    
            break;
            case 'T':
                      echo "<li class='sliding-element'><a href='teach-ajx.php?id=1'>SESSIONAL MARKS</a></li>";
                      echo "<li class='sliding-element'><a href='messages.php?id=0'>MESSAGES</a></li>";
            break;
            case 'D':
                      echo "<li class='sliding-element'><a href='dire-ajx.php?id=1'>VIEW SESSIONAL MARKS</a></li>";
                      echo "<li class='sliding-element'><a href='dire-ajx.php?id=2'>VIEW SEMESTER GRADES</a></li>";
            break;
            case 'DA':
                      echo "<li class='sliding-element'><a href='deptadmin-ajx.php?id=2'>SUBJECT MAPPING</a></li>";
                      echo "<li class='sliding-element'><a href='deptadmin-ajx.php?id=1'>ADD SEMESTER GRADES</a></li>";
            break;
          }
            
        }
        else
        {
          echo "<li class='sliding-element'><a href='ajx.php?id=1'>LOGIN</a></li>";
        }

        echo "</ul></div>";
        



?>

