<?php 

#var's
$imgurl='https://d.iplsc.com/weather/svg-icons/'; #.svg
$fndimg='weather-currently-icon ico-'; #27/2
$fndtemp='weather-currently-temp-strict'; #31/5 -12oC
$fndimg1='weather-currently-icon-picture-0'; #118/2
$fndimg2='weather-currently-icon-picture-1'; #118/2
$fndtemp1='weather-currently-middle-forecast-temperature-max-0';#140/5
$fndtemp2='weather-currently-middle-forecast-temperature-max-1';#140/5

#load
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, 'https://pogoda.interia.pl/prognoza-szczegolowa-mostiska,cId,2948598');  
curl_setopt($ch, CURLOPT_HEADER, 0);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
$content = curl_exec($ch);  
curl_close($ch);

#Parse
$img0=$imgurl.str_replace('"','',substr($content,strpos($content,$fndimg)+27,2)).'.svg';
$temp0=str_replace('В','',str_replace('/','',str_replace('<','',substr($content,strpos($content,$fndtemp)+31,6))));
$img1=$imgurl.str_replace('"','',substr($content,strpos($content,$fndimg1)+118,2)).'.svg';
$img2=$imgurl.str_replace('"','',substr($content,strpos($content,$fndimg2)+118,2)).'.svg';
$temp1=str_replace('В','',str_replace('/','',str_replace('<','',substr($content,strpos($content,$fndtemp1)+146,5))));
$temp2=str_replace('В','',str_replace('/','',str_replace('<','',substr($content,strpos($content,$fndtemp2)+146,5))));

#Out 
#echo '<div id="Console">';
#echo '<hr>Консоль виводу:';
#echo '<br>img0 - "'.$img0.'"';
#echo '<br>temp0 - "'.$temp0.'"';
#echo '<br>img1 - "'.$img1.'"';
#echo '<br>temp1 - "'.$temp1.'"';
#echo '<br>img2 - "'.$img2.'"';
#echo '<br>temp2 - "'.$temp2.'"';
#echo '<br><hr><br></div>';
?>

<html>
<head><title>Weather</title>
<meta http-equiv="content-type" content="text/html; charset=windows-1251"/>
<style type="text/css">
	body{margin: 0px auto;}
	
    #wrap:hover #main{
        height: 0px;
        opacity: 0;
    }

    #wrap:hover #float{
        height: 50px;
        opacity: 100;
    }

    #wrap {
        width: 170px;
        height: 50px;
        display: block;
    }

    #main {
    	width: 170; 
    	height: 50px;
    	vertical-align: middle; 
    	display: inline-flex; 
        -webkit-transition: all 1s ease-in-out;
        transition: all 1s ease-in-out;
    }
    
    #main img {width: 50px; height: 50px;}
    
    #main span {
    	font-size: 2.3em; 
    	font-family: Verdana, Arial, Helvetica, sans-serif; 
    	color: #fff;
        margin-left: 10px;
    }

    #d1,#d2{
        width: 49%;
    }

    legend {
    	font-size: 1em;
    	color: #fff;
    	text-align: center;
        margin: auto;
    }

    #float img {width: 32px; height: 32px;}

    #float span {
        font-size:  1em; 
        font-family: Verdana, Arial, Helvetica, sans-serif; 
        color: #fff; 
        vertical-align: super;}

    #float {
        z-index: 2;
    	width: 170; 
    	height: 0px;
    	position: relative; 
    	display:flex; 
        opacity: 0;
        -webkit-transition: all 1s ease-in-out;
        transition: all 1s ease-in-out;
    }
    
    #float div {margin: 0px auto;}

    #divider {font-size: 2.4em; color: white;}

  </style>
</head>
<body bgcolor="#910201">
<div id="wrap">
	<div id="main">
		<img src="<?php echo $img0; ?>">
		<span><?php echo $temp0; ?></span>
	</div>

	<div id="float">
        
		<div id=d1>
            <legend>Завтра</legend>
            <div id="fw">
                <img src="<?php echo $img1; ?>">
                <span><?php echo $temp1; ?></span>        
            </div>
		</div>

        <div id="divider">|</div>
        
        <div id=d2>
            <legend>Післязавтра</legend>
            <div id="fw">
                <img src="<?php echo $img2; ?>">
                <span><?php echo $temp2; ?></span>     
            </div>
		</div>
	</div>
</div>
</body>
</html>