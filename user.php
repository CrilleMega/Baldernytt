<?php
include "header.php";

?>
	<main>
		<article>
			<?php
				if(!isset($_SESSION["user_logged"]))
				{
					header("Location: index.php");
				}
				else
				{
					$user = $_SESSION["user_logged"];
					echo "<h2>Konto:  ", $_SESSION["user_logged"],"</h2>";
				}

			?>
			<form method="POST" enctype="multipart/form-data">
				<input type="file" name="bild">
				<input type="submit" name="sub" value="Ändra bild">
			</form>
			<br>
			<hr>
			<form method="POST">
				<p>Nytt Lösenord:<br><input type="password" name="newpass"></p>
				<input type="submit" name="changepass" value="Ändra lösenord">
			</form>
			<br>
			<hr>
			<form method="POST">
				<input style="background-color: red;" type="submit" name="remacc" value="Ta bort konto.">
			</form>
		</article>
	</main>
</html>
<?php
$user = $_SESSION["user_logged"];
if(isset($_POST["sub"]))
{
	$fileName = strval(str_replace(" ", "", ($_FILES["bild"]["name"])));
    $size = getimagesize($_FILES["bild"]["tmp_name"]); 
    $path = "pp/" . $user . "$fileName";

    if (strlen($fileName) >3) 
        {
            try
            {
               if ($size) 
               {
                    $move = move_uploaded_file($_FILES['bild']['tmp_name'], $path);
                    
                    if ($move !== false) 
                    {
                    	$sql = "UPDATE `users` SET `img` = \"$path\" WHERE `username` = \"$user\"";
                    	if(mysqli_query($conn, $sql))
						{
							echo "Bilden är uppladdad!";
						}
						else
						{
							echo "Något gick fel wtf";
						}
                        mysqli_close($conn);
                    }
                    else if ($move == false)
                    {
                        echo "Filen kunde inte laddas upp.";                       
                    }
                }
            }
            catch(Exception $e)
            {
             echo $e->getMessage();
            }
       }
}
else if (isset($_POST["changepass"]))
{
	$newpass = htmlspecialchars(addslashes(hash("sha256", $_POST["newpass"])));
	var_dump($newpass, $user);
	$sql = "UPDATE `users` SET `password` = \"$newpass\" WHERE `username` = \"$user\"";
	if(mysqli_query($conn, $sql))
	{
		echo "Lösenord ändrat!";
	}
	else
	{
		echo "Något gick fel, skyll på vår inkompetenta admin.";
	}
}
else if(isset($_POST["remacc"]) && $user != "admin")
{
	$sql = "DELETE FROM `users` WHERE `username` = \"$user\"";
	if(mysqli_query($conn, $sql))
	{
		session_destroy();
		header("Location: index.php");
	}
}
?>