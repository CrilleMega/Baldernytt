 <!doctype html>
	<?php include "header.php";?>
	<main>
		<article>
			<form method="POST">
				<p>Användarnamn: <input type="Text" name="user"></p>
				<p>Lösenord: &nbsp;&nbsp;  &nbsp; &nbsp; &nbsp; <input type="Password" name="pass"></p>
				<input type="submit" name="sub" value="Logga in">
				<input type="submit" name="create" value="Skapa konto">

					<?php
					@$user = $_POST["user"];
					if(strlen($user)> 3)
					{
						$user = htmlspecialchars($_POST["user"]);
					}
					else
					{
						$user = "null";
					}
					@$pass = hash("sha256", htmlspecialchars($_POST["pass"]));
					$a = array();
					$b = array();
					if(isset($_POST["sub"]))
					{
						$sql = "SELECT * FROM `users` WHERE username = \"$user\"";
						if ($result = mysqli_query($conn,$sql)) 
						{
							if(isset($_POST["sub"]))
							{
							     while($row = mysqli_fetch_row($result))
							    {
							        $a[]  = $row[0];
							        $b[] = $row[1];
							    }
							    #var_Dump($a, $b);
							    if(Count($b)>0)
							    {
								    if($pass == $b[0])
								    {
								    	echo"Logged in";

								    	$_SESSION["user_logged"] = $user;
								    	header("Location: index.php");
								    }
								    else
								    {
								    	echo "<br>Failed to login.";
								    }
							    }
							    else
							    {
							    	echo "<br>Failed to login.";
							    }
							}
						}
					}
					else if (isset($_POST["create"]))
					{
						if(strlen($user) > 3 && strlen($user) < 32)
						{
							$sql = "SELECT * FROM `users` WHERE `username` = \"$user\"";
							if ($result = mysqli_query($conn, $sql)) 
			                {
			                     while($row = mysqli_fetch_row($result))
			                    {
			                        @$a[]  = $row[2];
			                        @$b[] = $row[3];
			                    }
			                    if(Count($a) > 0)
			                    {
			                    	if($user == "null")
			                    	{
			                    	echo "<br>Layer 8 problem.";
			                    	}
			                    	else
			                    	{
			                    	echo "<br>Användaren \"$user\" finns redan.";
			                    	}
			                    }
			                    else
			                    {
			                    	$sql = "INSERT INTO `users` (`username`, `password`, `img`) VALUES (\"$user\",  \"$pass\", \"pp/noimg.jpg\");";
			                    	if(mysqli_query($conn, $sql))
			                    	{
			                    		echo "<br>Användaren $user skapad!";
			                    	}
			                    	else
			                    	{
			                    		echo "Något gick fel wtf<br>";	                    		
			                    		var_dump($user, $pass);
			                    	}
			                    }
			                }
						}
						else
						{
							echo "<br>Layer 8 problem";
						}

					}
					?>
			</form>
			<h2>Hur du skapar ett konto:</h2>
			<ul>
				<li>Skriv in använder namn och lösenord</li>
				<li>Tryck Skapa konto</li>
				<li>Klar!</li>
			</ul>
		</article>
	</main>
</body>
</html>