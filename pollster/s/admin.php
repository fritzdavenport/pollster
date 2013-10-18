<!-- ADMIN.php - controller for pollster backend, self submits for various runstates -->
<p>DISPLAY</p>
<?php //controller init
$securityCheck=1; //user is supposed to be here, able to modify db.
$databaseCheck=1; //database exists or was just created and is write-able
$DEBUG=true;
$uname=$_SERVER["REMOTE_USER"]; 
$dbLocation = "../result";


//#### global requires (model functions)
require_once('m/dbFunctions.php'); //includes addQuestion, addAnswer, deleteAnswer, deleteQuestion, renameAnswer, renameQuestion

if ($securityCheck) { //user has proper permissions
	if ($DEBUG){ echo $_POST; }
	if ( $db = new SQLiteDatabase($dbLocation) ){//database is setup and writeable
		if (! ( checkQuestionTable($db) ) ) createQuestionTable($db); //if a table doesn't exist, add it
		if (! ( checkAnswerTable($db) ) ) createAnswerTable($db);
		
		switch ($_POST["state"]) { //show question table? add ans? 
			case 'postq':
				# code... isset($_POST['xxx'])
				break;
			
			default: //admin 'landing page'. Show the question form
				require_once('v/head.php'); //doctype, head, body.
				require_once('v/main.php'); //
				require_once('v/questionForm.php');
				require_once('v/foot.php'); //end 			
				break;
		}

	} else{ //user is secure, database is not setup
		echo "Unknown error occured: Please email <a href=;mailto:cdavenp1@uvm.edu'>site administrator</a> ";
		die();
	}
} else { //user doesn't have proper permissions
	//meta-redirect? Display error message and link out?
}