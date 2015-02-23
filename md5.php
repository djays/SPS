<?php
        include('Config.php');                 //Main Configuration File
        include('Functions.php');              // Common Defined PHP Functions

        echo md5($_GET['pas'].$Salt);


?>
