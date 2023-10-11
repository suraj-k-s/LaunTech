<?php
session_start();
//submit_rating.php
include("../Connection/Connection.php");

if(isset($_POST["rating_data"]))
{

	$ins = "INSERT INTO tbl_review(user_id,review_count,review_details,review_date,branch_id)VALUES('".$_SESSION["uid"]."','".$_POST["rating_data"]."','".$_POST["user_review"]."',NOW(),'".$_POST["branch_id"]."')";
	
	if($con->query($ins))
{
	echo "Your Review & Rating Successfully Submitted";
}
else
{
	echo "Your Review & Rating Insertion Failed";
}

}
?>