<?php session_start() ?>
<?php 
$_SESSION["debug"]=( (isset($_SERVER["REMOTE_USER"]) && ($_SERVER["REMOTE_USER"]=="cdavenp1") ) || $_SERVER["HTTP_HOST"]=="localhost")? true : false;
$_SESSION["debug"]=true; //override logic... just to get rid of the debugs

//#### global requires (model functions)
	require_once('m/dbFunctionsLite.php'); //includes includes checks and getters
	require_once('m/miscFunctions.php'); //includes debug

//####setting page variables
	$rootLoc = getURL("s"); //gets the current URL excluding the current page and the directory in quotes
	$dbLocation = "result";
	$pageDesc = "This is the Pollster web app, used for live survey results."; //required for head.php view



//pre-check
	if ( $db = new SQLite3($dbLocation) ){
		if (checkQuestionTable($db) && checkAnswerTable($db) ) die("There was an error on the page, please contact the site administrator.");
		if ( isset($_POST["fldQuestionNumber"]) && isset( $_POST["fldAnswerNumber"]) ){ //if a Question and Answer were POSTed we are trying to submit
			$refURL=getURL($_SERVER["HTTP_REFERER"]);
			debug($_POST);
			debug($refURL);
			debug($rootLoc);
			
			if ( $refURL[0]==$rootLoc) { //and if they were sent from this server
				$_SESSION["alreadyAnswered"][ $_POST["fldQuestionNumber"] ]=1; //make an array of QN's answered, make a function to check if dne or not in array
				addAnswerCount($db, $_POST['fldQuestionNumber'], $_POST['fldAnswerNumber']);
   				header( 'Location: '.$currLoc."?qn=".$_POST['fldQuestionNumber']."&sh=1" ); //once the answer is submitted, redirect to the show page.
			} //if referrer
		} //if post QN

		if ( isset($_GET["qn"]) ){
			debug($_GET);
			$questionNumber = $_GET["qn"];
			$questionText=getQuestion($db, $questionNumber);
			require_once("v/head.php");
			require_once("v/questionHeader.php"); // view of the Question Title. requires $questionText
			if ( isset($_GET["sh"]) ) {
				require_once("v/showAnswer.php"); //view to show the answers.
			} else {
				require_once("v/askQuestion.php"); //view to ask question. 
			}
			require_once("v/foot.php");
		}//if get QN
		else {
			$questionText="Pollster version 1.05";
			require_once("v/head.php");
			require_once("v/questionHeader.php"); // view of the Question Title. requires $questionText
			require_once("v/foot.php");
		}
	} //if db