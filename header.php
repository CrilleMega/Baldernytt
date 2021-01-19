<?php 
include "db.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!--

      /`·.¸
     /¸...¸`:·
 ¸.·´  ¸   `·.¸.·´)
: © ):´;      ¸  {
 `·.¸ `·  ¸.·´\`·¸)
     `\\´´\¸.·´

 -->
<head>
	 <meta name="Description" CONTENT="Ën äkta nyhetskällan. - Allt annat är fake news.">
	 <meta lang="sv">
	 <meta charset="utf-8">
	<?php
		if(isset($_SERVER["QUERY_STRING"]))
		{
			$idhead =  $_SERVER["QUERY_STRING"];
			$sql = "SELECT * FROM `inlagg` WHERE ID=$idhead;";
			if($result = mysqli_query($conn, $sql))
			{
				 while($row = mysqli_fetch_row($result))
			    {
			        $cont[] = $row[2];
			    }
			    $cont[0] = preg_replace('/<p[^>]*>([\s\S]*?)<\/p[^>]*>/', '', $cont[0]);

		    	$het = preg_replace('/<b[^>]*>([\s\S]*?)<\/b[^>]*>/', '', $cont[0]);
		    	$het = str_replace("<h2>", "", $het);
		    	$het = str_replace("</h2>", "", $het);
		    	$het = str_replace("<br>", "", $het);
		    	$het = str_replace("</p>", "", $het);
		    	$het = str_replace("<p>", "", $het);
		    	$het .= " - Baldernytt";
		    	echo "<title>$het</title>";
			}
			else
			{
				echo "<title>BalderNytt - Allt annat är fake news.</title>";
			}
		}
		else
		{
		echo "<title>BalderNytt - Allt annat är fake news.</title>";
		}
	?>
	<!--<title>Baldernytt - Allt annat är fake news.</title>-->
	  <link rel="stylesheet" type="text/css"href="css/main.css">
	  <link rel="icon"  href="icon.png">
	  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-9888733389727187",
    enable_page_level_ads: true
  });
</script>
</head>
<body>
 	
 <header>
 	
 	<?php
 		if(isset($_SESSION["user_logged"]))
		{
			$admin = False;
			$sql = "SELECT * FROM `users` WHERE power=1;";
			if($result = mysqli_query($conn, $sql))
			{
			 while($row = mysqli_fetch_row($result))
				{
				    if(strtolower($row[0]) == strtolower($_SESSION["user_logged"]))
				    {
				    	$admin = True;
				    }
				}
			}
			$rec = $_SESSION["user_logged"];
			$sql = "SELECT * FROM `msgz` WHERE msgTo=\"$rec\" AND isRead = 0;";
			$msgcount = 0;
			if($result = mysqli_query($conn, $sql))
			{
			 while($row = mysqli_fetch_row($result))
				{
					$msgcount++;
				}
			}
			//var_dump($admin);
		}
		?>
 	<!--<h1 onclick="home()">BalderNytt</h1>-->
 	<div style="display: flex; justify-content: space-around;">
 	<img src="logga.png" style="margin: 1px auto;">
 	</div>
 	<h4>Allt annat är fake news.</h4>
 	<?php
if(isset($_SESSION["user_logged"]))
	{
	echo "<p style=\"text-align: center;\">Inloggad som:\"", $_SESSION["user_logged"] ,"\".</p>";
	}
?>
<hr>
 <nav>
 	<a href="index.php">Hem</a>
 	<?php
		if(isset($_SESSION["user_logged"]))
		{
 			echo "<a href=\"user.php\">Konto</a>";
			if($admin == True)
			{
				echo "<a href=\"write.php\">Skriv inlägg</a>";
			}
			if($msgcount > 0)
			{
				echo "<a href=\"inbox.php\">Inbox($msgcount)</a>";
			}
			else
			{
				echo "<a href=\"inbox.php\">Inbox</a>";
			}
			echo "<a href=\"logout.php\">Logga ut.</a>";
		}
		else
		{
			echo "<a href=\"login.php\">Logga in</a>";
		}
 	?>
 </nav>
 <hr>
 </header>
 