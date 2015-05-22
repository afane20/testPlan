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

<body>

<div id="wrapper" >
    <header id="top">
    </header>      
      
    <?php
      	$file = "data.txt";
		if (!unlink($file))
 		{
  				echo ("Error deleting $file");
  		}
		else
  		{
  		echo ("All students have been Unregistered. $file has been deleted!");
  		}
      
        ?>
   		
   	 </div>
	</body>
</html>
    