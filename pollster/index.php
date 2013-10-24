<?php 
	$_SESSION["debug"]=( $_SERVER["HTTP_HOST"]=="localhost")? true : false;
	// $_SESSION["debug"]=false;
	$pageDesc = "This is the Pollster web app, used for live survey results."; //required for head.php view
	$dbLocation = "result";
//#### global requires (model functions)
	require_once('m/dbFunctionsLite.php'); //includes includes checks and getters
	require_once('m/miscFunctions.php'); //includes debug
//pre-check
	if ( $db = new SQLite3($dbLocation) ){
		if (checkQuestionTable($db) && checkAnswerTable($db) ) die("There was an error on the page, please contact the site administrator.");
		if ( isset($_POST["fldQuestionNumber"]) && isset( $_POST["fldAnswerNumber"]) ){ //if a Question and Answer were POSTed we are trying to submit
			$refURL=explode("?", $_SERVER["HTTP_REFERER"] );
			//(($_SERVER["HTTPS"])?'https://':'http://').
			$selfURL= ((@$_SERVER["HTTPS"])?'https://':'http://').$_SERVER['SERVER_NAME'].$_SERVER["PHP_SELF"];  //FUTURE: /~bug/ = //uvm.edu/~bug
			debug($selfURL);
			debug($refURL[0]);
			debug($_POST);
			
			if ( $refURL[0]==$selfURL) { //and if they were sent from this server
				$_SESSION["alreadyAnswered"][ $_POST["fldQuestionNumber"] ]=1; //make an array of QN's answered, make a function to check if dne or not in array
				addAnswerCount($db, $_POST['fldQuestionNumber'], $_POST['fldAnswerNumber']);
   				header( 'Location: '.$selfURL."?qn=".$_POST['fldQuestionNumber']."&sh=1" ) ;
			} //if referrer
		} //if post QN

		if ( isset($_GET["qn"]) ){
			debug($_GET);
			$questionNumber = $_GET["qn"];
			$questionText=getQuestion($db, $questionNumber);
			require_once("v/questionHeader.php"); // view of the Question Title. requires $questionText
			if ( isset($_GET["sh"]) ) {
				require_once("v/post.php");
			} else {
				require_once("v/mainQuestion.php"); //view to ask question. 
			}
			
		}//if get QN
		else {
			echo "there isn't a QN set";
		}
	} //if db
