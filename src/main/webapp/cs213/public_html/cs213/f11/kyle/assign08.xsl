<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Boy Scout Advancements</title>
      <style>
        body
        {
          width:1000px;
          margin:10px auto;
          background-color:#ffffbb;  /*Khaki*/
        }
        h1,h3
        {
          width:100%;
          text-align:center;
        }
        h1
        {
          background-color:#882211;  /*Red*/
          font-family:Serif;
          padding:15px 0px;
          color:#ffffbb;  /*Khaki*/
          border-radius:15px;
          margin:auto;
        }
        h2
        {
          color:#112288;  /*Dark Blue*/
        }
        h3
        {
          color:#882211;  /*Dark Red*/
        }
        table
        {
          border-collapse:collapse;
          width:100%;
        }
        th,td
        {
          border:1px solid black;
        }
        th
        {
          color:#112288;  /*Dark Blue*/
          border-bottom:2px solid black;
        }
        select
        {
          width:100%;
          background-color:#ffffdd;  /*Khaki*/
        }
      </style>
    </head>
    <body>
      <h1>Boy Scout Advancements</h1>
      <xsl:for-each select="bsa/council">
        <xsl:sort select="@name"/>
        <xsl:apply-templates select="."/>
      </xsl:for-each>
    </body>
    </html>
  </xsl:template>

  <xsl:template match="council">
    <h2><xsl:value-of select="@name"/> Council</h2>
    <table>
    <xsl:for-each select="troop">
      <xsl:sort select="@number"/>
      <xsl:apply-templates select="."/>
    </xsl:for-each>
    </table>
  </xsl:template>

  <xsl:template match="troop">
    <tr>
      <td colspan="5">
       <h3>Troop <xsl:value-of select="@number"/>: <xsl:value-of select="@name"/></h3>
      </td>
    </tr>
    <tr>
      <th>Name:</th>
      <th>Phone:</th>
      <th>Address:</th>
      <th>Rank (date-earned):</th>
      <th>MeritBadges (date-earned):</th>
    </tr>
    <xsl:for-each select="scout">
      <xsl:sort select="lastName"/>
      <xsl:apply-templates select="."/>
    </xsl:for-each>
  </xsl:template>

  <xsl:template match="scout">
    <tr>
      <td><xsl:value-of select="firstName"/>&#160;<xsl:value-of select="lastName"/></td>
      <td><xsl:value-of select="phone"/></td>
      <td><xsl:value-of select="address/street"/>,
          <xsl:value-of select="address/city"/>, <xsl:value-of select="address/state"/></td>
      <td>
        <xsl:choose>
          <xsl:when test="rank">
          <select>
            <xsl:for-each select="rank">
              <xsl:sort select="@date-earned" order="descending"/>
              <option><xsl:value-of select="."/> (<xsl:value-of select="@date-earned"/>)</option>
            </xsl:for-each>
          </select>
          </xsl:when>
          <xsl:otherwise>
          Scout
          </xsl:otherwise>
        </xsl:choose>
      </td>
      <td>
        <xsl:choose>
          <xsl:when test="meritbadge">
          <select>
            <xsl:for-each select="meritbadge">
              <xsl:sort select="."/>
              <option><xsl:value-of select="."/> (<xsl:value-of select="@date-earned"/>)</option>
            </xsl:for-each>
          </select>
          </xsl:when>
          <xsl:otherwise>
          (none)
          </xsl:otherwise>
        </xsl:choose>
      </td>
    </tr>
  </xsl:template>
</xsl:stylesheet>