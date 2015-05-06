<?php
   // The php File function - opens the file,
   // creates a hit count to the file.
   $fileName = "data/hitCount.dat";
   $hitCount = 0;
   if (file_exists($fileName))
   {
      $fHandle = fopen($fileName,"r");
      $hitCount = fread($fHandle,filesize($fileName));
      fclose($fHandle);
   }
   $hitCount++;
   print "<h3>visitors = $hitCount</h3>";
   $fHandle = fopen($fileName,"w");
   fwrite($fHandle, $hitCount);         // store the update survey results
   fclose($fHandle);
?>
