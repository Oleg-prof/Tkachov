<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN">
<html>
<head>
<title>������ ������� ���������� ���������������� �����������.</title>
<meta http-equiv="content-type" content="text/html; charset=Windows-1251" />
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="vs_targetSchema" content="http://schemas.microsoft.com/intellisense/ie5">
</head>
<body>
	<table align="center" height="80%" width="80%">
		<tr>
			<td  class="top_left"><img class="logo" src="image/logo.png" alt="���" /><img class="logo2" src="image/logo1.png" alt="LOGO" /></td>
			<td  class="top_right" colspan="3">������ ������� ������� ���������� ���������������� �����������.</td>
			<td></td>
		</tr>
		<tr>
			<td class="center"><a class="button" href="index.html"shape="rect">�������</a></td>
			<td class="center"><a class="button" href="desc.html"shape="rect">��������</a></td>
			<td class="center"><a class="button" href="calc.html"shape="rect">������</a></td>
			<td class="center"><a class="button" href="addit.html"shape="rect">����</a></td>		
		</tr>
		<tr>
			<td colspan="4" class="buttom">
			<font class="zagl">������ ��������.</font>

<?php
$log=fopen("log_up.txt","w");
$filename='upot.txt';//��� ��� ����� ������.

//������ ��� log_up.
$z='upload.php ��������.';
$z1='������ � ����� Potencial.txt �������.';
$z2='������ � ����� Initial.txt �������.';
$z3='������ � ����� f_temp.txt �������.';
$z4='������ � ����� table.txt �������.';

//������ ������.
$err_1='������ ��������, ������ ����� Potencial.txt.';
$err_2='������ ��������, ������ ����� Initial.txt.';
$err_3='������ ��������, ������ ����� f_temp.txt.';
$err_4='������ ��������, ������ ����� table.txt.txt.';

fprintf($log,"%s\n",$z);

//����������.
	$nop=(float)$_POST["nop"];//����� �����.
	$sec=(float)$_POST["sec"];//������ �����������.
	$w_m=(float)$_POST["w_m"];//������ �������.
	$h_m=(float)$_POST["h_m"];//������ �������.
	$wid=(float)$_POST["width"];//������ ������.
	$nol=(float)$_POST["nol"];//����� ������� ��� �������.
	$mass=(float)$_POST["mass"];//����� �������.
	
//�������� ������.
$pot=fopen("Potencial.txt","w");//���� ��� ��������� ������.
$fini=fopen("Initial.txt","w");//���� ��� ��������� ���������.
$ftemp=fopen("f_temp.txt","w");//���� ��� ��������� ������.
$table=fopen("table.txt","w");//���� ��� ���������� �������.

//������ ��� ��������� ������.
if($pot)
	{fprintf($pot,"%d\n",$nop);//����� �����.
	fprintf($pot,"%f\n",$sec);//������ �����������.
	fprintf($pot,"%f\n",$w_m);//������ �������.
	fprintf($pot,"%f\n",$h_m);//������ �������.
	fprintf($pot,"%f\n",$wid);//������ ������.
	fprintf($log,"%s\n",$z1);}//������ � log.
else
	{echo("������ �������� ����� Potencial.txt");
	fprintf($log,"%s\n",$err_1);//������ � log.
	fclose($pot);//�������� ����� ��������� ������.
	exit;}
fclose($pot);//�������� ����� ��������� ������.

//������ ��������� ��������� ������.
exec("Potencial_Energy.exe",$output);
		
//������ ��� ��������� ���������.
if($fini)
	{fprintf($fini,"%s\n",$filename);//������ ����� ����� ������.
	fprintf($fini,"%f\n",$mass);//����� �������.
	fprintf($fini,"%f\n",$wid);//������ ������.
	fprintf($log,"%s\n",$z2);}//������ � log.
else
	{echo("������ �������� ����� Initial.txt");
	fprintf($log,"%s\n",$err_2);//������ � log.
	fclose($fini);//�������� ����� ��� ��������� ���������.
	exit;}
fclose($fini);//�������� ����� ��� ��������� ���������.
   
//������ ��� ��������� ��������� ������.
if($ftemp){
	fprintf($ftemp,"%d\n",$nol);//����� �������.
	fprintf($ftemp,"%s\n",$filename);//��� ��� ����� ������.
	fprintf($ftemp,"%f\n",$wid);//������ ������.
	fprintf($log,"%s\n",$z3);}//������ � log.
else
	{echo("������ �������� ����� f_temp.txt");
	fprintf($log,"%s\n",$err_3);//������ � log.
	fclose($fini);//�������� ����� ��� ��������� ��������� ������.
	exit;}
fclose($ftemp);//�������� ����� ��� ��������� ��������� ������.

//������ ��������� ������� �������.
exec("Third.exe",$output);


//������ ��� ��������� �������.
if($table){
	fprintf($table,"%s\n",$nol);
	fprintf($log,"%s\n",$z4);}//������ � log.
else
	{echo("������ �������� ����� table.txt");
	fprintf($log,"%s\n",$err_4);//������ � log.
	fclose($table);//�������� ����� ��������� �������.
	exit;}
fclose($table);//�������� ����� ��������� �������.

?>

<p>
<img src="draw.php" alt="������" width="1000" height="1000" align="middle" />
</p>

			</td>
		</tr>
	</table>
</body>
</html>	