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
               
                <li><a href="http:www.byui.edu/" >BYU-I</a></li>
               
                <li><a href="../assign02.html" >CS 213 Assignments</a></li>
                <li><a href="https://byui.brainhoney.com/" >I-Learn</a></li>
                <li><a href="https://pod51034.outlook.com/" >BYU-I email</a></li>

            </ul>
        </nav>
    </header>
    <br>
    <br>
    
    <?php 
    	$name = $_GET["name"];
    	$phone = $_GET["phone"];
    	$address = $_GET["address"];
    	$cardNum = $_GET["credit"];
    	$cardType = $_GET["cardType"];
    	$month = $_GET["month"];
    	$year = $_GET["year"];
    	
    	// Items that the user would like to buy 
    	$shoes = $_GET["shoes"];
    	$phoneCase = $_GET["phoneCase"];
    	$wallet = $_GET["Wallet"];
    	$pokemon = $_GET["pokemon"];
    	$parks = $_GET["parks"];
    	
    	$total = $shoes + $phoneCase + $wallet + $pokemon + $parks;
    
        $months = array("0", "January", "February", "March", "April" , 
        				 "May" , "June" , "July", "August", "September",
        				 "October" , "November" , "December");
        $date = $months[$month];
    ?>
        <h2 style= "text-align:center">Katherine's Store Confirmation</h2>

  <table width="688" height="400" border="1" align="center" cellpadding="6" tbcolor: bgcolor="#61E6B9">
    <tbody>
      <tr>
        <td width="365" style="text-align: right"><p>
          <label for="Name">Name:</label>
        </p></td>
        <td width="351" style="text-align: left"><?php printf("$name"); ?></td>
      </tr>
      <tr>
        <td style="text-align: right"><p>
          <label for="phone">Phone Number:</label>
          (999-888-7777)
        </p></td>
        <td style="text-align: left"><?php printf("$phone"); ?>
       </td>
      </tr>
      <tr>
        <td style="text-align: right"><p>Credit/Debit Card: (1111-2222-3333-4444)</p></td>
        <td style="text-align: left">Card Number: <?php printf("$cardNum"); ?>
        <br>
         Card Type: <?php printf("$cardType"); ?>
		<br>
        <br>
        Expiration Date: <br>
        Month: 
        <?php 
        printf("$date"); 
        ?>
        Year:
        <?php printf("$year"); ?>
        
       
        </td>
      </tr>
      <tr>
        <td style="text-align: right"><p>Address: </p></td>
        <td style="text-align: left">Address: <?php printf("$address"); ?></td>
      </tr>
      <tr>
        <td style="text-align: right">Things that you ordered: 
          <br>
        </td>
        <td style="text-align: left">Shoes: <?php printf("$%1.2f", $shoes); ?>
         <br>
        	Cellphone case: <?php printf("$%1.2f", $phoneCase); ?><br>
           
            Wallet: <?php printf("$%1.2f", $wallet); ?>
            <br>
         Pokemon: <?php printf("$%1.2f", $pokemon); ?><br>
        
		Parks: <?php printf("$%1.2f", $parks); ?>
		</td>
      </tr>
      
    <tr>
         <td style="text-align:right">Total Amount: </td>
         <td style="text-align:left" ><?php printf("$%1.2f", $total); ?></td>
         </tr>
        
        
        <form action = "assign11_a.php">
  	
  			<tr>
          		<td style="text-align: right">
           		<input type="submit" name="cancel" id="reset" value="Cancel">
         </td>
         
         <td><input type="submit" name="confirm" value="Confirm" > 
         </td>
   	</tr>
  	</form>
        
        
        
   		 </tbody>
  		</table>
  		
    	
  	
   	 
   	 </div>
	</body>
</html>
    