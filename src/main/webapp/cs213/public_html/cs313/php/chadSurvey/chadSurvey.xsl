<?xml version="1.0" encoding="ISO-8859-1"?>

<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns="http://www.w3.org/1999/xhtml">
<xsl:template match="surveyStats">
<html>
	<head>
		<title>Survey Results</title>
		<link rel="stylesheet" type="text/css" 
			href="chadSurvey.css" />
	</head>
	<body>
		<div id="headerDiv">
		<b class="top">
			<b class="b1"></b>
			<b class="b2"></b>
			<b class="b3"></b>
			<b class="b4"></b>
		</b>
			<div class="content">
			<h3>Survey Results</h3>
			<p><b><xsl:value-of select="count"/></b> people have 
			taken the survey. The following results are broken
			up into 5 sections, for the 5 questions. The numbers
			represent the number of people that took the survey
			that answered the question with the corresponding
			answer.
			If you do not see your results, refresh the page.
			</p>
			</div>
		</div>
		<div id="surveyDiv">
			<div class="content">
			<xsl:apply-templates select="question1"/>
			<xsl:apply-templates select="question2"/>
			<xsl:apply-templates select="question3"/>
			<xsl:apply-templates select="question4"/>
			<xsl:apply-templates select="question5"/>
			<a href="chadSurvey.html">Back to the survey</a>
			</div>
			<b class="bottom">
				<b class="b4"></b>
				<b class="b3"></b>
				<b class="b2"></b>
				<b class="b1"></b>
			</b>
		</div>
	</body>
</html>
</xsl:template>

<xsl:template match="question1">
	<div class="questionDiv">
	<p><span class="question">How far away from campus do you live?
	</span><br/>
	<b><xsl:value-of select="answer1" /></b> people live &lt;=2 blocks
	from campus.<br/>
	<b><xsl:value-of select="answer2" /></b> people live 3 to 5 blocks
	from campus.<br/> 
	<b><xsl:value-of select="answer3" /></b> people live &gt;= 6 blocks
	from campus.<br/> 
	</p>
	</div>
</xsl:template>

<xsl:template match="question2">
	<div class="questionDiv">
	<p><span class="question"> Do you drive a car to school?</span><br/>
	<b><xsl:value-of select="answer1" /></b> people drive to school.<br/>
	<b><xsl:value-of select="answer2" /></b> people don't drive to school.
	<br/> 
	</p>
	</div>
</xsl:template>

<xsl:template match="question3">
	<div class="questionDiv">
	<p>
	<span class="question">Do you have a parking permit?</span><br/>
	<b><xsl:value-of select="answer1" /></b> people have a permit.<br/>
	<b><xsl:value-of select="answer2" /></b> people don't have a permit.
	<br/> 
	<b><xsl:value-of select="answer3" /></b> people said it was not
	applicable to them.<br/> 
	</p>
	</div>
</xsl:template>

<xsl:template match="question4">
	<div class="questionDiv">
	<p>
	<span class="question">Do you have trouble finding a parking spot?
	</span><br/>
	<b><xsl:value-of select="answer1" /></b> people have trouble.<br/>
	<b><xsl:value-of select="answer2" /></b> people don't have trouble.
	<br/> 
	<b><xsl:value-of select="answer3" /></b> people said it was not
	applicable to them.<br/> 
	</p>
	</div>
</xsl:template>

<xsl:template match="question5">
	<div class="questionDiv">
	<p>
	<span class="question"> Would you agree/disagree with the school only
	giving permits to 
	students that live more than 2 blocks away from campus?</span><br/>
	<b><xsl:value-of select="answer1" /></b> people agree.<br/>
	<b><xsl:value-of select="answer2" /></b> people disagree.<br/> 
	<b><xsl:value-of select="answer3" /></b> people had no comment.<br/> 
	</p>
	</div>
</xsl:template>


</xsl:stylesheet>
