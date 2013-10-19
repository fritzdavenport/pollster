<?php session_start() ?>
<!-- ADMIN.php - controller for pollster backend, self submits for various runstates -->
<?php
print_r($_SERVER);
$_SESSION["debug"]=(isset($_SERVER["REMOTE_USER"]) && ($_SERVER["REMOTE_USER"]=="cdavenp1")) ? true : false;
$securityCheck=1; //user is supposed to be here, able to modify db.
$redirectURL=null;
$databaseCheck=1; //database exists or was just created and is write-able
//$uname=$_SERVER["REMOTE_USER"]; 
$dbLocation = "../result";
$pageDesc = "This is the admin control panel for the Pollster web app"; //required for head.php view
require_once('m/miscFunctions.php'); //includes debug

//#### global requires (model functions)
require_once('m/dbFunctions.php'); //includes addQuestion, addAnswer, deleteAnswer, deleteQuestion, renameAnswer, renameQuestion

if ($securityCheck) { //user has proper permissions if ($_SERVER['HTTP_REFERER']=="https:".$assignURL."/sec/reserve.php")
	debug($_SESSION);
	if (isset($_POST) ) debug($_POST);
	//if ($_SESSION["debug"]){ echo phpinfo(); }
	if ( $db = new SQLite3($dbLocation) ){//database is setup and writeable
		//deleteTables($db); //start with a clean slate, for debugging
		if ( checkQuestionTable($db) ) createQuestionTable($db); //if a table doesn't exist, add it
		if ( checkAnswerTable($db) ) createAnswerTable($db);
		
		
		//$qn=addQuestion($db, "how's this?");
		//addAnswer($db, $qn, "hello");

		// echo "RESULT: ";
		// $a = @$db->query('SELECT * FROM Question'); 
		// $aa = $a->fetchArray();
		// print_r($aa);


		if ($_POST){
			$state = isset($_POST["s"] ) ? $_POST["s"] : "main";
			switch ($_POST["s"]) { //s for state
				case 'ans': //state is ans -> add answers to question
					$qn = addQuestion($db, $_POST["fldQuestionText"] );
					require_once('v/head.php'); //doctype, head, body. requires $pageDesc
					require_once('v/main.php'); //
					//ins question + form
					require_once('v/answerForm.php'); //end 	
					require_once('v/foot.php'); //end 	
				break;

				case 'sub': //state is sub -> submitting form
					foreach ($_POST as $key => $value) {
						if ( substr($key, 0, -1) == "fldAnswer" ){
							addAnswer($db, $_POST["fldQuestionNumber"], $value);
							//echo "hit";
						}
						//echo $key . " || ". $value;
					} //INTENTIALLY NOT TERMINATED, LET SUB RUN INTO MAIN 
					?>
					<p id="success">Congrats! Question added successfully!</p> 
					<?php
				default: //admin 'landing page'. Show the question form
					require_once('v/head.php'); //doctype, head, body. 
					require_once('v/main.php'); //
					require_once('v/questionForm.php');
					require_once('v/postForm.php');
					require_once('v/foot.php'); //end 	
				break;
			}
		} else {//admin 'landing page'. Show the question form
			$pageDesc = "This is the admin control panel for the Pollster web app";
			require_once('v/head.php'); //doctype, head, body. 
			require_once('v/main.php'); //
			require_once('v/questionForm.php');
			require_once('v/deleteForm.php');
			require_once('v/postForm.php');
			require_once('v/foot.php'); //end 				
		}

	} else{ //user is secure, database is not setup
		echo "Unknown error occured: Please email <a href=;mailto:cdavenp1@uvm.edu'>site administrator</a> ";
		die();
	}
} else { //user doesn't have proper permissions
	//meta-redirect? Display error message and link out?
}