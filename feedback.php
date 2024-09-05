
<div class="container" >
<div class="column center">

<form method="POST">
<?php
 if ($_SESSION['user_id'] != "-1" and $_SESSION['user_id'] != "0")
 {
	$q = "SELECT * FROM users WHERE id = ".$_SESSION['user_id'];

	$query = mysqli_query($mysqli, $q);
	if (!empty($query))
	{
		$res=mysqli_fetch_array($query);
		$uname = $res[name];
	}
 }
?>
<div class="pretty_form">
<h2>Оставьте отзыв</h2>
<table >
	<tr>
	<tr>
	<td>Имя:</td>
	<td><input type="text" name="l_name" value="<?php echo $uname;?>"></td>
	</tr>	

	
	<tr>
	<td>Сообщение:</td>
	<td><textarea name="l_text" rows="4"></textarea></td>
	</tr>
	<tr >
	<td colspan='2' style="text-align:center;">
	<br>
<button  type="submit" name="send_btn">Отправить</button>
	</td>
	</tr>
	</table>
<br>
	

<?php

if (isset($_POST["send_btn"]))
{
	if(!empty($_POST["l_name"]) and !empty($_POST["l_text"]))
	{
		$subject=date('d.m.Y');
		$phrase = $_POST["l_name"]." (".$subject.") написал(а): ".$_POST["l_text"];
	}
	if ($phrase !=""){
	$query = "INSERT INTO feedback (text) VALUES ('$phrase')";
	$mysqliquery = mysqli_query($mysqli, $query);
	}
	$phrase = "";
	header("Refresh:0");

}



?>

</form>
</div>
</div>
</div>




