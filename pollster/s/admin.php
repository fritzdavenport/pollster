<!-- ADMIN.php - controller for pollster backend, self submits for various runstates -->

<?php //controller init
$securityCheck=1; //user is supposed to be here, able to modify db.
$databaseCheck=1; //database exists or was just created and is write-able
$tablesCheck=1;
$DEBUG=true;
$uname=$_SERVER["REMOTE_USER"]; 
$dbLocation = "../result";


//#### global requires (model functions)
require_once('./m/dbFunctions.php'); //includes addQuestion, addAnswer, deleteAnswer, deleteQuestion, renameAnswer, renameQuestion

if ($securityCheck) { //user has proper permissions
	if ( $db = new SQLiteDatabase($dbLocation) ){//database is setup and writeable
		if ($tableCheck){ //both tables exist and are ready to be written
			if( checkQuestionsTable($db) ){echo "questions exists";} else { echo "questions dne";} //code
		} else { //one or both tables do not exist and need to be created.

		}
		switch ($_POST["state"]) { //show question table? add ans? 
			case 'value':
				# code... isset($_POST['xxx'])
				break;
			
			default: //admin 'landing page'. Show the question form
				require_once('./v/head.php'); //doctype, head, body.
				require_once('./v/main.php'); //
				require_once('./v/questionForm.php');
				require_once('./v/foot.php'); //end 			
				break;
		}

	} else{ //user is secure, database is not setup
		//setup the database. or die with an error.
	}
} else { //user doesn't have proper permissions
	//meta-redirect? Display error message and link out?
}