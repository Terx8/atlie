<?php

if (isset($_POST["add_btn"]))
{
	$item_id = $_POST["add_btn"];
	$user_id = $_SESSION["user_id"];

	$q = mysqli_query($mysqli, "SELECT orders.*
	FROM orders 
	WHERE state_id = 1 and user_id = $user_id
	");
	$res=mysqli_fetch_array($q);
	if (!empty($res[id]))
	{
		$order_id=$res[id];
		$check_query =  mysqli_query($mysqli, "SELECT * FROM buskets WHERE item_id = $item_id and order_id = $order_id");
		$check_res=mysqli_fetch_array($check_query);
		if (!empty($check_res))
		{
			
			$cnt = $check_res[cnt];
			$cnt += 1;
			$update_query = mysqli_query($mysqli, "UPDATE buskets SET cnt=$cnt WHERE item_id = $item_id and order_id = $order_id");	
			header("Refresh:0");
		}
		else{
			$query="INSERT INTO buskets (order_id, item_id, cnt) VALUES ('$order_id','$item_id', '1')";
		$mysqliquery = mysqli_query($mysqli, $query); 
		}
	}
	else
	{
		$query="INSERT INTO orders (user_id, state_id, hide) VALUES('$user_id', '1', '0')";
		$mysqliquery = mysqli_query($mysqli, $query); 
		$query="SELECT id FROM orders WHERE user_id='$user_id' AND state_id='1'";
		$mysqliquery = mysqli_query($mysqli, $query); 
		$res=mysqli_fetch_array($mysqliquery);
		$order_id=$res[id];
		
		$query="INSERT INTO buskets (order_id, item_id, cnt) VALUES ('$order_id','$item_id', '1')";
		$mysqliquery = mysqli_query($mysqli, $query); 
	}


	
}



?>

<form method="POST">
<div class="whole">
	
	<div class = "main">
	<?php


$myVal = count($_POST["type"]);
if (strval($myVal) === '0')
	$to_show_all = 1;
else
	$to_show_all = 0;

?>
	<table>
<?php


	$q3 = mysqli_query($mysqli, "SELECT items.*, types.name as type_name, types.id as type_id
	FROM items 
	JOIN types ON items.type_id = types.id
	");
	while($res=mysqli_fetch_array($q3))
	{
		if ($to_show_all == 1 or in_array($res[type_id], $_POST["type"]))
		{
			echo "<tr>";
			echo "<td>"; 
			echo "<img src= ' ".$res[picture]." ' width='200' height='200' style='display: block; margin-left: auto; margin-right: auto;'/>";
			echo "</td>";
					
			echo "<td>"; 

			echo $res[name], ": от ", $res[price], "<br>";
			
			if ($_SESSION['user_id'] != "-1" and $_SESSION['user_id'] != "0")
			{
				echo "<br><button type='submit' name='add_btn' value='$res[id]'>Добавить</button>";
				
			}				


			echo "</td>";
			echo "</tr>";
		}
		
		
	}
?>
</table>

	</div>
	
	<div class="navigation">
	<div class="nav_search">
<?php
	$query3=mysqli_query($mysqli, "SELECT id, name FROM types");
	$i = 0;
	while($res3=mysqli_fetch_array($query3))
	{
		echo "<input type=\"checkbox\" name=\"type[]\" value=$res3[id] ";
		if (isset($_POST['type']) and in_array($res3[id], $_POST['type']))
		{
			echo " checked ";
		}
		echo ">".$res3[name]."<br>";
		
		$i++;		
	}
	?>
<button class="btn" type="submit" name="filter_btn">Искать</button>
<br>
<br>
<button class="btn"><a href="/index.php" style="text-decoration:none; color:black;">Очистить</a></button>

	</div>
	</div>
	
	
</div>



</form>