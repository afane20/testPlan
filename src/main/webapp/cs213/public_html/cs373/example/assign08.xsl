<?xml version="1.0" encoding="ISO-8859-1"?>

<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns="http://www.w3.org/1999/xhtml">
<xsl:template match="bsa">
<html>
	<head>
		<title>Boy Scouts of America</title>
		<link rel="stylesheet" type="text/css" 
			href="assign08.css" />
	</head>
	<body style="text-align: center;">
		<div id="main">
			<h2>Boy Scounts of America</h2>
			<hr />
			<xsl:apply-templates select="council"/>
		</div>
		<a href="assign08.xsl">XSL File</a>
	</body>
</html>
</xsl:template>

<xsl:template match="council">
	<div class="councils">
		<h3><xsl:value-of select="@name" /> Council's Troops</h3>
		<xsl:for-each select="troop">
			<div class="troops">
				<h4><xsl:value-of select="@unitName" /></h4>
				<span class="troopNumber">Troop #
					<xsl:value-of select="@troopNum" /></span>
				<xsl:apply-templates select="scout" />
			</div>
		</xsl:for-each>
	</div>
</xsl:template>

<xsl:template match="scout">
	<div class="scout">
		<div class="ranks">
		<xsl:apply-templates select="rank" />
		</div>
		<span class="scoutName">
			<xsl:value-of select="firstName" />&#160;
			<xsl:value-of select="lastName" />
		</span>
		<br/>
		<span class="phoneNumber"><xsl:value-of select="phone" /></span>
		<div class="meritBadges">
			<b>Merit Badges Earned:</b><br/>
			<ul>
			<xsl:apply-templates select="meritbadge" />
			</ul>
		</div>
		<div class="address">
			<b>Address:</b><br/>
			<xsl:value-of select="address/street" /><br/>
			<xsl:value-of select="address/city" />,&#160;
			<xsl:value-of select="address/state" />
		</div>
		
	</div>
</xsl:template>

<xsl:template match="rank">
<span class="rank"><xsl:value-of select="." /> - 
<xsl:value-of select="@date-earned" /></span>
</xsl:template>

<xsl:template match="meritbadge">
	<li><xsl:value-of select="." /> -
	<xsl:value-of select="@date-earned" /></li>
</xsl:template>

</xsl:stylesheet>