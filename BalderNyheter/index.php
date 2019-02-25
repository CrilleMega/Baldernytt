<!doctype html>
	<?php
		include "header.php";
	?>
	<main>
		<?php
		if(isset($_SESSION["user_logged"]))
		{
			if($_SESSION["user_logged"] == "admin")
			{
				echo"<article>
				<form method=\"POST\">
				<input type=\"text\" name=\"artic\"><input type=\"submit\" name=\"sql_go\" value=\"Skriv ID på post att ta bort\">
				<br><br>
				<input type=\"text\" name=\"comm\"><input type=\"submit\" name=\"sql_com\" value=\"Skriv ID på kommentar att ta bort\">
				</form>
				</article>";
				if(isset($_POST["sql_go"]))
				{
					$ID_TR = htmlspecialchars($_POST["artic"]);
					$sql = "DELETE FROM `inlagg` WHERE ID = \"$ID_TR\"";
					if(mysqli_query($conn, $sql))
					{
						echo "<article><h4 style=\"color: green;\">Tog bort inlägg.</h4></article>";
					}
					else
					{
						echo "<article><h4 style=\"color: red;\">Kunde ej ta bort inlägg.</h4></article>";
					}
				}
				else if(isset($_POST["sql_com"]))
				{
					$ID_TR = htmlspecialchars($_POST["comm"]);
					$sql = "DELETE FROM `comment` WHERE ID = \"$ID_TR\"";
					if(mysqli_query($conn, $sql))
					{
						echo "<article><h4 style=\"color: green;\">Tog bort Kommentar.</h4></article>";
					}
					else
					{
						echo "<article><h4 style=\"color: red;\">Kunde ej ta bort Kommentar.</h4></article>";
					}
				}
			}
		}
		$sql = "SELECT * FROM `comment` WHERE 1=1 ORDER BY ID ASC";
		$comList = array();
		if ($result = mysqli_query($conn,$sql)) 
		{
		 while($row = mysqli_fetch_object($result))
			    {
			    	$Com = new Comment();
			    	//$Com = new Comment($row[0], $row[1], $row[2], $row[3]);
			    	$Com->ID = $row->ID;
			        $Com->comtext = $row->comtext;
			        $Com->comOn = $row->comon;
			        $Com->sender = $row->sender;
			        $Com->dateS = $row->date;
			        array_push($comList, $Com);
			    }
				
			}
			//Skriv ut endast en artikel om query ej tom.
			if(strlen($_SERVER["QUERY_STRING"]) > 0)
			{
				$querID = $_SERVER["QUERY_STRING"];
				$sql = "SELECT * FROM `inlagg` WHERE id = $querID;";
			}
			//Skriv ut alla inlägg om query är tom.
			else
			{
				$sql = "SELECT * FROM `inlagg` WHERE 1=1 ORDER BY id DESC";
			}
			if ($result = mysqli_query($conn,$sql)) 
			{
			     while($row = mysqli_fetch_row($result))
			    {
			    	$ID[] = $row[0];
			        $bild[]  = $row[1];
			        $content[] = $row[2];
			        $date[] = $row[3];
			    }
			    if(Count($content) < 1)
			    {
			    	header("Location: index.php");
			    }
			    for ($i=0; $i < Count($content); $i++) 
			    { 
				    //Om det finsn en query.
			    	if(strlen($_SERVER["QUERY_STRING"]) > 0)
					{
				    	if(strlen($bild[$i]) > 6)
				    	{
				    		echo"<article><img src=\"$bild[$i]\" alt=\"bild\"></img>", $content[$i], "<span>", $date[$i], "</span>";
				    	}
				    	else
				    	{
				    		echo"<article>", $content[$i], "<span>", $date[$i], "</span>";
				    	}

						$combox = "combox" . $i;
						$submit = "submit" . $i;
						$comid =  $ID[$i];
						//SKRIV UT KOMMENTARER UNDER DIV
						echo "<br><br><h3>Kommentarer</h3><div class=\"comholder\">";
						
						foreach ($comList as $comment)
						{
							$sql = "SELECT * FROM `users` WHERE `username` = \"$comment->sender\"";
							if($result = mysqli_query($conn, $sql))
							{
								$com = new Comment();
								while($row = mysqli_fetch_row($result))
								{
									$com->img = $row[2];
								}
								if(strlen($com->img) > 6)
								{
									$comment->img = $com->img;
								}
								else
								{
									$comment->img = "pp/deleted.png";
								}
							}
							if($comment->comOn == $ID[$i] ||$comment->comOn == 0)
							{
								if(strtolower($comment->sender) == "null" || strtolower($comment->sender) == "admin")
								{
									echo "<div class=\"comment\"><img src=\"$comment->img\" style=\"width: 5em; height: 5em; border-radius: 5em;\"><br><b class=\"mod\">$comment->sender</b><p>$comment->comtext</p><span>$comment->dateS</span>";
								}
								else
								{
									echo "<div class=\"comment\"><img src=\"$comment->img\" style=\"width: 5em; height: 5em; border-radius: 5em;\"><br><b>$comment->sender</b><p>$comment->comtext</p><span>$comment->dateS</span>";
								}
								if(isset($_SESSION["user_logged"]))
								{
									if($_SESSION["user_logged"] == "admin")
									{
										echo"<span>ID: $comment->ID</span></div>";
									}
									else
									{
										echo"</div>";
									}
								}
								else
								{
									echo"</div>";
								}
							}
						}
						if(isset($_SESSION["user_logged"]))
							{
								echo "<form class=\"combox\" method=\"POST\"><textarea name=\"$combox\" placeholder=\"Kommentar\"></textarea><input type=\"submit\" name=\"$submit\" value=\"Kommentera\"></form></div>";
					    	if($_SESSION["user_logged"] == "admin")
					    	{
					    		echo "<br><span>ID = $ID[$i]</span></article>";
					    	}
					    	else
					    	{
								echo "</article>";
							}
						}
						else
						{
							echo "<p style=\"text-align: center;\">Vänligen logga in för att kommentera.</p></article>";
						}
			    	}
			    	else
			    	{
		    		//Preview
		    		$content[$i] = preg_replace('/<p[^>]*>([\s\S]*?)<\/p[^>]*>/', '', $content[$i]);
		    		$header = preg_replace('/<b[^>]*>([\s\S]*?)<\/b[^>]*>/', '', $content[$i]);
		    		$inledning = preg_replace('/<h2[^>]*>([\s\S]*?)<\/h2[^>]*>/', '', $content[$i]);
		    		if(strlen($bild[$i]) > 6)
			    	{
			    		echo"<article><img src=\"$bild[$i]\" alt=\"bild\"></img><a href=\"?$ID[$i]\">", $header, "</a>", $inledning, "</article>";
			    	}
			    	else
			    	{
			    		echo"<article>", $content[$i], "</article>";
			    	}
		    	}
		    }

		    //Skriv ut kommentarer.
			for ($i=0; $i < Count($ID); $i++) 
			{ 
				$strset = "submit" . "$i";
				$comset = "combox" . "$i";
				if(isset($_POST[$strset]))
				{
					$idpost = $ID[$i];
					if($_SESSION["user_logged"] != "admin")
					{
						$comment = htmlspecialchars(addslashes($_POST[$comset]));
					}
					else
					{
						$comment = $_POST[$comset];
					}
					$comment = str_replace("\n", "<br>", $comment);
					$sender = $_SESSION["user_logged"];
					@$datesent = strval(date("d/m/Y") . " - " . date("H:i"));
					$sql = "INSERT INTO `comment` (`comtext`, `comon`, `sender`, `date`) VALUES (\"$comment\", $idpost, \"$sender\", \"$datesent\");";
					if(mysqli_query($conn, $sql))
					{
						echo "<script>location.replace('index.php?", $_SERVER["QUERY_STRING"], "');</script>";
					}
					else
					{
						echo"Error";
					}
				}
			}
		}
		class Comment
		{
			public $ID;
			public $sender; 
			public $comtext; 
			public $comOn;
			public $dateS;
			public $img;
		}
		?>
	</main>
</body>
</html>