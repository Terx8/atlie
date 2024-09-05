
<div class="pretty_form">
<h2>Личная информация</h2>

<form method="POST">
<?php

$q = "SELECT * FROM users WHERE id = ".$_SESSION['user_id'];

$query = mysqli_query($mysqli, $q);
if (!empty($query))
{
	$res=mysqli_fetch_array($query);
}
$read_only_state="readonly";
$hidden_change="";
$hidden_two="hidden";
$see_pass="password";

if (isset($_POST["cancel_changes_btn"]))
{
	$read_only_state="readonly";
	$hidden_change="";
	$hidden_two="hidden";
	$see_pass="password";
}

if (isset($_POST["change_btn"]))
{
	$read_only_state="";
	$hidden_two="";
	$hidden_change="hidden";
	$see_pass="text";
}

?>

<table style = "margin: auto; text-align: center;">

	<td>имя:</td>
	<td><input type="text" <?=$read_only_state;?> name="user_name" value="<?php echo $res[name];?>"></td>
	</tr>
	<tr>
	<td>логин:</td>
	<td><input type="text" <?=$read_only_state;?> name="user_login" value="<?php echo $res[login];?>"></td>
	</tr>
	<tr>
	<td>пароль:</td>
	<td><input type="<?=$see_pass?>" <?=$read_only_state;?> name="user_password"  value="<?php echo $res[pass];?>"></td>
	</tr>	
	
	<tr>
	<td>email:</td>
	<td><input type="text" <?=$read_only_state;?> name="user_email" value="<?php echo $res[email];?>"></td>
	</tr>
	
	</table>

<br><br>
<button  type="submit" <?=$hidden_change?> name="change_btn">Изменить данные</button>
	<div id="save_cancel_edit" <?=$hidden_two?>>
	<button  type="submit" name="save_changes_btn">Сохранить изменения</button>
	 
	<br><br>
	<button  type="submit" name="cancel_changes_btn">Отмена</button>
</div>
</form>



<?php

if (isset($_POST["save_changes_btn"]))
{
	$q = "UPDATE users 
	SET login='".$_POST["user_login"]."', 
	pass='".$_POST["user_password"]."', 
	name='".$_POST["user_name"]."', 
	email='".$_POST["user_email"]."' WHERE id =".$_SESSION['user_id'];
	$query = mysqli_query($mysqli, $q);
	
	header("refresh:0");
}



?>

<h2>История заказов</h2>

<?php
if (isset($_POST['hide_btn'])){
	$order_id = $_POST['hide_btn'];
	$update_query = mysqli_query($mysqli, "UPDATE orders SET hide=1 WHERE id = $order_id");
	header("Refresh:0");	
}


?>

<form method="POST">
<?php

	$user_id = $_SESSION["user_id"];

	$query="SELECT * FROM orders WHERE user_id='$user_id' AND state_id='2'";
	$mysqliquery = mysqli_query($mysqli, $query); 
	$print_cnt = 1;
	//echo "<table>";
	while($res=mysqli_fetch_array($mysqliquery))
	{
		if($res[hide] == '0')
		{
			$order_id = $res[id];
			echo "<br>Заказ №", $print_cnt, "<br>";
			$print_cnt+=1;
			$q1 = mysqli_query($mysqli, "SELECT * FROM buskets WHERE order_id = $order_id");
		
			$item_cnt = 0;
			$price_cnt = 0;
			
			while($res1=mysqli_fetch_array($q1))
			{

				$item_id = $res1[item_id];
				$q2 = mysqli_query($mysqli, "SELECT * FROM items WHERE id = $item_id");
				while($res2 = mysqli_fetch_array($q2))
				{

					echo $res2[name], ": ", $res1[cnt], " шт. <br>\tЦена: от ",  $res2[price]*$res1[cnt], "<br>";
					$item_cnt+=$res1[cnt];
					$price_cnt+=$res2[price]*$res1[cnt];

				}
						
			}
			echo "<br>ИТОГО: ", $price_cnt, "<br>";
			echo "<br><button type='submit' name='hide_btn' value='$order_id'>Скрыть заказ</button><br><br>";
		}
	}
	// echo "</table>";

?>
</form>

</div>
</div>
</div>