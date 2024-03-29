<?php session_start() ?>
<?php 
	// $_SESSION["debug"]=( (isset($_SERVER["REMOTE_USER"]) && ($_SERVER["REMOTE_USER"]=="cdavenp1") ) || $_SERVER["HTTP_HOST"]=="localhost")? true : false;
$_SESSION["debug"]=false; //override logic... just to get rid of the debugs

//#### global requires (model functions)
	require_once('m/dbFunctionsLite.php'); //includes includes checks and getters
	require_once('m/miscFunctions.php'); //includes debug

//####setting page variables
	$rootLoc = getURL(); //gets the current URL up to and including the /pollster part
	$dbLocation = getFS()."/result"; //gets the FS path up to and including the /pollster part
	$pageDesc = "This is the Pollster web app, used for live survey results."; //required for head.php view

//pre-check
	if ( $db = new SQLite3($dbLocation) ){
		if (checkQuestionTable($db) && checkAnswerTable($db) && checkAppTable($db) ) die("There was an error on the page, please contact the site administrator.");
		if ( isset($_POST["fldQuestionNumber"]) && isset( $_POST["fldAnswerNumber"]) ){ //if a Question and Answer were POSTed we are trying to submit
			if ( strpos($_SERVER["HTTP_HOST"],$_SERVER["HTTP_REFERER"]) === false ) { //and if they were sent from this server
				// ##### MAKE THIS COOKIE BASED
				$_SESSION["alreadyAnswered"][ $_POST["fldQuestionNumber"] ]=1; //make an array of QN's answered, make a function to check if dne or not in array
				addAnswerCount($db, $_POST['fldQuestionNumber'], $_POST['fldAnswerNumber']);
   				header( 'Location: '.$rootLoc."/question".$_POST['fldQuestionNumber']."/show" ); //once the answer is submitted, redirect to the show page.
			} //if referrer
		} //end if post

		if ( isset($_GET["up"]) ) { // we are looking for a JSON update of the given question number
			if ( isset($_GET["qn"]) ){
				$questionNumber = $_GET["qn"];
				$dbResult = getAnswerArray($db, $questionNumber);
				$answersList = array();
				foreach ($dbResult as $row ) $answersList[ $row["fldAnswerText"] ] = $row["fldTimesPicked"]; 
				echo json_encode($answersList);
			}
		} else if ( isset($_GET["qn"]) ){ // IF WE ARE ASKING THEM A SPECIFIC QUESTION
			$questionNumber = $_GET["qn"];
			$questionText=getQuestion($db, $questionNumber);
			require_once("v/head.php");
			require_once("v/questionHeader.php"); // view of the Question Title. requires $questionText
			
			if ( isset($_GET["sh"]) ) { //IF THEY HAVE ALREADY ANSWERED THE QUESTION, SHOW THEM THE ANSWERS
				// debug($_GET);
				$dbResult = getAnswerArray($db, $questionNumber);
				$questionDescription = getQuestionDescription($db, $questionNumber);
				$answersList = array();
				foreach ($dbResult as $row ) $answersList[ $row["fldAnswerText"] ] = $row["fldTimesPicked"]; 
				require_once("v/showAnswer.php"); //view to show the answers.
			} else { // OR SHOW THEM THE QUESTION
				require_once("v/askQuestion.php"); //view to ask question. 
			}
			
			require_once("v/foot.php");
		}//end if get QN
		else { // LANDING PAGE
			$questionText="Pollster version 2.1";
			require_once("v/head.php");
			require_once("v/questionHeader.php"); // view of the Question Title. requires $questionText
			require_once("v/foot.php");
		}
	} //end if db
?>