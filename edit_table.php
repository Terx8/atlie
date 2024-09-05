<div class="pretty_form">
<?php
if (isset($_POST['add_new_cat']))
{
	$new_cat_name = $_POST['new_cat'];
	if (!empty($new_cat_name))
	{
		$query = "INSERT INTO types (name) VALUES ('$new_cat_name')";
		$mysqliquery = mysqli_query($mysqli, $query);

	}				
}

if (isset($_POST['del_cat']))
{
	$del_type = $_POST['del_cat'];
	$query="DELETE FROM types WHERE id='$del_type'";
	$mysqliquery = mysqli_query($mysqli, $query);
	header("Refresh:0");	
}

if (isset($_POST['edit_cat']))
{
	$_SESSION['navig'] = "edit_type.php";
	$_SESSION['edit_cat'] = $_POST['edit_cat'];
	header("Refresh:0");	
}



?>

<form method="POST">

<?php

	$user_id = $_SESSION["user_id"];

	$query="SELECT * FROM types ";
	$mysqliquery = mysqli_query($mysqli, $query); 
	$print_cnt = 1;
	//echo "<table>";
	while($res=mysqli_fetch_array($mysqliquery))
	{
		echo $res[name], "<br>";
		$type_id = $res[id];
		echo "<button type='submit' name='del_cat' style='width:50%; height:40px;' value='$type_id'>Удалить</button>";
		echo "<button type='submit' name='edit_cat' style='width:50%; height:40px;' value='$type_id'>Изменить</button><br><br>";
	}
	// echo "</table>";

?>



Новая категория:<br><input style="width:50%; height:40px;" type="text" name="new_cat">
<button  type="submit" name="add_new_cat" style="width:40%; height:40px;">Добавить</button>
</form>
</div>
