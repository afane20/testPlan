<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/bsa">
<html>

<head>
<title>Ernesto's XML XSLT </title>
    <base href = "http://157.201.194.254/~afane/assign8/">

<style>
table, th, td {
    border: 1px solid black;
	margin: auto;
}

h1 {
	font-size:72px;
	color: rgba(25,190,55,0.70);
	text-align:center;
	font-weight:500;
}
blockquote {
background: #f9f9f9;
border-left: 10px solid medium;
padding: 0.5em 50px; 
text-align: center;
}
li {
	width:20%;
	display:block;
	float:left;
	background-color:#4D4D4D; 
	text-align:center;
	color:#FFFFFF;
	text-transform:uppercase;
	padding-top:6px;
	padding-bottom: 6px;
}
</style>

</head>
<body style="margin:0px; font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif; background-color: #EFF5F8;">
<div id="wrapper" style="background-color:#FFFFFF; width:100%; min-width:700px; max-width: 1000px; margin-left:auto; margin-right:auto;">
    <div id="top">
        <h1>Assignment 8, XML and XSLT</h1>

  <blockquote><strong><em>"Behold, God is my salvation; I will trust, and not be afraid; for the Lord Jehovah
   is my strength and my song; he also has become my salvation".(2 Nephi 22:2)</em></strong></blockquote>
     
        
        
      <div id="mainnav">
            <ul style="list-style-type:none; margin:0px;padding:0px">
                <li><a href="../index.html" style="color:#FFFFFF; background-color:#4D4D4D;">Home</a></li>
               
                <li><a href="http:www.byui.edu/" style="color:#FFFFFF; background-color:#4D4D4D;">BYU-I</a></li>
               
                <li><a href="../assign02.html" style="color:#FFFFFF; background-color:#4D4D4D;">CS 213 Assignments</a></li>
                <li><a href="https://byui.brainhoney.com/" style="color:#FFFFFF; background-color:#4D4D4D;">I-Learn</a></li>
                <li><a href="https://pod51034.outlook.com/" style="color:#FFFFFF; background-color:#4D4D4D;">BYU-I email</a></li>

            </ul>
      </div>
	</div>
	
	<br/>
	<br/>
	
	<h1>B S A</h1>
	<p>(The Scout are sorted by Last Name)</p>
	<xsl:apply-templates />
		
		</div>
		</body>
		</html>
	</xsl:template>	 	
	
	<xsl:template match="council">
	<div style="margin:10px; border:3px solid black; padding:10px;">
		<h2>
		<xsl:text>Council Name: </xsl:text>
		<xsl:value-of select="@name"/> <br/>
		</h2>
		
	<xsl:apply-templates />
		</div>

	</xsl:template>
	
	<xsl:template match="troop">
	
	<h3>
	<xsl:text>Troop Number: </xsl:text>
	<xsl:value-of select="@number"/> <br/>
	<xsl:text> Unit Name: </xsl:text>
	<xsl:value-of select="@unitName"/>

	</h3>
	
	<table style="border: 1px solid black;">
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Phone Number</th>
		<th>Street</th>
		<th>City</th>
		<th>State</th>
	    <th>Rank</th>
		<th>Merit Badges Earned</th>

	</tr>
		<xsl:for-each select="scout">
		      <xsl:sort select="lastName"/>
		<tr>
	    	<td><xsl:value-of select="firstName"/></td>
			<td><xsl:value-of select="lastName"/></td>
	    	<td><xsl:value-of select="phoneNumber"/></td>
	      
		 	<xsl:for-each select="address">

		  		<td><xsl:value-of select="street"/></td>
	      	 	<td><xsl:value-of select="city"/></td>
            	<td> <xsl:value-of select="state"/></td>
		
		  	</xsl:for-each>
		  	  	
		  	<td>
		  	<xsl:value-of select="rank"/>
		  	<xsl:text> (</xsl:text>
		  		<xsl:value-of select="rank/@dateEarn" />
		  	<xsl:text> )</xsl:text> </td>
		  	
		  	<td>
		    		<select>
		    		<xsl:for-each select="meritBadge">
		    		<option>
						<xsl:value-of select="."/> <xsl:text> </xsl:text>
						<xsl:value-of select="@dateEarn" /></option>
		  	 		</xsl:for-each>
		  	 		</select>
					</td>
		</tr>
	   </xsl:for-each>
	   </table>
	
	   <br/>
	   <br/>

	</xsl:template>
</xsl:stylesheet>
