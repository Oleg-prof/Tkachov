<?php
$table_lev=fopen("table_lev.txt","r");//Файл для построения таблицы.
if($table_lev)
	{ fprintf($log,"%s\n","Файл table_lev.txt открыт");//Запись в log.
	}
else
	{echo("Ошибка открытия файла table_lev.txt");
	fprintf($log,"%s\n",$err_1);//Запись в log.
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
fclose($table);//Закрытие файла постройки таблицы.
?>