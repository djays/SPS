<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
	<meta name="author" content="Dhananjay Singh & Dhiraj Kumar" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <?php include('Header.php'); ?>             <!-- Common Header -->

 </head>
 <body>
   <?php include('Body_Open.php'); ?>           <!-- Common Body_Open -->
   <?php 
        include('Config.php');                 //Main Configuration File
        include('Functions.php');              // Common Defined PHP Functions
        if(loginCheck())                            // Main PHP Content In Here
        {
                                                    

        }
        else
        {
            echo "<center>Please login</center>";
        }




    ?>

  <?php include('Body_Close.php'); ?>           <!-- Common Body_Close -->

 </body>
</html>
