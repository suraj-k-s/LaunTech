<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include('Head.php');
if(isset($_POST["btn_save"]))
{
	$catgry=$_POST["txt_cat"];
	$insqry="insert into tbl_type(type_name)
	values('$catgry')";
	$con->query($insqry);
}
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$delqry="delete from tbl_type where type_id='$id'";
	$con->query($delqry);
	header("location:Type.php");
	}

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LaunTech::Admin::Type</title>
</head>

<body>
<a href="Homepage.php">Home</a>
<form id="form1" name="form1" method="post" action="">
  <table width="500" border="1" height="100">
    <tr>
      <td width="234">Type Name</td>
      <td width="250"><label for="txt_cat"></label>
      <input type="text" name="txt_cat" id="txt_cat" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_save" id="btn_save" value="Save" />
      <input type="submit" name="btn_cnl" id="btn_cnl" value="Cancel" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<table width="500" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Type</td>
    <td>Action</td>
  </tr>
  <?php
	$selqry = "select * from tbl_type";
	$i=0;
	$result = $con->query($selqry);
	while($data = $result->fetch_assoc())
	{
		$i++;
		?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $data["type_name"];?></td>
			<td><a href="Type.php?id=<?php echo $data["type_id"];?>">Delete</a></td>
	</tr>
    <?php
    }
	?>
 
</table>
</body>
<?php
						include('Foot.php');
						ob_flush();
						?>
</html>