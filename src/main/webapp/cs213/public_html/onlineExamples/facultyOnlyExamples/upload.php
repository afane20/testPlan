<html>
<head>
<title>File upload</title>
</head>
<body>

<?php

if (isset($_POST['submitted']))
{
   unset($_POST['submitted']);
   if ($_FILES['myFile']['error'] > 0)
   {
      echo "Error: " . $_FILES['myFile']['error'] . "<br />";
      switch ($_FILES['myFile']['error'])
      {
         case 1:
            print "/etc/php.ini setting 'upload_max_filesize' says file is too big";
            break;
         
         case 2:
            print "MAX_FILE_SIZE in form says it's too big";
            break;
           
         case 3:
            print "File only partially uploaded";
            break;
           
         case 4:
            print "No file was uploaded";
            break;
           
         case 6:
            print "No temporary directory exists";
            break;
           
         case 7:
            print "Failed to write to disk";
            break;
           
         case 8:
            print "Upload prevented by an extension";
            break;
           
         default:
            print "something unforseen has happen";
            break;     
      }          
   }
   else
   {
        $fileName = $_FILES['myFile']['name'];
        echo "Type: " . $_FILES["myFile"]["type"] . "<br />";
        echo "Size: " . ($_FILES["myFile"]["size"] / 1024) . " Kb<br />";
        echo "Stored in: " . $_FILES["myFile"]["tmp_name"];
        $success = move_uploaded_file($_FILES["myFile"]["tmp_name"], "uploads/" . $fileName);
        if (!success)
        {
           echo "<br />Error uploading file<br />";
        }
        else
        {
           echo "<br />Successfully uploaded file to 'uploads/" . $fileName . "'<br />";
        }
   }
}

?>
<h2> Uploading a File to the Server </h2>
<h3> Enter the fullpath/filename, or Browse to find the file to upload!</h3>
<form action="upload.php" enctype="multipart/form-data" method="post">
   <input type="hidden" name = "MAX_FILE_SIZE" value = "1000000" />
   <input type="file" name="myFile" size = "60" />  <br /><br />
   <input type="submit" name ="submitted" value="Send File" />
</form>
</body>
</html>