<?php
	include "header.php";
	$rec = $_SESSION["user_logged"];
	$sql = "UPDATE `msgz` SET `isRead`=1 WHERE msgTo=\"$rec\"";
	mysqli_query($conn, $sql);
	?>
	<body>
		<main>
		<article>

			<form method="POST">
					<p>Till: <input type="text" name="mottagare" value="admin"> (Skriv admin om nyhetstips(eller klagomål))<p>
					<p>Meddelande:</p>
					<textarea name="meddelande"></textarea>
					<input type="submit" name="skic">
				</form>
				<?php
					if(isset($_POST["skic"]))
					{
						$msg = htmlspecialchars(addslashes($_POST["meddelande"]));
						$thisUser = $_SESSION["user_logged"];
						$recipient = htmlspecialchars(addslashes($_POST["mottagare"]));
						$sql = "INSERT INTO `msgz` (`sender`, `msg`, `msgTo`) VALUES (\"$thisUser\", \"$msg\", \"$recipient\");";
						if(mysqli_query($conn, $sql))
						{
							echo "Ditt meddelande har skickats!";
						}
						else
						{
							echo "Något gick fel :( (Kolla användarnamnet)";
						}
					}
				?>
				<?php
					$me = $_SESSION["user_logged"];
					$sql = "SELECT * FROM `msgz` WHERE msgTo = \"$me\" ORDER BY ID DESC";
					$a = array();
					$b = array();
					if($r = mysqli_query($conn, $sql))
					{
						while($row = mysqli_fetch_row($r))
		                {
		                    @$a[]  = $row[1];
		                    @$b[] = $row[2];
		                }

		                for ($i=0; $i < Count($a) ; $i++) 
		                { 
		                	echo "<div style=\"outline: 1px #000 solid; padding: 30px;\"><b>Meddelande från: $a[$i]:</b><p>$b[$i]</p></div>";
		                }
					}
				?>
		</article>
	</main>
	</body>
</html