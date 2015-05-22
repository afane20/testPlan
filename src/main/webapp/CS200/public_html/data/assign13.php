<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
  	
  	<title>Ernesto Afane's Assignment #11 PHP</title>
<style type = "text/css">

a {
	width:20%;display:block;float:left;background-color:#4D4D4D; text-align:center;
	color:#FFFFFF;text-transform:uppercase;padding-top:6px;padding-bottom: 6px;
}

h1 {
font-size:72px; color: rgba(25,190,55,0.70);text-align:center;font-weight:500;
}

body {
margin:0px; 
font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;
background-color: #EFF5F8;
}

blockquote {
	background: #f9f9f9; border-left: 10px solid medium; 
	padding: 0.5em 50px; text-align: center;
}
</style>
</head>

<body onload="myFunction()">

<div id="wrapper" >
    <header id="top">
        <h3 style="text-align:center;">Add more Students!</h3>
    </header>
    
    <?php 
    	$firstName = $_GET["firstName"];
    	$lastName = $_GET["lastName"];
    	$players = $_GET["presentationType"];
    	$studentId = $_GET["id"];
    	$skillLevel = $_GET["skill"];
    	$instrument = $_GET["instrument"];
    	$location = $_GET["location"];
    	$room = $_GET["room"];
    	$time = $_GET["time"];
    	
    	if ($players == "duet"){
    	
    	$firstName2 = $_GET["firstName2"];
    	$lastName2 = $_GET["lastName2"];
    	$studentId2 = $_GET["id2"];
    	}
    	
    	
    	// Items that the user would like to buy 
    	
    	
    
        $info = array($firstName, $lastName, $players, $studentId, $skillLevel, 
        			  $instrument , $location , $room, $time, $firstName2, 
        			  $lastName2, $studentId2);
       // print("$info[8]");
    ?>
        <h2 style= "text-align:center">Students Participating</h2>

  <table width="1100"  border="1" align="center" cellpadding="6" tbcolor: bgcolor="#61E6B9">
    <tbody>
      <tr>
        <th  style="text-align: left"><p>First Name:</p></th>
        <th  style="text-align: left"><p>Last Name</p></th>
        <th  style="text-align: left"><p>Student ID</p></th>
        <th  style="text-align: left"><p>Performance Type</p></th>
        <th  style="text-align: left"><p>Skill Level</p></th>
        <th  style="text-align: left"><p>Instrument</p></th>
        <th  style="text-align: left"><p>Location</p></th>
        <th  style="text-align: left"><p>Room Number</p></th>
        <th  style="text-align: left"><p>Time Slot</p></th>

      </tr>
      
      
    <?php
      	
    	//Testin to read a file and add a <td> to the table, adding values instead. PASSED
        $readFile = "data.txt";
       	$document = file_get_contents($readFile);
       	print("$document");
      	
      	// this is testing for the name, putting the "HTML" in a variable with the info that is being taken from the array info
      	 $html = '<tr><td  style="text-align: left">'.$info[0];
      	 
      		if ($players == "duet")
       		{
       			$html .= '<br/>'.$info[9].'</td>';
       		}

 			$html .= '<td style="text-align: left">'.$lastName;
 			
 			if ($players == "duet")
       		{
       			$html .= '<br/>'.$info[10].'</td>';
       		}
     										
       $html .= '<td style="text-align: left">'.$studentId.'<br/>'; 
      		if ($players == "duet")
      		$html .= $studentId2.'</td>';
      		    	

      	
        $html .= '<td style="text-align: center">'.$players.'</td>';
        $html .= '<td style="text-align: left">'.$skillLevel.'</td>'.
        '<td style="text-align: left">'.$instrument.'</td>'.
        '<td style="text-align: left">'.$location.'</td>'.
        '<td style="text-align: left">'.$room.'</td>'.
        '<td style="text-align: left">'.$time.'</td>'.
      '</tr>';
      
      print("$html");
      
      //This is the code to save the file, testing to save file... PASSED!!!!
      	$file = "data.txt";
      	$write = $html;
      	file_put_contents($file, $write, FILE_APPEND);
      
        ?>
   		 </tbody>
  	</table>
  	
   	 </div>
   	 <br/>
   	 <br/>
	</body>
</html>
    