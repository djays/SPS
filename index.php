<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
    <?php include('Header.php'); ?>             <!-- Common Header -->

 </head>
 <body>
   <?php include('Body_Open.php');             //<!-- Common Body_Open -->
        include('Config.php');                 //Main Configuration File
        include('Functions.php');              // Common Defined PHP Functions
        include('Sidebar.php');
        if (isset($_GET['logout']))
        {
            logout();
            header('location:index.php');
        }
        
        echo "<div id='main-content'>Loading Page..</div>";
        if(loginCheck())                       // Main PHP Content In Here
        {
                                        

        }
        else if (isset($_POST['uname']) && isset($_POST['pass']) )
        {
            loginUser($_POST['uname'],$_POST['pass']);
            header('location:index.php');
        }
     


        include('Body_Close.php');         // <!-- Common Body_Close -->
?>           

 </body>
</html>
