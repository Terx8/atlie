
<div class="pretty_form">
<h2>Изменить тип</h2>

<form method="POST">
<?php

$q = "SELECT * FROM types WHERE id = ".$_SESSION['edit_cat'];

$query = mysqli_query($mysqli, $q);
if (!empty($query))
{
	$res = mysqli_fetch_array($query);
}
$catname = $res['name'];

?>

<table style = "margin: auto; text-align: center;">

	<td>Название:</td>
	<td><input type="text" name="cat_name" value="<?php echo $catname;?>"></td>
	</tr>

	
	</table>

<br><br>

	<button type="submit" name="save_changes_btn_">Сохранить изменения</button>
	 
	<br><br>
	<button  type="submit" name="cancel_changes_btn_">Отмена</button>

</form>



<?php

if (isset($_POST["save_changes_btn_"]))
{
	#echo $_POST["cat_name"];
	$q = "UPDATE types 
	SET name='".$_POST["cat_name"]."'  
	WHERE id =".$_SESSION['edit_cat'];
	$query = mysqli_query($mysqli, $q);
	#echo $q;
	$_SESSION['edit_cat'] = "-1";
	$_SESSION['navig'] = "edit_table.php";
	header("refresh:0");
}
if (isset($_POST["cancel_changes_btn_"]))
{
	$_SESSION['navig'] = "edit_table.php";
	$_SESSION['edit_cat'] = "-1";
	header("refresh:0");
}



?>

</div>