<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">
<xsl:template match="studentList">
<html>
  <head>
    <title>Student List</title>
    <style type="text/css">
      body
      {
        text-align:center;
        width:500px;
        margin:0 auto;
        border:solid 1px;
        margin-top: 15px;
	float: left;
      }
      hr {width: 80%;}

      .student
      {
	text-align: left;
	margin-left: 50px;
	border: solid 1px;
	width: 395px;
	margin-top: 5px;
	margin-bottom: 5px;
	padding-left: 5px;
	float: left;
      }

      .name
      {
	color: dodgerBlue;
      }

      .location
      {
        font-size: 12px;
	float: left;
	width: 100px;
      }

      .college
      {
        font-size: 12px;
	float: right;
	width: 250px;
      }
    </style>
  </head>
  <body>
    <div id="main">
      <h2>List of Students</h2>
      <hr />
      <xsl:apply-templates select="student"/>
    </div>
    <a href="http://157.201.194.254/~chansen4/assign09.xsl"
	style="float: left; margin: 0 auto;" >XSL File</a>
  </body>
</html>
</xsl:template>

<xsl:template match="student">
  <div class="student">
    <span class="name">
      <xsl:value-of select="name/first" />&#160;
      <xsl:value-of select="name/middle" />&#160;
      <xsl:value-of select="name/last" />
    </span>
    <div class="location">
      <b>Location:</b><br/>
      <xsl:value-of select="location/city" />,&#160;
      <xsl:value-of select="location/state" />
    </div>
    <div class="college">
      <b>College / Department / Major - ID:</b><br/>
      <xsl:value-of select="college/@name"/>&#160;/&#160;
      <xsl:value-of select="college/department/@name" />&#160;/&#160;
      <xsl:value-of select="college/department/major" />&#160;-&#160;
      <xsl:value-of select="college/department/major/@id" />
    </div>
  </div>
</xsl:template>

</xsl:stylesheet>
