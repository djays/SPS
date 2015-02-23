<?php
        include('Config.php');                 //Main Configuration File
        include('Functions.php');              // Common Defined PHP Functions
        if(loginCheck() || $_GET['id'] == 1 || $_GET['id'] == 2)                            // Main PHP Content In Here
        {    if(isset($_GET['id']))
            {
                switch($_GET['id'])
                {
                case 0:
                        logout();
                        echo "<script type='text/javascript'>window.location.href='index.php';</script>";
                        break;
                case 1:
                        include('login.html');
                        break;
                case 2: 
                        echo "<p>The MIT Student Performance Services (MIT-SPS) web application is intended to provide an easy and convenient way for students, guardians, instructors and management authorities to know about latest academic performance using the internet as the sole medium. <br><br>
It enables students to know about their recent performance in sessionals, labs and end semester exams, guardians to view their wards performance without having to college</p>";
                        break;

                }                                                    
            }   
        }
        else
        {
            echo "<script type='text/javascript'>window.location.href='index.php';</script>";
        }
?>
