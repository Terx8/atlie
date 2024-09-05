<div class="pretty_form">
<h2>Авторизация</h2>
<form method="POST">

логин:<input style="width:100%; height:20px;" type="text" name="username_input"
value="<?php
if (!empty($_POST["username_input"]))
echo $_POST["username_input"];
?>"
>
<br>
пароль:<input style="width:100%; height:20px;" type="password" name="password_input" 
value="<?php
if (!empty($_POST["password_input"]))
echo $_POST["password_input"];
?>"
>
<br><br>
<button  type="submit" name="enter_btn">Войти</button>

</form>
</div>

<?php
if(isset($_POST["enter_btn"]))
{
	$login=$_POST["username_input"];
	$password=$_POST["password_input"];
	
	if (empty($password) || empty($login))
		echo "Введите данные!";
	else
	{	

		if ($login == 'admin' and strval($password) == '123')
		{
			$_SESSION['user_state']="0";
			$_SESSION['user_id']="0";
			$_SESSION['navig'] = "edit_table.php"; 
			header("Refresh:0");
		}
		else
		{
			$query = "SELECT * FROM users WHERE login='$login' AND pass='$password'";
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
					echo "Такой пользователь не зарегистрирован";
			}	
		}		
		
	}
}

?>
