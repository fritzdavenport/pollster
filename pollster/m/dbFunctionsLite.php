<!-- dbFunctions.php includes 
checkQuestionsTable in: database object, returns: T/F if table exists
createQuestionsTable in: database object, returns: none. status msg on debug. 
addQuestion: in: database object, question text. returns: question number.


checkAnswerTable in: database object, returns: T/F if table exists
createAnswerTable in: database object, returns: none. status msg on debug. 
addAnswer: in: database object, question number, answer text. returns: answer number.
-->

<?php
	function getQuestion($db, $questionNumber){ //gets question text of supplied question number
		$q = $db->query('SELECT fldQuestionText FROM Question WHERE fldQuestionNumber="'.$questionNumber.'";');
		$questionText = $q -> fetchArray();
		return $questionText["fldQuestionText"];
	}

	function getRedirect($db, $questionNumber){
		$r = $db->query('SELECT fldQuestionText FROM Question WHERE fldQuestionNumber="'.$questionNumber.'";');
		$redirect = $r -> fetchArray();\
		return $redirect["fldRedirect"];
	}

	function addAnswerCount($db, $fldQuestionNumber, $fldAnswerNumber){
		$aa = $db->exec('UPDATE Answer SET fldTimesPicked = fldTimesPicked + 1 WHERE fldAnswerNumber="'.$fldAnswerNumber.'" AND fldQuestionNumber="'.$fldQuestionNumber.'";');
	}

	function getAnswerArray($db, $questionNumber){
		$a = $db->query('SELECT "fldAnswerText", "fldTimesPicked" FROM Answer WHERE fldQuestionNumber="'.$questionNumber.'";');
		while ($temp = $a -> fetchArray() ) $answers[]= $temp;
		return $answers;
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