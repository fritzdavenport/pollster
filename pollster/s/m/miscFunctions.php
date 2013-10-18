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
        $value.dump(); 
    }else{ 
        print("<p>&gt;${value}&lt;</p>"); 
    } 
} 
?> 