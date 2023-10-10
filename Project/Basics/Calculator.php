<?php
	echo"Arithmatic Calculator";
		
		$Result=" ";

$n01="";
$n02="";
	if(isset($_POST["btn_add"]))
	{
		$n01=$_POST["txt_no1"];
		$n02=$_POST["txt_no2"];
	
	$Result=$n01+$n02;

	}



if(isset($_POST["btn_sub"]))
	{
		$n01=$_POST["txt_no1"];
		$n02=$_POST["txt_no2"];
	
	$Result=$n01-$n02;

	}
	
	
	if(isset($_POST["btn_mul"]))
	{
		$n01=$_POST["txt_no1"];
		$n02=$_POST["txt_no2"];
	
	$Result=$n01*$n02;

	}
	
	
	if(isset($_POST["btn_div"]))
	{
		$n01=$_POST["txt_no1"];
		$n02=$_POST["txt_no2"];
	
	$Result=$n01/$n02;

	}
?>










<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calculator</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="328" height="163" border="1">
    <tr>
      <td>Number 1</td>
      <td><label for="txt_no1"></label>
      <input type="text" name="txt_no1" id="txt_no1" value="<?php echo $n01?>" /></td>
    </tr>
    <tr>
      <td>Number 2</td>
      <td><label for="txt_no2"></label>
      <input type="text" name="txt_no2" id="txt_no2" value="<?php echo $n02?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_add" id="btn_add" value="Add" />
      <input type="submit" name="btn_sub" id="btn_sub" value="Sub" />
      <input type="submit" name="btn_mul" id="btn_mul" value="mul" />
      <input type="submit" name="btn_div" id="btn_div" value="div" /></td>
    </tr>
    <tr>
      <td><p>Result</p></td>
      <td><?php
      echo $Result;
	  ?></td>
    </tr>
  </table>
</form>
</body>
</html>