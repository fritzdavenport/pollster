<?php 
    function debug($value=''){ 
        if ($_SESSION['debug']){
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
    }

    function chkHeaders(){
        if(headers_sent($file, $line)){
            // ... where were the mysterious headers sent from?
            echo "Headers were already sent in $file on line $line...";
        }
    }

    function getURL($sourcestring){ //gets the URL, excluding and the "admin" directory
        $urltmp=explode("/",$sourcestring);array_search("admin", $urltmp)===false;
        $urltmp2=implode("/", array_splice($urltmp, 0, count($urltmp)-(array_search("admin", $urltmp)===false?2:1) ) );
        return ((@$_SERVER["HTTPS"])?'https://':'http://').$_SERVER['SERVER_NAME'].$urltmp2;  
    }
?>