<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <?xml version=\"1.0\" encoding=\"utf-8\"?>
    <registry>
      <xsl:for-each select="registry/student">
        <xsl:sort select="time"/>
        <xsl:sort select="location"/>
        <xsl:sort select="lastName"/>
        <xsl:sort select="firstName"/>

        <student>
          <xsl:for-each select="./*">
            &lt;<xsl:value-of select="name(.)"/>&gt;<xsl:value-of select="."/>&lt;/<xsl:value-of select="name(.)"/>&gt;
          </xsl:for-each>
        </student>
      </xsl:for-each>
    </registry>
  </xsl:template>
</xsl:stylesheet>
