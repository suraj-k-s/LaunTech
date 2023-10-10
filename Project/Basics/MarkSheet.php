<?php
$total="";
$n01="";
$n02="";
$n03="";
$percent="";
$grade="";
$gender="";
$dept="";
$name="";
if(isset($_POST["btn_submit"]))
{
		$fname=$_POST["txt_no1"];
		$lname=$_POST["txt_no2"];
		$gender=$_POST["rdo_gndr"];
		$dept=$_POST["sl_dep"];
		$n01=$_POST["txt_no3"];
		$n02=$_POST["txt_no4"];
		$n03=$_POST["txt_no5"];
if($gender=="female")
{
	$name="Miss ".$fname." ".$lname;
}
if($gender=="male")
{
	$name="Mr ".$fname." ".$lname;
}
	$total=$n01+$n02+$n03;

	$percent=((($n01+$n02+$n03)/300)*100)."%";


if($percent>=90)
{
	$grade="A+";
}
else if($percent>=80)
{
	$grade="A";
}
else if($percent>=70)
{
	$grade="B+";
}
else
{ 
 	$grade="B";
}
}



?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="500" border="1" height="500">
    <tr>
      <td width="195">First name</td>
      <td width="289"><label for="txt_no1"></label>
      <input type="text" name="txt_no1" id="txt_no1" /></td>
    </tr>
    <tr>
      <td>Last name</td>
      <td><label for="txt_no2"></label>
      <input type="text" name="txt_no2" id="txt_no2" /></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><input type="radio" name="rdo_gndr" id="rdo_gndr" value="male" />
        Male
          <label for="rdo_gndr">
          <input type="radio" name="rdo_gndr" id="rdo_gndr" value="female" />
   Female
   </label>
   </td>
    </tr>
    <tr>
      <td>Department</td>
      <td><label for="sl_dep"></label>
        <select name="sl_dep" id="sl_dep" >
        <option value="CS">computer science</option>
        <option value="bca">bca</option>
        <option value="bba">bba</option>
      </select></td>
    </tr>
    <tr>
      <td>Mark 1</td>
      <td><label for="txt_no3"></label>
      <input type="text" name="txt_no3" id="txt_no3" /></td>
    </tr>
    <tr>
      <td>Mark 2</td>
      <td><label for="txt_no4"></label>
      <input type="text" name="txt_no4" id="txt_no4" /></td>
    </tr>
    <tr>
      <td>Mark 3</td>
      <td><label for="txt_no5"></label>
      <input type="text" name="txt_no5" id="txt_no5" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="btn_can" id="btn_can" value="cancel" /></td>
    </tr>
  </table>
  <table width="500" border="1" height="500">
    <tr>
      <td width="209">Name</td>
      <td width="275"><?php echo $name;
	  ?></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><?php echo $gender;
	  ?></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><?php echo $dept;
	  ?></td>
    </tr>
    <tr>
      <td>Total Marks</td>
      <td><?php echo $total;
	  ?></td>
    </tr>
    <tr>
      <td>Percentage</td>
      <td><?php echo $percent;
	  ?></td>
    </tr>
    <tr>
      <td>Grade</td>
      <td><?php echo $grade;
	  ?></td>
    </tr>
     <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>