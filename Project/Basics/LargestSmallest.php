<?php
	echo"largest of 3 numbers";
		
		$Result=" ";

	$n01="";
	$n02="";
	$no3="";
	
	if(isset($_POST["btnfind"]))
	{
		$n01=$_POST["txt_no1"];
		$n02=$_POST["txt_no2"];
		$no3=$_POST["txt_no3"];
	
		if(($n01>$n02)&&($n01>$no3))
		{
	
				$Result=$n01;
		}
		if(($n02>$n01)&&($n02>$no3))
	
		{
		$Result=$n02;
		}
		if(($n03>$n02)&&($no3>$no1))
	
		{
		$Result=$n03;

		}
	
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>largest</title>
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
      <td>Number 3</td>
      <td><label for="txt_no3"></label>
      <input type="text" name="txt_no3" id="txt_no3" value="<?php echo $n03?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btnFind" id="btnFind" value="Submit" />
</td>
    </tr>
    <tr>
      <td><p>Largest</p></td>
      <td><?php
      echo $Result;
	  ?></td>
    </tr>
  </table>
</form>
</body>
</html>