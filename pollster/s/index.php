<?php session_start() ?>
<!-- ADMIN.php - controller for pollster backend, self submits for various runstates -->
<?php
$_SESSION["debug"]=( (isset($_SERVER["REMOTE_USER"]) && ($_SERVER["REMOTE_USER"]=="cdavenp1") ) || $_SERVER["HTTP_HOST"]=="localhost")? true : false;
// $_SESSION["debug"]=false; //override logic... just to get rid of the debugs
require_once('../m/miscFunctions.php'); //includes debug, getURL, and 
//#### global requires (model functions)
require_once('m/dbFunctions.php'); //includes addQuestion, addAnswer, deleteAnswer, deleteQuestion, renameAnswer, renameQuestion

$securityCheck=1; //user is supposed to be here, able to modify db.
$rootLoc = getURL("s"); //gets the current URL excluding the current page and the directory in quotes
$dbLocation = "../result";
$pageDesc = "This is the admin control panel for the Pollster web app"; //required for head.php view
debug($_SERVER);

if ($securityCheck){
	//debug($_SESSION);
	//if (isset($_POST) ) debug($_POST);
	//if ($_SESSION["debug"]){ echo phpinfo(); }
	if ( $db = new SQLite3($dbLocation) ){//database is setup and writeable
		//deleteTables($db); //start with a clean slate, for debugging
		if ( checkQuestionTable($db) ) createQuestionTable($db); //if a table doesn't exist, add it
		if ( checkAnswerTable($db) ) createAnswerTable($db);
		if ($_POST){ //if there is a post var, or state submitted (if they clicked a button and got sent here
			switch ($_POST["s"]) { //s for state
				case 'ans': //state is ans. TAKES QUESTION (submitted from main), adds to db, asks answers, sends to sub
					$qn = addQuestion($db, $_POST["fldQuestionText"] );
					require_once('../v/head.php'); //doctype, head, body. requires $pageDesc
					require_once('v/adminHeader.php'); //
					//ins question + form
					require_once('v/answerForm.php'); //end 	
					require_once('../v/foot.php'); //end 	
				break;

				case 'del': //TODO: JQUERIFY THIS TO VERIFY SUBMIT
					require_once('../v/head.php'); //doctype, head, body. 
					require_once('v/adminHeader.php'); //
					deleteTables($db); ?>
					<p id="delete">Tables have been deleted successfully.</p> 
					<?php
					require_once('v/questionForm.php');
					require_once('../v/foot.php'); //end 	
				break;

				case 'sub': //state is sub -> submits answers and goes back to default runstate.
					foreach ($_POST as $key => $value) {
						if ( substr($key, 0, -1) == "fldAnswer" ){ //gets submitted here as Ans1, Ans2. Strips the number and adds to db
							addAnswer($db, $_POST["fldQuestionNumber"], $value);
						}
					} //INTENTIALLY NOT TERMINATED, LET SUB RUN INTO MAIN 
					?>
					<p id="success">Congrats! Question added successfully.</p> 
					<?php
				default: //admin 'landing page'. Show the question form
					require_once('../v/head.php'); //doctype, head, body. 
					require_once('v/adminHeader.php'); //
					require_once('v/questionForm.php');
					require_once('v/postForm.php');
					require_once('../v/foot.php'); //end 	
				break;
			}
		} else {//admin 'landing page'. Show the question form
			$pageDesc = "This is the admin control panel for the Pollster web app";
			require_once('../v/head.php'); //doctype, head, body. 
			require_once('v/adminHeader.php'); //
			require_once('v/questionForm.php');
			require_once('v/deleteForm.php');
			require_once('v/postForm.php');
			require_once('../v/foot.php'); //end 				
		}

	} else{ //user is secure, database is not setup
		echo "Unknown error occured: Please email <a href=;mailto:cdavenp1@uvm.edu'>site administrator</a> ";
		die();
	}
} else { //user doesn't have proper permissions
	//meta-redirect? Display error message and link out?
}