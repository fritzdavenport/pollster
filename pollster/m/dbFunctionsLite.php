<?php
// dbFunctions.php includes 
// checkQuestionsTable in: database object, returns: T/F if table exists
// createQuestionsTable in: database object, returns: none. status msg on debug. 
// addQuestion: in: database object, question text. returns: question number.


// checkAnswerTable in: database object, returns: T/F if table exists
// createAnswerTable in: database object, returns: none. status msg on debug. 
// addAnswer: in: database object, question number, answer text. returns: answer number.

	function getQuestion($db, $questionNumber){ //gets question text of supplied question number
		$q = $db->query('SELECT fldQuestionText FROM Question WHERE fldQuestionNumber="'.$questionNumber.'";');
		$questionText = $q -> fetchArray();
		return $questionText["fldQuestionText"];
	}

	function getRedirect($db, $questionNumber){ //gets redirect from 
		$r = $db->query('SELECT fldQuestionText FROM Question WHERE fldQuestionNumber="'.$questionNumber.'";');
		$redirect = $r -> fetchArray();
		return $redirect["fldRedirect"];
	}

	function addAnswerCount($db, $fldQuestionNumber, $fldAnswerNumber){
		$aa = $db->exec('UPDATE Answer SET fldTimesPicked = fldTimesPicked + 1 WHERE fldAnswerNumber="'.$fldAnswerNumber.'" AND fldQuestionNumber="'.$fldQuestionNumber.'";');
	}

	function getAnswerArray($db, $questionNumber){
		$a = $db->query('SELECT "fldAnswerText", "fldTimesPicked" FROM Answer WHERE fldQuestionNumber="'.$questionNumber.'";');
		$answers = array();
		while ($temp = $a -> fetchArray() ) $answers[]= $temp;
		if (!!$answers) {  //typecast a as a bool for a definite true/false
			return $answers;
		} else {
			$btr=debug_backtrace();
			echo "There was an unexpected error. Are you sure you are at a valid question? m/dbFL:".$btr[0]['line'];
			exit;
		}
	}

	function checkAnswerTable ($db){
		$p = @$db->query('SELECT * FROM Answer'); //test if number is within range
		return $p === false; 
	}

	function checkQuestionTable ($db){
		$q = @$db->query('SELECT * FROM Question'); 
		return $q === false; 
	}

?>