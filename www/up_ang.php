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
			<td colspan="3" class="buttom">
			<font class="zagl">������ ��������.</font>

<?php
$log=fopen("log_up.txt","w");
$filename='upot.txt';//��� ��� ����� ������.

//������ ��� log_up.
$z='up_ang.php ��������.';
$z1='������ � ���� Ang_pot.txt ����������� �������.';
$z2='������ � ���� Initial.txt ����������� �������.';
$z3='������ � ���� f_temp.txt ����������� �������';
$z4='������ � ���� table.txt ����������� �������';

//������ ������.
$err_1='������ ��������, ������ ����� Ang_pot.txt.';
$err_2='������ ��������, ������ ����� Initial.txt.';
$err_3='������ ��������, ������ ����� f_temp.txt.';
$err_4='������ ��������, ������ ����� table.txt.txt.';

fprintf($log,"%s\n",$z);

//����������.
	$nop=(float)$_POST["nop"];//����� �����.
	$k2=(float)$_POST["k2"];//������ �����������.
	$k3=(float)$_POST["k3"];//������ �����������.
	$k4=(float)$_POST["k4"];//��������� �����������.
	$wid=(float)$_POST["width"];//������ ������.
	$nol=(float)$_POST["nol"];//����� ������� ��� �������.
	$mass=(float)$_POST["mass"];//����� �������.
	
//�������� ������.
$pot=fopen("Ang_pot.txt","w");//���� ��� ��������� ������.
$fini=fopen("Initial.txt","w");//���� ��� ��������� ���������.
$ftemp=fopen("f_temp.txt","w");//���� ��� ��������� ������.
$table=fopen("table.txt","w");//���� ��� ���������� �������.

//������ ��� ��������� ������.
if($pot)
	{fprintf($pot,"%d\n",$nop);//����� �����.
	fprintf($pot,"%f\n",$k2);//������ �����������.
	fprintf($pot,"%f\n",$k3);//������ �����������.
	fprintf($pot,"%f\n",$k4);//��������� �����������..
	fprintf($pot,"%f\n",$wid);//������ ������.
	fprintf($log,"%s\n",$z1);}//������ � log.
else
	{echo("������ �������� ����� Ang_pot.txt");
	fprintf($log,"%s\n",$err_1);//������ � log.
	fclose($pot);//�������� ����� ��������� ������.
	exit;}
fclose($pot);//�������� ����� ��������� ������.

//������ ��������� ��������� ������.
exec("Ang_Energy.exe",$output);
		
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
<img src="draw.php" alt="������" width="800" height="800" align="middle" />
</p>

			</td>
			<td class="buttom">
			
<?php
$table_lev=fopen("table_lev.txt","r");//���� ��� ���������� �������.
if($table_lev)
	{ fprintf($log,"%s\n","���� table_lev.txt ������");//������ � log.
	}
else
	{echo("������ �������� ����� table_lev.txt");
	fprintf($log,"%s\n",$err_1);//������ � log.
	fclose($table_lev);
	exit;}
	
$nolf=fopen('table.txt', "r");
$siz1=filesize("table.txt");
$nol= fread($nolf, $siz1);

for($i=0; $i<$nol; $i++)
	{fscanf($table_lev,"%f",&$el[$i]);}


echo("<table BORDER=2 BGCOLOR=grey align=center color=white>");
for($i=0; $i<$nol; $i++)
	{
	echo("<tr>");
	$k=$i+1;
	echo("<td align=left> $k </td>");
	echo("<td align=right> $el[$i] </td>");
	echo("</tr>");
	}
echo("</table>");

fclose($table_lev);
fclose($nolf);//�������� ����� ��������� �������.
?>
			
			</td>
		</tr>
	</table>
</body>
</html>	