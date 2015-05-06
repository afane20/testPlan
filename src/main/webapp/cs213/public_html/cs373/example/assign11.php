<?php
	header("Cache-Control:no-cache");

   $view = $_REQUEST['view'];
	if ($view == 'true')
	{
		header("Location: surveyStats.xml");
		exit;
	}

   session_start();
   if (($_COOKIE['voted'] == 'true') OR ($_SESSION['voted'] == true))
	{
		echo("You have already taken this survey.<br/>\n");
      echo("Browswer will redirect in 5 sec.<br/>\n");
      echo("<a href='assign11.php?view=true'>View Results</a>");      
      echo("<script type='text/javascript'>\n");
      echo("setTimeout('");
      echo("window.location = \"assign11.php?view=true\"', 5000);");
      echo("</script>");
		exit(1);
	}
	else
	{
		$_SESSION['voted'] = true;
      setcookie('voted', 'true', time() + 86400);
	}
	
	$blocks = $_POST['blocks'];
	$drive = $_POST['drive'];
	$permit = $_POST['permit'];
	$trouble = $_POST['trouble'];
	$policy = $_POST['policy'];

	// open and read file
	$data = file('surveyStats.xml');
	
	for($i = 0; $i < sizeof($data); $i++)
	{
		if (preg_match('/\<question1\>/' ,$data[$i]) == 1)
		{
			preg_match('/\<answer1\>(\d+)\<\/answer1\>/', $data[++$i], $matches);
			$blocks2 = intval($matches[1]);
			preg_match('/\<answer2\>(\d+)\<\/answer2\>/', $data[++$i], $matches);
			$blocks4 = intval($matches[1]);
			preg_match('/\<answer3\>(\d+)\<\/answer3\>/', $data[++$i], $matches);
			$blocks6 = intval($matches[1]);
		}
		elseif(preg_match("/\<question2\>/" ,$data[$i]) == 1)
		{
			preg_match('/\<answer1\>(\d+)\<\/answer1\>/', $data[++$i], $matches);
			$driveY = intval($matches[1]);
			preg_match('/\<answer2\>(\d+)\<\/answer2\>/', $data[++$i], $matches);
			$driveN = intval($matches[1]);
		}
		elseif(preg_match("/\<question3\>/" ,$data[$i]) == 1)
		{
			preg_match('/\<answer1\>(\d+)\<\/answer1\>/', $data[++$i], $matches);
			$permitY = intval($matches[1]);
			preg_match('/\<answer2\>(\d+)\<\/answer2\>/', $data[++$i], $matches);
			$permitN = intval($matches[1]);
			preg_match('/\<answer3\>(\d+)\<\/answer3\>/', $data[++$i], $matches);
			$permitNA = intval($matches[1]);
		}
		elseif(preg_match("/\<question4\>/" ,$data[$i]) == 1)
		{
			preg_match('/\<answer1\>(\d+)\<\/answer1\>/', $data[++$i], $matches);
			$troubleY = intval($matches[1]);
			preg_match('/\<answer2\>(\d+)\<\/answer2\>/', $data[++$i], $matches);
			$troubleN = intval($matches[1]);
			preg_match('/\<answer3\>(\d+)\<\/answer3\>/', $data[++$i], $matches);
			$troubleNA = intval($matches[1]);
		}
		elseif(preg_match("/\<question5\>/" ,$data[$i]) == 1)
		{
			preg_match('/\<answer1\>(\d+)\<\/answer1\>/', $data[++$i], $matches);
			$policyA = intval($matches[1]);
			preg_match('/\<answer2\>(\d+)\<\/answer2\>/', $data[++$i], $matches);
			$policyD = intval($matches[1]);
			preg_match('/\<answer3\>(\d+)\<\/answer3\>/', $data[++$i], $matches);
			$policyNC = intval($matches[1]);
		}
		elseif(preg_match('/\<count\>(\d+)\<\/count\>/', $data[$i], $matches) == 1)
		{
			$count = intval($matches[1]);
		}
	}
	
	$count++;
	
	if($blocks == 2)
	{
		$blocks2++;
	}
	elseif($blocks == 4)
	{
		$blocks4++;
	}
	elseif($blocks == 6)
	{
		$blocks6++;
	}
	
	if($drive == 'Y')
	{
		$driveY++;
	}
	elseif($drive == 'N')
	{
		$driveN++;
	}
	
	if($permit == 'Y')
	{
		$permitY++;
	}
	elseif($permit == 'N')
	{
		$permitN++;
	}
	elseif($permit == 'NA')
	{
		$permitNA++;
	}
	
	if($trouble == 'Y')
	{
		$troubleY++;
	}
	elseif($trouble == 'N')
	{
		$troubleN++;
	}
	elseif($trouble == 'NA')
	{
		$troubleNA++;
	}
	
	if($policy == 'A')
	{
		$policyA++;
	}
	elseif($policy == 'D')
	{
		$policyD++;
	}
	elseif($policy == 'NC')
	{
		$policyNC++;
	}
	
	//over write new xml document
	$fileName = 'surveyStats.xml';
	$xmlFile = fopen($fileName, 'w+');
	$fileSize = filesize($fileName);
	
	$contents = "<?xml version='1.0' encoding='iso-8859-1' ?>\n";
	$contents .= "<?xml-stylesheet type='text/xsl' href='assign11.xsl' ?>\n";
	$contents .= "<surveyStats>\n";
	$contents .= "\t<count>$count</count>\n";
	$contents .= "\t<question1>\n";
	$contents .= "\t\t<answer1>$blocks2</answer1>\n";
	$contents .= "\t\t<answer2>$blocks4</answer2>\n";
	$contents .= "\t\t<answer3>$blocks6</answer3>\n";
	$contents .= "\t</question1>\n";
	$contents .= "\t<question2>\n";
	$contents .= "\t\t<answer1>$driveY</answer1>\n";
	$contents .= "\t\t<answer2>$driveN</answer2>\n";
	$contents .= "\t</question2>\n";
	$contents .= "\t<question3>\n";
	$contents .= "\t\t<answer1>$permitY</answer1>\n";
	$contents .= "\t\t<answer2>$permitN</answer2>\n";
	$contents .= "\t\t<answer3>$permitNA</answer3>\n";
	$contents .= "\t</question3>\n";
	$contents .= "\t<question4>\n";
	$contents .= "\t\t<answer1>$troubleY</answer1>\n";
	$contents .= "\t\t<answer2>$troubleN</answer2>\n";
	$contents .= "\t\t<answer3>$troubleNA</answer3>\n";
	$contents .= "\t</question4>\n";
	$contents .= "\t<question5>\n";
	$contents .= "\t\t<answer1>$policyA</answer1>\n";
	$contents .= "\t\t<answer2>$policyD</answer2>\n";
	$contents .= "\t\t<answer3>$policyNC</answer3>\n";
	$contents .= "\t</question5>\n";
	$contents .= "</surveyStats>";
	
	fwrite($xmlFile, $contents);
	fclose($xmlFile);
	header("Location: surveyStats.xml");
?>