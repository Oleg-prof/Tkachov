<?php
header("Content-type: image/png");

$flog=fopen("log.txt","w");
$ftemp=fopen("f_temp.txt","r");
if(!$ftemp)
	fprintf($flog,"%s","File f_temp.txt was not opened\n");
else{
	fprintf($flog,"%s","File f_temp.txt was opened\n");
	fscanf($ftemp,"%d",&$nlev);
	fscanf($ftemp,"%s",&$fpu);  // $fpu name of the file containing potential energies
	fscanf($ftemp,"%f",&$dr);  // Dimension of the potential curve in angstrems.
	fscanf($ftemp,"%d",&$margin);  // margins of the image in pixels
$margin=10;	
	fprintf($flog,"%s %d\n","Number of the levels to be depicted is ",$nlev);
}
$fu=fopen($fpu,"r");  // file with the potential energy.l

if($fu)
	fprintf($flog,"%s","File $fpu was opened\n");
else{
	fprintf($flog,"%s","File $fpu was not opened\n");
	exit;}
	
$file=fopen("temp.txt","r");  // file with the oscillator energy levels.
if($file)
	fprintf($flog,"%s","File temp.txt was opened/n");
else{
	fprintf($flog,"%s","File temp.txt was not opened\n");
	exit;
}


$fdata=fopen("out data.txt","r");// file with eigenfunctions
if(!$fdata)
{
	fprintf($flog,"%s","File out data.txt was not opened\n");
	exit;
}
else{
	fprintf($flog,"%s","File out data.txt was opened\n");
}


fscanf($file,"%d",&$np);
if($nlev > $np)
 $na=$np;
else
 $na=$nlev;
for($i=0; $i<$na; $i++)
  {
	fscanf($file,"%f",&$ol[$i]);
	
  }

// Potential curve
fscanf($fu,"%d",&$nu);
// Reading
for($i=0; $i<$nu; $i++)
  {
	fscanf($fu,"%f",&$u[$i]);
  }
fscanf($fu,"%f",&$umin); // minimum of potential energy

// Sorted potential energy.
for($i=0; $i<$nu; $i++)
  {
	fscanf($fu,"%d %f",&$kc[$i],&$us[$i]);
  }

for($i=0; $i<$na; $i++)
	$ol[$i]-=$umin;
for($i=0; $i<$nu; $i++){
	$u[$i]-=$umin;
	$us[$i]-=$umin;
}

// Reading 1 eigenfunction
for($i=0; $i<$nu; $i++)
{
	fscanf($fdata,"%f",&$da[$i]);
}

// Left boundary
$li=0;
for($i=0; $i<$nu; $i++)
  {
	if($u[$i] <= $ol[$na-1]){
		$li=$i;
		break;
	}
  }

// Right boundary
$lr=$nu-1;
for($i=$nu-1; $i>0; $i--)
  {
//  fprintf($flog,"%d  %f  %f\n",$i,$u[$i],$ol[$na-1]);
	if($u[$i] <= $ol[$na-1]){
		$lr=$i;
		break;
	}
  }
 $t=10;
// Imaging
$iwidth=1280;
$iheight=1024;
$img = imagecreate($iwidth, $iheight);
$background_color = imagecolorallocate($img, 255, 255, 255);
$text_color = imagecolorallocate($img, 0, 0, 0);

// Rectangle around the picture
	imagesetthickness($img, 1);
	imagerectangle($img,$margin+$t,$margin,$iwidth-$margin+$t,$iheight-$margin,$text_color);
//Determination of the y-coordinates for levels choosen.
$ep=$ol[$na-1]/($iheight-2*$margin);  // energy gap for pixel.
fprintf($flog,"%f\n",$ep);

// x coordinates of the levels.
for($i=0; $i<$na; $i++)
{
	$k=0;
	while($ol[$i]<$u[$k])
		$k++;
fprintf($flog,"%s%f %f %f %f/n","k1=",$k,$ol[$i],$u[$k],$u[$k-1]);
	$xl[$i]=$t+$margin+($k-($ol[$i]-$u[$k])/($u[$k-1]-$u[$k])-$li)*($iwidth-2*($t+$margin))/($lr-$li);
	$k=$nu-1;
	while($ol[$i]<$u[$k])
		$k--;
	$xr[$i]=$t+$margin+($k+($ol[$i]-$u[$k])/($u[$k+1]-$u[$k])-$li)*($iwidth-2*($t+$margin))/($lr-$li);
fprintf($flog,"%s%f\n","k2=",$k);
}

// y coordinates of the levels.
$y[0]=$iheight-$margin-$ol[0]/$ep;
for($i=1; $i<$na; $i++)
  {
	 $y[$i]=$iheight-$margin-$ol[$i]/$ep;
  }

// Level drawing
imagesetthickness($img, 3);
for($i=0; $i<$na; $i++)
  {
	imageline($img,$t+$xl[$i],$y[$i],$t+$xr[$i],$y[$i],imagecolorallocate($img,0,0,0));

  }

for($i=$li; $i<=$lr; $i++){
	$_y=$iheight-$margin-$u[$i]/$ep;
	if($_y<$margin)continue;
	$x1[$i]=$t+$margin+($i-$li)*($iwidth-2*($t+$margin))/($lr-$li);
	$y1[$i]=$_y;
	imageellipse($img, $t+$x1[$i], $y1[$i], 6, 6, imagecolorallocate($img, 0, 0, 0));
}

// Lines through the points.
$i=0;
foreach($x1 as $key=>$val){
	if($i==0)
		$i=1;
	else
	{
		if($key-$key1==1)
		{
		imageline($img,$t+$val1,$y1[$key1],$t+$val,$y1[$key],imagecolorallocate($img,255,0,0));		}
	}
	$key1=$key;
	$val1=$val;
}

for ($i=1; $i<=$nlev;$i++)

	{imagestring($img,2,0,$y[$i]-4,$i,$text_color);}
	
for($i=$li; $i<=$lr; $i++){
	$_y=$iheight-$margin-$da[$i]*$da[$i]*0.3/$ep;
	if($_y<$margin)continue;
	$x1[$i]=$t+$margin+($i-$li)*($iwidth-2*($t+$margin))/($lr-$li);
	$y1[$i]=$_y;
	imageellipse($img, $t+$x1[$i], $y1[$i], 10, 10, imagecolorallocate($img, 0, 0, 0));
}


imagepng($img);
imagedestroy($img);

fclose($file);
fclose($ftemp);
fclose($fu);
fclose($flog);
?>

