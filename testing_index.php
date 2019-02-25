<!doctype html>
	<?php
		include "header.php";
		$comList = array();
		$articleList = array();
	?>
	<main>
		<?php

		//Skriv ut endast en artikel om query ej tom.
		if(strlen($_SERVER["QUERY_STRING"]) > 0)
		{
			$querID = $_SERVER["QUERY_STRING"];
			$sql = "SELECT * FROM `inlagg` WHERE ID = $querID;";
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
		    	$art = new Article();
		    	$art->ID = $row[0];
		        $art->Bild  = $row[1];
		        $art->Content = $row[2];
		        $art->Date = $row[3];
		        array_push($articleList, $art);
		    }
		    if(Count($content) < 1)
		    {
		    	//header("Location: index.php");
		    }

		    for ($i=0; $i < Count($articleList); $i++) 
		    { 
			    //Om det finsn en query.
		    	if(strlen($_SERVER["QUERY_STRING"]) > 0)
				{
					$querID = $_SERVER["QUERY_STRING"];
			    	$articleList[$i]->printArt();

			    	$sql = "SELECT * FROM `comment` WHERE `comon` = $querID ORDER BY ID ASC";
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

							$comment->PrintCom();

							echo "</div>";
						}
					if(isset($_SESSION["user_logged"]))
						{
							echo "<form class=\"combox\" method=\"POST\"><textarea name=\"$combox\" placeholder=\"Kommentar\"></textarea><input type=\"submit\" name=\"$submit\" value=\"Kommentera\"></form></div>";
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
	}
		class Comment
		{
			public $ID;
			public $img;

			public $sender; 
			public $comtext; 

			public $comOn;
			public $dateS;

			function PrintCom()
			{
				$strCom ="<div class=\"comment\"><img src=\"$this->$img\" style=\"width: 5em; height: 5em; border-radius: 5em;\"><br>";

				if($sender == "admin" || $sender == "null")
				{
					$strCom . "<b class=\"mod\">";
				}
				else
				{
					$strCom . "<b>";
				}
				$strCom . "$this->$sender</b><p>$this->$comtext</p><span>$this->$dateS</span>";

				echo $strCom;
			}
		}

		class Article
		{
			public $ID;
			public $Bild;

			public $Content;
			public $Date;

			function printArt()
			//Why this no work wtf
			{
				$fullart = "<article>";
				if(strlen($Bild) > 3)
				{
					$fullart . "<img src=\"$this->$Bild\" alt=\"$this->$ID\"></img>";
				}
				$fullart . $Content;
				$fullart . "<span>$this->$Date</span>";
				$fullart . "</article>";
				echo $fullart;
				echo "Hello";
			}

			function printPreview()
			{

			}
		}
		?>
	</main>
</body>
</html>
<?php
/**

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

		**/

		?>