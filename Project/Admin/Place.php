<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include('Head.php');
if(isset($_POST["btn_save"]))
{
	
    $insqry="insert into tbl_place(place_name,district_id)
	values('".$_POST["txt_place"]."','".$_POST["sl_dis"]."')";
	$con->query($insqry);
}



if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$delqry="delete from tbl_place where place_id='$id'";
	$con->query($delqry);
	header("location:Place.php");
	}

?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
LaunTech::Admin::Place</title>
</head>

<body>
<a href="Homepage.php">Home</a>
<form id="form1" name="form1" method="post" action="">
  <table width="500" border="1" height="200">
    <tr>
      <td width="233">District</td>
      <td width="251"><label for="sl_dis"></label>
      
      
      <select name="sl_dis" id="sl_dis">
      <option>--Select--</option>
      		<?php
            					$selqry = "select * from tbl_district";
								$result = $con->query($selqry);
								while($data = $result->fetch_assoc())
									{
			?>
           						<option value="<?php echo $data["district_id"];?>"><?php echo $data["district_name"];?></option>
                                
                                <?php
								
									}
							    ?>
      </select>
      
      
      
      
      
      </td>
    </tr>
    <tr>
      <td>Place Name</td>
      <td><label for="txt_pn"></label>
      <input type="text" name="txt_place" id="txt_place" /></td>
    </tr>
      <td colspan="2" align="center"><input type="submit" name="btn_save" id="btn_save" value="Save" />
      <input type="submit" name="btn_cnl" id="btn_cnl" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
</html>



  <table width="500" border="1">
    <tr>
      <td width="138" height="47">Sl.No</td>
      <td width="190">District</td>
      <td width="190">PlaceName</td>
      <td width="190">Pincode</td>
      <td width="150">Action</td>
    </tr>
    <?php
	$selqry = "select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
	$i=0;
	$result = $con->query($selqry);
	while($data = $result->fetch_assoc())
	{
		$i++;
		?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $data["district_name"];?></td>
            <td><?php echo $data["place_name"];?></td>
			<td><a href="Place.php?id=<?php echo $data["place_id"];?>">Delete</a></td>
	</tr>
    <?php
    }
	?>
  </table>
  <?php
						include('Foot.php');
						ob_flush();
						?>