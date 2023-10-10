<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include('Head.php');


if(isset($_POST["btn_save"]))
{
	
    $insqry="insert into tbl_subcategory(subcategory_name,category_id,subcategory_price)
	values('".$_POST["txt_subcategory"]."','".$_POST["sl_category"]."','".$_POST["txt_subcategoryprice"]."')";
	$con->query($insqry);
}



if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$delqry="delete from tbl_subcategory where subcategory_id='$id'";
	$con->query($delqry);
	header("location:subcategory.php");
	}

?>









<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LaunTech::Admin::Subcategory </title>
</head>

<body>
<a href="Homepage.php">Home</a>
<form id="form1" name="form1" method="post" action="">
  <table width="500" border="1" height="200">
    <tr>
      <td width="237">Category</td>
      <td width="247"><label for="sl_category"></label>
  

      <select name="sl_category" id="sl_category">
      <option>--Select--</option>
      		<?php
            					$selqry = "select * from tbl_category";
								$result = $con->query($selqry);
								while($data = $result->fetch_assoc())
									{
			?>
           						<option value="<?php echo $data["category_id"];?>">
								<?php echo $data["category_name"];?></option>
                                
                                <?php
								
									}
							    ?>
      </select></td>
    </tr>
     
      
    <tr>
      <td>Sub Category</td>
      <td><label for="txt_sc"></label>
      <input type="text" name="txt_subcategory" id="txt_subcategory" /></td>
    </tr>
    <td>Sub Category Price</td>
      <td><label for="txt_sc"></label>
      <input type="text" name="txt_subcategoryprice" id="txt_subcategoryprice" /></td>
    </tr>
    <tr>
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
      <td width="190">Category</td>
      <td width="190">Sub Category</td>
      <td width="190">Sub Category Price</td>
      <td width="150">Action</td>
    </tr>
    <?php
	$selqry = "select * from tbl_subcategory p inner join tbl_category d on p.category_id=d.category_id";
	$i=0;
	$result = $con->query($selqry);
	while($data = $result->fetch_assoc())
	{
		$i++;
		?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $data["category_name"];?></td>
            <td><?php echo $data["subcategory_name"];?></td>
             <td><?php echo $data["subcategory_price"];?></td>
			<td><a href="Subcategory.php?id=<?php echo $data["subcategory_id"];?>">Delete</a></td>
	</tr>
    <?php
    }
	?>
  </table>
  <?php
						include('Foot.php');
						ob_flush();
						?>