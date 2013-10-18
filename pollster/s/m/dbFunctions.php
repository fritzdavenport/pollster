<!-- dbFunctions.php includes 
checkQuestionsTable in: database object, returns: T/F if table exists
createQuestionsTable in: database object, returns: none. status msg on debug. 
addQuestion: in: database object, question text. returns: question number.


checkAnswerTable in: database object, returns: T/F if table exists
createAnswerTable in: database object, returns: none. status msg on debug. 
addAnswer: in: database object, question number, answer text. returns: answer number.
-->

<?php
	function checkQuestionsTable ($db){
		$q = @$db->query('SELECT * FROM Question'); 
		return $q === false; 
	}

	function createQuestionTable ($db){
		$qta = $db->queryExec('CREATE TABLE Question '.'(fldQuestionNumber INTEGER PRIMARY KEY, 
																fldRefIn TEXT,
																fldRedirect TEXT,
																fldQuestionText TEXT NOT NULL)');
		if ($DEBUG && $qta){
			echo "table Question hadn't been made, but I got it.</br>";
		} else {
			if ($DEBUG){echo "Something went wrong with Question table creation";}
		}
	}

	function checkAnswerTable ($db){
		$p = @$db->query('SELECT * FROM Answer'); //test if number is within range
		return $p === false; 
	}

	function createAnswerTable($db){
		$cta = $db->queryExec('CREATE TABLE Answer '.'(fldAnswerNumber PRIMARY KEY, 
													fldAnswerText TEXT NOT NULL, 
													fldTimesPicked INTEGER DEFAULT 0,
													FOREIGN KEY (fldQuestionNumber) REFERENCES Question(fldQuestionNumber) )');
		if ($DEBUG && $cta){
			echo "table Answer hadn't been made, but I got it.</br>";
		} else {
			if ($DEBUG){echo "Something went wrong with Answer table creation";}
		}
	}

	function addAnswer($db, $questionNumber, $answerText){
		$db->queryExec('INSERT into Answer VALUES (null,$answerText,0,$questionNumber)');
	}

	function deleteQuestion($db, $qn){ #delete a question, also follow and delete answers. 

	}

	function renameItem($db, $table, $oldText, $newText){ //update old name to new name. Can be question or ans
		switch ($table) {
			case 'value':
				
				$db -> queryExec('UPDATE Answer SET fldAnswerText="'.$newText.'" WHERE fldAnswerText="'.$oldText.'";' );
				break;

			case 'value':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}

	function addQuestion($db, $qtext, $refIn=null, $redirect=null){
		$db->queryExec('INSERT into Question VALUES (null,$refIn,$redirect,$qtext)'); 
	}
			//} else { die($err); } // /if db	}
			//select last_insert_rowid();