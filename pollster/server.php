	
<pre>
	<?php
		echo $v=$_SERVER['SCRIPT_FILENAME'];
		
		print_r( $x=explode('/',$v) );
		echo ($i=array_search("pollster", $x));
		echo implode("/",array_splice( $x=explode('/',$_SERVER['SCRIPT_FILENAME']),0,array_search("pollster",$x) ) )."pollster";
		print_r( $_SERVER ); ?>
	?>
</pre>
