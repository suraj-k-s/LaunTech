<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include('Head.php');


?> 









<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SearchBranch</title>
</head>
<style>
.main-div {
	    display: flex;
		gap: 2rem;
		flex-wrap: wrap;
		justify-content: center;
		align-items: center;
}
.card {
	    background-color: #e9e9e9;
		width: 220px;
		padding: 18px;
		border-radius: 10px;
	}
.space-gap {
	padding:10px;
}
</style>
<body>
<form id="form1" name="form1" method="post" action="">
<table align="center">
<tr>
<td>District</td>
<td><select name="sl_district" id="sl_district" onChange="getplace(this.value)">
          <option value="">--Select--</option>
            <?php
		$selQry="select * from tbl_district";
		$result=$con->query($selQry);
		while($row=$result->fetch_assoc())
		{
		?>
        <option value="<?php echo $row['district_id']  ?>"> <?php echo $row['district_name']  ?></option>
        <?php
		}
		?>

      </select></td>
      <td><input name="btn_search" type="submit" value="search"/></td>
</tr>
</table>
 
      
      <div class="main-div">
      <?php
	  if (isset($_POST['btn_search']))
	  {
		$sel="select * from tbl_branch b inner join tbl_place p on b.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where TRUE ";
		if($_POST['sl_district']!="")
		{
			$sel.=" and d.district_id=".$_POST["sl_district"];
		}
		$result=$con->query($sel);
		if($result->num_rows>0)
		{
			while($data=$result->fetch_assoc())
		{
			?>
			<div class="card">
            <div class="space-gap"><img src="../Assets/Files/Branch/<?php echo $data["branch_photo"];?>" width="150" height="150" /></div>
            <div class="space-gap">Name :<?php echo $data["branch_name"]; ?></div>
            <div class="space-gap"><a href="UserBranchProfile.php?bid=<?php echo $data["branch_id"]?>">View More</a></div>
            <div class="space-gap"><a href="Booking.php?bid=<?php echo $data['branch_id'] ?>">Book Now</a></div>
            </div>
			<?php
		}
		}
		else
		{
			?>
			<h2 style="color:red">No Branch</h2>
			<?php
		}
	  }
	  ?>
      </div>

</form>
</body>
<?php
include('Foot.php');
ob_flush();
?>
</html>