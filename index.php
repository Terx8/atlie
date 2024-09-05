<?php
session_start();

if (!isset($_SESSION['navig'])) 
  $_SESSION['navig'] = "catalog.php"; 

if (!isset($_SESSION['user_id'])) 
  $_SESSION['user_id'] = "-1"; 

if(isset($_POST["exit_btn"]))
{
	$_SESSION['user_state'] = "-1"; 
	$_SESSION['navig'] = "catalog.php"; 
	$_SESSION['user_id'] = "-1"; 

	header("Refresh:0");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ателье</title>
<link rel="stylesheet" href="mystyle.css">
</head>  
<body>
<?php 	include("setup.php");	?>
<div class="topper">

<div class="whole">
    <div class="h1left" >К А Т И Н О</div>
	<div class="h1right" >А Т Е Л Ь Е</div>

</div>
</div>


<div class="whole">
	<div class="navigation">

		<div class="nav_slot">
			<form method = "POST">
			<?php
			if ($_SESSION['user_id'] == "-1")
			{
				echo '<button type="submit" name="navig" value="register.php" >Регистрация</button>
				<br>
				<button style="width:100%; height:40px;" type="submit" name="navig" value="authorise.php">Авторизация</button>
				<br>';
			}
			elseif ($_SESSION['user_id'] == "0")
			{
				echo '<button type="submit" name="navig" value="edit_table.php">Администратор</button>
				<br>
				<button  type="submit" name="exit_btn">Выйти</button>
				<br>';
			}
			else
			{
				echo '<button type="submit" name="navig" value="busket.php">Корзина</button>
				<br>
				<button type="submit" name="navig" value="lk.php">Личный кабинет</button>
				<br>
				<button  type="submit" name="exit_btn">Выйти</button>
				<br>';
			}
			?>
				

			</form>
		
		</div>
		
		<div class="nav_slot">
		<form method = "POST">

			<button style="width:100%; height:40px;" type="submit" name="navig" value="catalog.php">Каталог</button>
			<br>
			<button style="width:100%; height:40px;" type="submit" name="navig" value="feedback.php">Обратная связь</button>
			<br>

		</form>
		</div>
		
		<div class="nav_slot" style="padding: 5%;">
				<?php
		
		$q = "SELECT * FROM (
		  SELECT * FROM feedback ORDER BY id DESC LIMIT 2
		) as r ORDER BY id";
		$mysqliquery = mysqli_query($mysqli, $q);
		while($res=mysqli_fetch_array($mysqliquery))
		{
			echo $res[text]."<br><br>";
		}
		
		?>
		</div>

		
	</div>

	<div class = "main">
	<?php 	
		if (isset($_POST['navig'])){
			$_SESSION['navig'] = $_POST['navig'];
		}
		
		
		include($_SESSION['navig']);	
	
		?>
	</div>
</div>

</body>
</html>


