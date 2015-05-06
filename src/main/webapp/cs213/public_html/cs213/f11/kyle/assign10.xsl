<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html lang="en" xml:lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Student List</title>
      <link rel="stylesheet" type="text/css" href="http://157.201.194.254/~atk40000/mortgage.css" />
      <style type="text/css">
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
          border-bottom:2px solid black;
        }
        select
        {
          width:100%;
        }
      </style>
    </head>
    <body>
      <h1>Student List</h1>
      <table>
        <tr>
          <th>Name:</th>
          <th>Location:</th>
          <th>College:</th>
          <th>Department:</th>
          <th>Majors (ID):</th>
        </tr>
        <xsl:for-each select="studentList/student">
          <xsl:sort select="college/@name"/>
          <xsl:sort select="name/last"/>
          <xsl:sort select="name/first"/>
          <xsl:sort select="name/middle"/>
     
          <xsl:apply-templates select="."/>
        </xsl:for-each>
      </table>
    </body>
    </html>
  </xsl:template>

  <xsl:template match="student">
    <tr>
      <td>
      <xsl:choose>
        <xsl:when test="name/middle">
          <xsl:value-of select="name/first"/>&#160;<xsl:value-of
              select="name/middle"/>&#160;<xsl:value-of select="name/last"/>
        </xsl:when>
        <xsl:otherwise>
          <xsl:value-of select="name/first"/>&#160;<xsl:value-of select="name/last"/>
        </xsl:otherwise>
      </xsl:choose>
      </td>
      <td><xsl:value-of select="location/city"/>, <xsl:value-of select="location/state"/></td>
      <xsl:choose>
        <xsl:when test="college/@name">
          <td><xsl:value-of select="college/@name"/></td>
        </xsl:when>
        <xsl:otherwise>
          <td>No College On Record</td>
        </xsl:otherwise>
      </xsl:choose>
      <xsl:choose>
        <xsl:when test="college/department/@name">
          <td><xsl:value-of select="college/department/@name"/></td>
        </xsl:when>
        <xsl:otherwise>
          <td>No Department On Record</td>
        </xsl:otherwise>
      </xsl:choose>
      <xsl:choose>
        <xsl:when test="college/department/major">
          <td>
            <select>
              <xsl:for-each select="college/department/major">
                <option><xsl:value-of select="."/> (<xsl:value-of select="@id"/>)</option>
              </xsl:for-each>
            </select>
          </td>
        </xsl:when>
        <xsl:otherwise>
          <td>No Major On Record</td>
        </xsl:otherwise>
      </xsl:choose>
    </tr>
  </xsl:template>
</xsl:stylesheet>