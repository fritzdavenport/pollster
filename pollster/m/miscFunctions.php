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

    function getURL($delimiter="false"){ //gets the URL, excluding current file, and current directory if $delimiter = current dir
        $urltmp=explode("/",$_SERVER["PHP_SELF"]);
        $urltmp2=implode("/", array_splice($urltmp, 0, count($urltmp)-($urltmp[count($urltmp)-2]==$delimiter?2:1) ) );
        return ((@$_SERVER["HTTPS"])?'https://':'http://').$_SERVER['SERVER_NAME'].$urltmp2;  
    }
?>