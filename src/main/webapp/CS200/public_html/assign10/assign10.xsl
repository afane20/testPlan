<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!--Comment Template  -->
<xsl:template match="studentList">
<html>

<head>
<title>Ernesto's XML XSLT </title>

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
        <h1>Assignment 10, PHP and XSL</h1>

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
	
	<h1>Student List</h1>	
	<table style="border: 1px solid black;">
			<tr>
				<th>First Name</th>
				<th>Middle Name</th>
				<th>Last Name</th>
				<th>City</th>
				<th>State</th>
	    		<th>College Name</th>
				<th>Department</th>
				<th>Major ID</th>
				<th>Major</th>
			</tr>
	
	<xsl:apply-templates />
		</table>

<br/>
<br/>
</div>
<br/>
<br/>

</body>
</html>
</xsl:template>	 
		
	<xsl:template match = "student">
	
		<tr>
			<xsl:apply-templates />
		</tr>

	</xsl:template>
	
	<xsl:template match = "name">
		<td><xsl:apply-templates select="first" /></td>
		<td><xsl:apply-templates select="middle" /></td>
		<td><xsl:apply-templates select="last" /></td>
		
	</xsl:template>
	
	<xsl:template match = "location">
			<td><xsl:apply-templates select="city" /></td>
			<td><xsl:apply-templates select="state" /></td>
	</xsl:template>
	
	<xsl:template match = "college">
		<td><xsl:value-of select="@name"/></td>
		<xsl:apply-templates />
	</xsl:template>
	
	<xsl:template match = "department">
		<td><xsl:value-of select="@name"/></td>
		<xsl:apply-templates />
	</xsl:template>
	
	<xsl:template match = "major">
		<td><xsl:value-of select="@id"/></td>
		<td><xsl:value-of select="."/></td>
	</xsl:template>
	
</xsl:stylesheet>
