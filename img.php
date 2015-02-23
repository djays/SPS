<?php

include("Config.php");
if(isset($_REQUEST['id']))
{
    $id    = trim(mysql_real_escape_string($_REQUEST['id']));
    if ($id == '')
        die();
    $type  = substr($id,0,1);
    $con   = mysql_connect($Host, $Uname, $Password) or die("No Connection To Server");
    mysql_select_db($Database, $con) or die ("Database Error");
    $query = "SELECT PHOTO FROM ";
    if($type == '0')
        $query.="STUDENT WHERE REGNO='$id'";
    else if ($type == 'M')
        $query.="TEACHER WHERE EMPCODE='$id'";
    else if ($type == 'G')
        $query.="GUARDIAN WHERE GID='$id'";
    else $query ="";

    $res= mysql_query($query,$con);
    $row= mysql_fetch_row($res);
   
    if (($row != '' && $query != '') && strlen($row[0])>5)
        print $row[0];
    else
        {
          $instr = fopen("temp/default.jpg","rb")or die('Error');
          $bytes = fread($instr,filesize("temp/default.jpg"));
          print $bytes;
        }
 header( "Content-type: image/jpeg");  
}
?>
