<?php session_start() ?>
<!--main.php -->
<?php
	$_SESSION["debug"]=( $_SERVER["HTTP_HOST"]=="localhost")? true : false;
	$pageDesc = "This is the Pollster web app, used for live survey results."; //required for head.php view
	$dbLocation = "result";
	$redirectURL=null; //Change this to mess with the post page?
	require_once('m/miscFunctions.php'); //includes debug

	//#### global requires (model functions)
	require_once('m/dbFunctionsLite.php'); //includes includes checks and getters
	if (isset($_POST) ) debug($_POST);

	//cookie check, send to post

	if ( $db = new SQLite3($dbLocation) ){
		if (checkQuestionTable($db) && checkQuestionTable($db) ) die("There was an error on the page, please contact the site administrator.");
		//goes from here to post.php on a successful click
		$questionNumber = (isset($_GET['qn'])) ? $_GET['qn']:1;
		$questionText=getQuestion($db, $questionNumber);
		require_once('v/mainQuestion.php'); //requires $questionText, answer $arrayName = array('' => , );

		if (null!==$_POST("fldQuestionNumber")) { //if there is a submitted question
			if (null!==$_POST("fldAnswerNumber") ){//with a submitted answer
				addAnswerCount($db, $fldQuestionNumber,	$fldAnswerNumber);
			}
		}

		if (null!==$_POST("s") ){ //if submitted? Show post?

		}
	}
?>