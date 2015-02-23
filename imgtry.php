<?php



$con = mysql_connect("localhost","root","sqldj") or die(mysql_error());
mysql_select_db("MITSPS",$con) or die(mysql_error());



if (isset($_POST['completed'])) {
        // Need to add - check for large upload. Otherwise the code
        // will just duplicate old file ;-)
        // ALSO - note that latest.img must be public write and in a
        // live appliaction should be in another (safe!) directory.
        move_uploaded_file($_FILES['imagefile']['tmp_name'],"temp/latest.img");
        $instr = fopen("temp/latest.img","rb")or die('File/Permission Error');
        $image = addslashes(fread($instr,filesize("temp/latest.img")));
        if (strlen($instr) < 149000) 
                mysql_query ("insert into STUDENT (Regno, Name, Photo) values ('".$_POST['regno']."','".$_POST['name']."',\"".$image."\")",$con)or die(myqsl_error());
         else 
                die("Too large!");
        
}

// Find out about latest image
$url = 'temp/';
$gotten = mysql_query("select * from student order by regno desc limit 1",$con);
if ($row = mysql_fetch_assoc($gotten)) {

        $name = htmlspecialchars($row['Name']);
        print $row['Photo'];
/*        $url.=$row['Regno'].".jpg"; 
        if (is_writable($url)) 
        {
            if (!$handle = fopen($url, 'w')) 
            {
                echo "Cannot open file ($url)";
                exit();
            }
            if (fwrite($handle, $row['Photo']) === FALSE) 
            {
                echo "Cannot write to file ($url)";
                exit();
            }

        fclose($handle);

        } 
        else 
            echo "The file $url is not writable";
*/
        header( "Content-type: image/jpeg");  
 
        
        
} else {
        echo ('Image not in database');
        $name = "";
        
        //$instr = fopen("../wellimg/ctco.jpg","rb");
        //$bytes = fread($instr,filesize("../wellimg/ctco.jpg"));
}

// If this is the image request, send out the image


?>

<html><head>
<title>Upload an image to a database</title>
<body bgcolor=white><h2>Here's the latest picture</h2>
<font color=red><?php echo $name; ?></font>
<center><img src=img.php?id=dsds width=144><br>
<b></center>
<hr>
<h2>Please upload a new picture and title</h2>
<form enctype=multipart/form-data method=post>
<input type=hidden name=MAX_FILE_SIZE value=150000>
<input type=hidden name=completed value=1>
Please choose an image to upload: <input type=file name=imagefile><br>
Please Enter Regno <input name='regno'>
Please Enter Name <input name='name'>
<br>
then: <input type=submit></form><br>
<hr>
</body>
</html>
