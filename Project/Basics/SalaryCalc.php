<?php

$name="";
$gender="";
$mar="";
$dept="";
$bs=0;
$ta=0;
$da=0;
$hra=0;
$lic=0;
$pf=0;
$ded=0;
$net=0;



if(isset($_POST["btn_sub"]))
{
	$fname=$_POST["txt_fn"];
	$lname=$_POST["txt_ln"];
	$gender=$_POST["rad_gen"];
	$mar=$_POST["rad_mar"];
	$dept=$_POST["sl_dep"];
	$bs=$_POST["txt_bs"];


if(($gender=="female")&&($mar=="single"))
{
	$name="Miss ".$fname." ".$lname;
}

if(($gender=="female")&&($mar=="married"))
{
	$name="M.s ".$fname." ".$lname;
}

if(($gender=="male")&&($mar=="single"))
{
	$name="Master ".$fname." ".$lname;
}

if(($gender=="male")&&($mar=="married"))
{
	$name="Mr ".$fname." ".$lname;
}

if($bs>=10000)
{
	$ta=((($bs)/100)*40);
	$da=((($bs)/100)*35);
	$hra=((($bs)/100)*30);
	$lic=((($bs)/100)*25);
	$pf=((($bs)/100)*20);
}


if(($bs>=5000)&&($bs<10000))
{
	$ta=((($bs)/100)*35);
	$da=((($bs)/100)*30);
	$hra=((($bs)/100)*25);
	$lic=((($bs)/100)*20);
	$pf=((($bs)/100)*15);
}


if($bs<5000)
{
	$ta=((($bs)/100)*30);
	$da=((($bs)/100)*25);
	$hra=((($bs)/100)*20);
	$lic=((($bs)/100)*15);
	$pf=((($bs)/100)*10);
}

$ded=$lic+$pf;
$net=$bs+$ta+$da+$hra-($lic+$pf);
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
  <table width="600" border="1" height="500">
    <tr>
      <td width="291">First name</td>
      <td width="293"><label for="txt_fn"></label>
      <input type="text" name="txt_fn" id="txt_fn" /></td>
    </tr>
    <tr>
      <td>Last name</td>
      <td><label for="txt_ln"></label>
      <input type="text" name="txt_ln" id="txt_ln" /></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><input type="radio" name="rad_gen" id="rad_gen" value="male" />
      <label for="rad_gen">Male
        <input type="radio" name="rad_gen" id="rad_gen" value="female" />
      Female</label></td>
    </tr>
    <tr>
      <td>Marital</td>
      <td><input type="radio" name="rad_mar" id="rad_mar" value="single" />
        Single
          <input type="radio" name="rad_mar" id="rad_mar" value="married" />
        <label for="rad_mar2">Married</label></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><label for="sl_dep"></label>
        <select name="sl_dep" id="sl_dep">
         <option value="computer science">computer science</option>
          <option value="Bachelor of Computer Application">Bachelor of Computer Application</option>
           <option value="Bachelor of Business Administraton">Bachelor of Business Administraton</option>
           	<option value="BA Visual Arts">BA Visual Arts</option>
             <option value="Bachelor of Architecture">Bachelor of Architecture</option>
      </select></td>
    </tr>
    <tr>
      <td>Basic salary</td>
      <td><label for="txt_bs"></label>
      <input type="text" name="txt_bs" id="txt_bs" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_sub" id="btn_sub" value="Submit" />
      <input type="submit" name="btn_cl" id="btn_cl" value="Cancel" /></td>
    </tr>
  </table><br><br><br><br>
  <table width="600" border="1" height="500">
    <tr>
      <td width="293">Name</td>
      <td width="291"><?php echo $name;
	  ?></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><?php echo $gender;
	  ?></td>
    </tr>
    <tr>
      <td>Marital</td>
      <td><?php echo $mar;
	  ?></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><?php echo $dept;
	  ?></td>
    </tr>
    <tr>
      <td>Basic salary</td>
      <td><?php echo $bs;
	  ?></td>
    </tr>
    <tr>
      <td>T.A</td>
      <td><?php echo $ta;
	  ?></td>
    </tr>
    <tr>
      <td>D.A</td>
      <td><?php echo $da;
	  ?></td>
    </tr>
    <tr>
      <td>HRA</td>
      <td><?php echo $hra;
	  ?></td>
    </tr>
    <tr>
      <td>LIC</td>
      <td><?php echo $lic;
	  ?></td>
    </tr>
    <tr>
      <td>P.F</td>
      <td><?php echo $pf;
	  ?></td>
    </tr>
    <tr>
      <td>DEDUCTION</td>
      <td><?php echo $ded;
	  ?></td>
    </tr>
    <tr>
      <td>NET</td>
      <td><?php echo $net;
	  ?></td>
    </tr>
  </table>
</form>
</body>
</html>