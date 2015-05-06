<?xml version = "1.0"?>
<!-- xslplane.xsl -->

<xsl:stylesheet version = "1.0"
                xmlns:xsl = "http://www.w3.org/1999/XSL/Transform"
                xmlns = "http://www.w3.org/TR/xhtml1/strict">
   <xsl:template match = "/">
   <h2> Airplane Description </h2>
   <span style = "font-style: italic"> Year: </span>
   <xsl:value-of select = "plane/year" /> <br />
   <span style = "font-style: italic"> Make: </span>
   <xsl:value-of select = "plane/make" /> <br />
   <span style = "font-style: italic"> Model: </span>
   <xsl:value-of select = "plane/model" /> <br />
   <span style = "font-style: italic"> Color: </span>
   <xsl:value-of select = "plane/color" /> <br />
   </xsl:template>
</xsl:stylesheet>

