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


echo("<table BORDER=2 BGCOLOR=green align=center>");
for($i=0; $i<$nol; $i++)
	{echo("<tr>");
	$k=$i+1;
	echo("<td align=left> $k </td>");
	echo("<td align=left> $el[$i] </td>");
	echo("</tr>");}
echo("</table>");

fclose($table_lev);
fclose($table);//�������� ����� ��������� �������.
?>