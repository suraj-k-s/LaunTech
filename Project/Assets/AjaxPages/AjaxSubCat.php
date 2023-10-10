<?php
include("../Connection/Connection.php");
$selSubcat="select * from tbl_subcategory where category_id=".$_GET['pid'];
$resSub=$con->query($selSubcat);
?>
<option value="">Select</option>
<?php
while($row=$resSub->fetch_assoc())
{
	?>
	<option value="<?php echo $row['subcategory_id'] ?>" data-subcategory-price="<?php echo $row['subcategory_price'] ?>"><?php echo $row['subcategory_name'] ?></option>
    <?php
}
?>