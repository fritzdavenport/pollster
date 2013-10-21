<!-- dbFunctions.php includes 
checkQuestionsTable in: database object, returns: T/F if table exists
createQuestionsTable in: database object, returns: none. status msg on debug. 
addQuestion: in: database object, question text. returns: question number.


checkAnswerTable in: database object, returns: T/F if table exists
createAnswerTable in: database object, returns: none. status msg on debug. 
addAnswer: in: database object, question number, answer text. returns: answer number.
-->

<?php
	function getQuestion($db, $questionNumber){
		$q = $db->query('SELECT fldQuestionText FROM Question WHERE fldQuestionNumber=1;');
		$questionText = $q -> fetchArray();
		//gets question text of supplied question number
		return $questionText["fldQuestionText"];
	}

	function addAnswerCount($db, $fldQuestionNumber, $fldAnswerNumber){
		$aa = $db->exec('UPDATE Answer SET TimesPicked = TimesPicked + 1 WHERE AnswerNumber="'.$fldAnswerNumber.'" AND fldQuestionNumber="'.$fldQuestionNumber.'";');
	}

	function getAnswerArray($db, $questionNumber){
		//$db->query('')
		//gets all answers of supplied question, returns array("Text":"AnswerNumber","Text":"AnswerNumber")
		return $answerArray;
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