<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include('Head.php');
if(isset($_POST["btn_save"]))
{
	$disname=$_POST["txt_dist"];
	$insqry="insert into tbl_district(district_name)
	values('$disname')";
	$con->query($insqry);
}
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$delqry="delete from tbl_district where district_id='$id'";
	$con->query($delqry);
	header("location:district.php");
	}

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LaunTech::Admin::District</title>
</head>

<body>
<a href="Homepage.php">Home</a>
<form id="form1" name="form1" method="post" action="">
  <table width="500" border="1" height="100">
    <tr>
      <td width="235">District Name</td>
      <td width="249"><label for="txt_dist"></label>
      <input type="text" name="txt_dist" id="txt_dist" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_save" id="btn_save" value="Save" />
      <input type="submit" name="btn_cnl" id="btn_cnl" value="Cancel" /></td>
    </tr>
  </table>
  <table width="500" border="1">
    <tr>
      <td width="138" height="47">Sl.No</td>
      <td width="190">District</td>
      <td width="150">Action</td>
    </tr>
    <?php
	$selqry = "select * from tbl_district";
	$i=0;
	$result = $con->query($selqry);
	while($data = $result->fetch_assoc())
	{
		$i++;
		?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $data["district_name"];?></td>
			<td><a href="District.php?id=<?php echo $data["district_id"];?>">Delete</a></td>
	</tr>
    <?php
    }
	?>
  </table>
</form>
</body>
<?php
						include('Foot.php');
						ob_flush();
						?>
</html>