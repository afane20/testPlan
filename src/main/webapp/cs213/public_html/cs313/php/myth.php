<?php
   // start session
  session_start();
  $filename = "data/surveyData.txt";

  // get previous answers
  if (file_exists($filename))
  {
     $file_lines = file($filename,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
     $data1 = explode(" ", $file_lines[0]);
     $data2 = explode(" ", $file_lines[1]);
     $data3 = explode(" ", $file_lines[2]);
     $data4 = explode(" ", $file_lines[3]);
     $data5 = explode(" ", $file_lines[4]);
     $total = $file_lines[5];
  }
  else
  {
     $data1 = array(0,0,0);
     $data2 = $data1;
     $data3 = $data1;
     $data4 = $data1;
     $data5 = $data1;
     $total = 0;
  }

  if ($_POST["view"] == "View Results")
  {
     $message = "Thank you for your interest!";
  }
  else
  {
     $message = "You have already voted!";

     if (!IsSet($_SESSION["voted"]) && !IsSet($_COOKIE["voted"]))
     {
        $message = "Thank you for voting!";
     
        $_SESSION["voted"] = "true";
        setcookie("voted", "true", time() + 604800);

        // get survey answers
        $q1 = $_POST["Q1"];
        $q2 = $_POST["Q2"];
        $q3 = $_POST["Q3"];
        $q4 = $_POST["Q4"];
        $q5 = $_POST["Q5"];
   
        $total = $total + 1;
        switch ($q1)
        {
           case "yes":
              $data1[0]++;
              break;
           case "maybe":
              $data1[1]++;
              break;
           case "no":
              $data1[2]++;
              break;
        }
        switch ($q2)
        {
          case "yes":
              $data2[0]++;
              break;
           case "maybe":
              $data2[1]++;
              break;
           case "no":
             $data2[2]++;
              break;
        }
        switch ($q3)
        {
           case "yes":
              $data3[0]++;
              break;
           case "maybe":
              $data3[1]++;
              break;
           case "no":
              $data3[2]++;
              break;
        }
        switch ($q4)
        {
           case "yes":
              $data4[0]++;
              break;
           case "maybe":
              $data4[1]++;
              break;
           case "no":
              $data4[2]++;
             break;
        } 
        switch ($q5)
        {
           case "yes":
              $data5[0]++;
              break;
           case "maybe":
              $data5[1]++;
              break;
          case "no":
              $data5[2]++;
              break;
        }

        // store answers
        $out = $data1[0] . " " . $data1[1] . " " . $data1[2] . "\n";
        $out = $out . $data2[0] . " " . $data2[1] . " " . $data2[2] . "\n";
        $out = $out . $data3[0] . " " . $data3[1] . " " . $data3[2] . "\n";
        $out = $out . $data4[0] . " " . $data4[1] . " " . $data4[2] . "\n";
        $out = $out . $data5[0] . " " . $data5[1] . " " . $data5[2] . "\n";
        $out = $out . $total;
        file_put_contents($filename, $out);
     }
  }

   // show results
  ?>
  <html>
  <head>
   <title>php survey results</title>
 </head>
 <body>
  <h3>Survey Results</h3>
  <table border="1px">
   <tr>
      <th>Question</th>
      <th>Yes</th>
      <th>Maybe</th>
      <th>No</th>
      <th>Answers</th>
   </tr>
   <tr>
      <td>Is it possible for a wood burning fireplace to make your house colder?</td>
      <td><?php print($data1[0]); ?></td>
      <td><?php print($data1[1]); ?></td>
      <td><?php print($data1[2]); ?></td>
      <td><a href="http://dsc.discovery.com/fansites/mythbusters/quiz/coldchillin/coldchillin.html">look at #3</a></td>
   </tr>
   <tr>
      <td>Does hot water freeze faster than cold water?</td>
      <td><?php print($data2[0]); ?></td>
      <td><?php print($data2[1]); ?></td>
      <td><?php print($data2[2]); ?></td>
      <td><a href="http://dsc.discovery.com/fansites/mythbusters/quiz/coldchillin/coldchillin.html">look at #4</a></td>
   </tr>
   <tr>
      <td>Can you find identical snowflakes?</td>
      <td><?php print($data3[0]); ?></td>
      <td><?php print($data3[1]); ?></td>
      <td><?php print($data3[2]); ?></td>
      <td><a href="http://dsc.discovery.com/fansites/mythbusters/quiz/coldchillin/coldchillin.html">look at #5</a></td>
   </tr>
   <tr>
      <td>Does freezing water in a plastic container contaminate it?</td>
      <td><?php print($data4[0]); ?></td>
      <td><?php print($data4[1]); ?></td>
      <td><?php print($data4[2]); ?></td>
      <td><a href="http://dsc.discovery.com/fansites/mythbusters/quiz/coldchillin/coldchillin.html">look at #9</a></td>
   </tr>
   <tr>
      <td>Are avalanches usually caused by noises?</td>
      <td><?php print($data5[0]); ?></td>
      <td><?php print($data5[1]); ?></td>
      <td><?php print($data5[2]); ?></td>
      <td><a href="http://dsc.discovery.com/fansites/mythbusters/quiz/coldchillin/coldchillin.html">look at #11</a></td>
   </tr>
  </table>
  <h4><span>Number of voters: <?php print($total); ?></span></h4>
 <h3><?php print($message);?></h3>
 </body>
</html>
