<!DOCTYPE html>
<html>
<head>
	<title>testpage</title>
</head>
<body>
	<?php
	function debug($value=''){ 
        $btr=debug_backtrace(); 
        $line=$btr[0]['line']; 
        $file=basename($btr[0]['file']); 
        print"<pre>$file:$line</pre>\n"; 
        if(is_array($value)){ 
            print"<pre>"; 
            print_r($value); 
            print"</pre>\n"; 
        }elseif(is_object($value)){ 
            var_dump($value); 
        }else{ 
            print("<p>&gt;${value}&lt;</p>"); 
        } 
    }
		//debug($_SERVER);

		$urltmp=explode("/",$_SERVER["PHP_SELF"]);
		$urltmp2=implode("/", array_splice($urltmp, 0, count($urltmp)-1) );
		$httpCurrLoc = ((@$_SERVER["HTTPS"])?'https://':'http://').$_SERVER['SERVER_NAME'].$urltmp2;  
		debug($httpCurrLoc);
		//$rootLoc = explode("/misc",$_SERVER["SCRIPT_URI"]); // [SCRIPT_URI] => https:/


		echo get_current_user()."\n";
		$processUser = posix_getpwuid(posix_geteuid());
		print $processUser['name'];
	?>
	<form>
			<form action=<?php echo "'".$_SERVER['PHP_SELF']."'"; ?> method="post">
			hi
			<INPUT TYPE=SUBMIT VALUE="submit">
		</form>
	</form>
</body>
</html>