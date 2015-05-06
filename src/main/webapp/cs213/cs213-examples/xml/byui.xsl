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
		  <xsl:apply-templates select="department"/>
		  <xsl:apply-templates select="department1"/>
 		<br/>
	</xsl:template>

	<xsl:template match="department">
		&#xa0;&#xa0;
		<span style = "color: red">
		  <xsl:value-of select="."/>
		</span>
		<br/>
	</xsl:template>
	<xsl:template match="department1">
		&#xa0;&#xa0;
		<span style = "color: blue">
		<xsl:value-of select="name"/>
		</span>
    	      <xsl:apply-templates select="major"/>
		<br/>
	</xsl:template>

	<xsl:template match="major">
		  <br/> 
		  &#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;
		  <xsl:value-of select="."/>
		  (
 		  <xsl:value-of select="@id"/>
		  )
	</xsl:template>
</xsl:stylesheet>

     