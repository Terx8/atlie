<div class="pretty_form">
<h2>Регистрация</h2>
<form method="POST">

логин:<input style="width:100%; height:20px;" type="text" name="username_rinput">
<br>
пароль:<input style="width:100%; height:20px;" type="password" name="password_rinput" >
<br>
имя:<input style="width:100%; height:20px;" type="text" name="name_rinput">
<br>
email:<input style="width:100%; height:20px;" type="text" name="email_rinput" >
<br><br>
<button  type="submit" name="do_register_btn">Зарегистрироваться</button>
</form>
</div>
<?php

if(isset($_POST["do_register_btn"]))
{
	$login=$_POST["username_rinput"];
	$pass=$_POST["password_rinput"];
	$name=$_POST["name_rinput"];
	$email=$_POST["email_rinput"];

	if (empty($pass) || empty($login) || empty($name) || empty($email))
		echo "Заполните все поля!";
	else
	{	
		$query = "SELECT * FROM users WHERE login='$login'";
		$mysqliquery = mysqli_query($mysqli, $query); 
		if (!empty($mysqliquery))
		{	if ($res=mysqli_fetch_array($mysqliquery))
			{
				echo "Такой пользователь уже зарегистрирован!";
			}
			else
			{
				$query = "INSERT INTO users (login, pass, name, email) VALUES ('$login', '$pass', '$name', '$email')";
				$mysqliquery = mysqli_query($mysqli, $query); 
				
				$query = "SELECT * FROM users WHERE login='$login' AND pass='$pass'";

				$mysqliquery = mysqli_query($mysqli, $query); 
				if (!empty($mysqliquery))
				{	if ($res=mysqli_fetch_array($mysqliquery))
					{
						$_SESSION['user_state']=$res[id];
						$_SESSION['user_id']=$res[id];
						$_SESSION['navig'] = "catalog.php"; 

						header("Refresh:0");
					}
					else
						echo "Ошибка регистрации!";
				}			
			}
		}
	}

}




?>
