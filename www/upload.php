<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN">
<html>
<head>
<title>Расчет уровней квантового ангармонического осциллятора.</title>
<meta http-equiv="content-type" content="text/html; charset=Windows-1251" />
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="vs_targetSchema" content="http://schemas.microsoft.com/intellisense/ie5">
</head>
<body>
	<table align="center" height="80%" width="80%">
		<tr>
			<td  class="top_left"><img class="logo" src="image/logo.png" alt="ХНУ" /><img class="logo2" src="image/logo1.png" alt="LOGO" /></td>
			<td  class="top_right" colspan="3">Расчет уровней энергии квантового ангармонического осциллятора.</td>
			<td></td>
		</tr>
		<tr>
			<td class="center"><a class="button" href="index.html"shape="rect">ГЛАВНАЯ</a></td>
			<td class="center"><a class="button" href="desc.html"shape="rect">ОПИСАНИЕ</a></td>
			<td class="center"><a class="button" href="calc.html"shape="rect">РАСЧЕТ</a></td>
			<td class="center"><a class="button" href="addit.html"shape="rect">ТЕСТ</a></td>		
		</tr>
		<tr>
			<td colspan="4" class="buttom">
			<font class="zagl">Расчет завершен.</font>

<?php
$log=fopen("log_up.txt","w");
$filename='upot.txt';//Имя для файла кривой.

//Записи для log_up.
$z='upload.php работает.';
$z1='Записи в файла Potencial.txt успешна.';
$z2='Записи в файла Initial.txt успешна.';
$z3='Записи в файла f_temp.txt успешна.';
$z4='Записи в файла table.txt успешна.';

//Записи ошибок.
$err_1='Ошибка открытия, записи файла Potencial.txt.';
$err_2='Ошибка открытия, записи файла Initial.txt.';
$err_3='Ошибка открытия, записи файла f_temp.txt.';
$err_4='Ошибка открытия, записи файла table.txt.txt.';

fprintf($log,"%s\n",$z);

//Переменные.
	$nop=(float)$_POST["nop"];//Число точек.
	$sec=(float)$_POST["sec"];//Вторая производная.
	$w_m=(float)$_POST["w_m"];//Ширина подъёма.
	$h_m=(float)$_POST["h_m"];//Высота подъёма.
	$wid=(float)$_POST["width"];//Ширина кривой.
	$nol=(float)$_POST["nol"];//Число уровней для расчета.
	$mass=(float)$_POST["mass"];//Масса частицы.
	
//Открытие файлов.
$pot=fopen("Potencial.txt","w");//Файл для постройки кривой.
$fini=fopen("Initial.txt","w");//Файл для расчетной программы.
$ftemp=fopen("f_temp.txt","w");//Файл для постройки кривой.
$table=fopen("table.txt","w");//Файл для построения таблицы.

//Запись для постройки кривой.
if($pot)
	{fprintf($pot,"%d\n",$nop);//Число точек.
	fprintf($pot,"%f\n",$sec);//Вторая производная.
	fprintf($pot,"%f\n",$w_m);//Ширина подъёма.
	fprintf($pot,"%f\n",$h_m);//Высота подъёма.
	fprintf($pot,"%f\n",$wid);//Ширина кривой.
	fprintf($log,"%s\n",$z1);}//Запись в log.
else
	{echo("Ошибка открытия файла Potencial.txt");
	fprintf($log,"%s\n",$err_1);//Запись в log.
	fclose($pot);//Закрытие файла постройки кривой.
	exit;}
fclose($pot);//Закрытие файла постройки кривой.

//Запуск программы постройки кривой.
exec("Potencial_Energy.exe",$output);
		
//Запись для расчетной программы.
if($fini)
	{fprintf($fini,"%s\n",$filename);//Запись имени файла кривой.
	fprintf($fini,"%f\n",$mass);//Масса частицы.
	fprintf($fini,"%f\n",$wid);//Ширина кривой.
	fprintf($log,"%s\n",$z2);}//Запись в log.
else
	{echo("Ошибка открытия файла Initial.txt");
	fprintf($log,"%s\n",$err_2);//Запись в log.
	fclose($fini);//Закрытие файла для расчетной программы.
	exit;}
fclose($fini);//Закрытие файла для расчетной программы.
   
//Запись для программы рисования кривой.
if($ftemp){
	fprintf($ftemp,"%d\n",$nol);//Число уровней.
	fprintf($ftemp,"%s\n",$filename);//Имя для файла кривой.
	fprintf($ftemp,"%f\n",$wid);//Ширина кривой.
	fprintf($log,"%s\n",$z3);}//Запись в log.
else
	{echo("Ошибка открытия файла f_temp.txt");
	fprintf($log,"%s\n",$err_3);//Запись в log.
	fclose($fini);//Закрытие файла для программы рисования кривой.
	exit;}
fclose($ftemp);//Закрытие файла для программы рисования кривой.

//Запуск программы расчета энергии.
exec("Third.exe",$output);


//Запись для постройки таблицы.
if($table){
	fprintf($table,"%s\n",$nol);
	fprintf($log,"%s\n",$z4);}//Запись в log.
else
	{echo("Ошибка открытия файла table.txt");
	fprintf($log,"%s\n",$err_4);//Запись в log.
	fclose($table);//Закрытие файла постройки таблицы.
	exit;}
fclose($table);//Закрытие файла постройки таблицы.

?>

<p>
<img src="draw.php" alt="График" width="1000" height="1000" align="middle" />
</p>

			</td>
		</tr>
	</table>
</body>
</html>	