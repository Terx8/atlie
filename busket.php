<div class="pretty_form" style= "width:50%;">
	<form method="POST">
<?php

	$user_id = $_SESSION["user_id"];

	$query="SELECT * FROM orders WHERE user_id='$user_id' AND state_id='1'";
	$mysqliquery = mysqli_query($mysqli, $query); 

	$res=mysqli_fetch_array($mysqliquery);
	$order_id=$res[id];

	if (empty($order_id))
	{
		echo "<h2>Корзина пуста!</h2>";
	}
	else
	{
	
	$q1 = mysqli_query($mysqli, "SELECT * FROM buskets WHERE order_id = $order_id");
	
	$item_cnt = 0;
	$price_cnt = 0;
		echo "<table>";
	while($res1=mysqli_fetch_array($q1))
	{
		$item_id = $res1[item_id];
		$q2 = mysqli_query($mysqli, "SELECT * FROM items WHERE id = $item_id");
		while($res2 = mysqli_fetch_array($q2))
		{
		echo "<tr>";
		echo "<td>"; 
		echo "<img src= ' ".$res2[picture]." ' width='200' height='200' style='display: block; margin-left: auto; margin-right: auto;'/>";
		echo "</td>";
				
		echo "<td>"; 


		echo $res2[name], ": от ", $res2[price], " за штуку<br>Количество: ", $res1[cnt], "<br>Итого: от ",  $res2[price]*$res1[cnt];
		$item_cnt+=$res1[cnt];
		$price_cnt+=$res2[price]*$res1[cnt];
		if ($_SESSION['user_id'] != "-1")
		{
			echo "<br><button type='submit' name='del_one' value='$res2[id]'>Удалить единицу из заказа</button>";
			echo "<br><button type='submit' name='del_all' value='$res2[id]'>Удалить все такие товары </button>";
		}				


		echo "</td>";
		echo "</tr>";
		}
		
	}
	
	echo "</table>";
	if ($item_cnt > 0)
	{
		echo "<br>Сумма: ", $price_cnt;
		echo "<br><button type='submit' name='order_all'>Завершить заказ</button>";
		
	}
	}


?>

</form>

	
	<?php
if (isset($_POST['order_all']))
{
	$update_query = mysqli_query($mysqli, "UPDATE orders SET state_id=2 WHERE id = $order_id");
	header("Refresh:0");	
}
	
if (isset($_POST['del_one']))
{
	$item_id = $_POST['del_one'];
	$check_query =  mysqli_query($mysqli, "SELECT * FROM buskets WHERE item_id = $item_id and order_id = $order_id");
	$check_res=mysqli_fetch_array($check_query);
	if ($check_res[cnt] > 1)
	{
		$cnt = $check_res[cnt];
		$cnt -= 1;
		$update_query = mysqli_query($mysqli, "UPDATE buskets SET cnt=$cnt WHERE item_id = $item_id and order_id = $order_id");	
		header("Refresh:0");
	}
	else
	{
		$query="DELETE FROM buskets WHERE item_id = $item_id and order_id = $order_id";
		$mysqliquery = mysqli_query($mysqli, $query);
		header("Refresh:0");
	}
	
}

if (isset($_POST['del_all']))
{
	$item_id = $_POST['del_all'];
	$query="DELETE FROM buskets WHERE item_id = $item_id and order_id = $order_id";
	$mysqliquery = mysqli_query($mysqli, $query);
	header("Refresh:0");
}

?>

</div>