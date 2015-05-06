<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="byui">
		<html>
		<head>
		   <title>
			  BYU-Idaho Colleges and Departments
		   </title>
		</head>
		<body>
 	  	   <h2>BYU-Idaho Colleges and Departments</h2>
		   <hr/>
		   <xsl:apply-templates/>  <!-- all children of the current node -->
		 </body>
		</html>
   	</xsl:template>
	 
	<xsl:template match="college">
 		<h3>
		  <xsl:value-of select="@name"/>
		</h3>
   		  <xsl:apply-templates select="department">
		    <xsl:sort/>
		  </xsl:apply-templates>
		  <xsl:apply-templates select="department1"/>
  		<br/>
	</xsl:template>

	<xsl:template match="department1">
		<span style = "color:blue; position: relative; left: 20px">
			<xsl:value-of select="name"/>
		</span>
            <xsl:apply-templates select="major"/>
		<br/>
	</xsl:template>

	<xsl:template match="department">
		<span style = "color: red; position: relative; left: 20px">
		  <xsl:value-of select="."/>     <!-- select value of current node -->
		</span>
		<br/>
	</xsl:template>

	<xsl:template match="major">
		  <br/> 
		  <span style = "color: green; position: relative; left: 30px">
 		    <xsl:value-of select="."/>
		    (
 		      <xsl:value-of select="@id"/> 
		    )
		  </span>
	</xsl:template>

</xsl:stylesheet>

     