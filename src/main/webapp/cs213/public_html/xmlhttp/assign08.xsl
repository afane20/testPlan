<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0"
 xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
<html>
  <head>
    <title>
      Boys Scouts of America
    </title>
  </head>
  <body>
    <xsl:apply-templates/>
  </body>
</html>
</xsl:template>

<xsl:template match="bsa">
 <h1>
    <xsl:value-of select="council"/> Council
  </h1>
  <h2>
    Troop:
    <xsl:apply-templates select="troop"/>
  </h2>

  <xsl:apply-templates select="scout"/>
</xsl:template>

<xsl:template match="scout">
  <h3>
    <xsl:apply-templates select="last"/>
  </h3>
  <xsl:apply-templates select="first"/>
  <br/>
  <span style = "color: red">
    <xsl:apply-templates select="rank"/>
  </span>
  <br/>
  <b> Merit Badges </b> <br/>
  <xsl:apply-templates select="meritbadge"/>
  <xsl:apply-templates select="address"/>
  <br/>
  <xsl:apply-templates select="phone"/>
  <br/> <br/> <br/>
</xsl:template>

<xsl:template match="meritbadge">
  &#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;
  <xsl:value-of select="."/>
  <small> earned: 
  <xsl:value-of select="@date"/> </small>
  <br/>
</xsl:template>
</xsl:stylesheet>
