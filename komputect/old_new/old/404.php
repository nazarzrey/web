<html>
<head>
</head>
<?php

function getBrowsersr() 
{ 
    $u_agents = $_SERVER['HTTP_USER_AGENT']; 
    $bnames = 'Unknown';

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agents) && !preg_match('/Opera/i',$u_agents)) 
    { 
        $bnames = 'Internet Explorer'; 
        $ubs = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agents)) 
    { 
        $bnames = 'Mozilla Firefox'; 
        $ubs = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agents)) 
    { 
        $bnames = 'Google Chrome'; 
        $ubs = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agents)) 
    { 
        $bnames = 'Apple Safari'; 
        $ubs = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agents)) 
    { 
        $bnames = 'Opera'; 
        $ubs = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agents)) 
    { 
        $bnames = 'Netscape'; 
        $ubs = "Netscape"; 
    }
	else{
		$bnames = 'Other Browser'; 
        $ubs = "Other Browser"; 
	}
    return array(
        'name'      => $bnames
    );
}
$uz=getBrowsersr();
$browsers = $uz['name'];
if($browsers=="Internet Explorer"){
	$Css_404 = "color: #ccc;";
}else{
	$Css_404 = "color: #fff;";
}
?>
<style>
#not_found{
	font-family: Garamond, serif;
	line-height: 1em;
	font-weight:bold;
	font-size: 192px;
	<?php echo $Css_404;?>
	text-shadow:0px 0px 0 rgb(229,229,229),1px 1px 0 rgb(213,213,213),2px 2px 0 rgb(198,198,198),3px 3px 0 rgb(182,182,182),4px 4px 0 rgb(166,166,166),5px 5px 0 rgb(150,150,150),6px 6px 0 rgb(135,135,135),7px 7px 0 rgb(119,119,119),8px 8px 0 rgb(103,103,103),9px 9px 0 rgb(87,87,87),10px 10px 0 rgb(72,72,72),11px 11px 0 rgb(56,56,56),12px 12px 0 rgb(40,40,40), 13px 13px 0 rgb(24,24,24),14px 14px 13px rgba(0,0,0,0.7),14px 14px 1px rgba(0,0,0,0.5),0px 0px 13px rgba(0,0,0,.2);
}
.not_found{font-size:14px;
border-top:orange solid 1px;}
</style>
<body>
	<div style="margin:auto; text-align:center; font-family:tahoma;font-size:14px;line-height:20px;">
        <div id="not_found" style="height:250px;">
            404
        </div>
        <div class="not_found"  style="height:30px;color:red;">
        	Page not found... <br/>
			<a style='text-decoration:none; color:blue;' href="http://komputeclift.com">Back To komputeclift.com</a>
        </div>
	</div>        
</body>
</html>