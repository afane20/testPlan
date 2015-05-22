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

#wrapper {
background-color:#FFFFFF; width:100%; min-width:700px; max-width: 1000px; 
margin-left:auto; margin-right:auto;
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
        <h1>PHP Assignment 11</h1>

  <blockquote>
  <strong><em>"Behold, God is my salvation; I will trust, and not be afraid;
   for the Lord Jehovah is my strength and my song; he also has become my salvation".
   (2 Nephi 22:2)</em></strong></blockquote>
        
        </br>
        
      <nav id="mainnav">
            <ul style="list-style-type:none; margin:0px;padding:0px">
                <li><a href="../index.html" >Home</a></li>
               
                <li><a href="http://www.byui.edu/" >BYU-I</a></li>
               
                <li><a href="../assign02.html" >CS 213 Assignments</a></li>
                <li><a href="https://byui.brainhoney.com/" >I-Learn</a></li>
                <li><a href="https://pod51034.outlook.com/" >BYU-I email</a></li>

            </ul>
        </nav>
    </header>
    <br>
    <br>
    <h2 style= "text-align:center">Katherine's Store</h2>

    <h1>
    <?php
    $confirm = $_GET["confirm"];
    $cancel = $_GET["cancel"];
    
    if ($confirm) print("Thank you! Your order has been Submitted!");
    else print("Your Order has been Canceled Successfully!");
    ?>
    </h1>
    </div>
   </body>
</html>