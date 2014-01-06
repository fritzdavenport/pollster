<?php
// dbFunctions.php includes 
// checkQuestionsTable in: database object, returns: T/F if table exists
// createQuestionsTable in: database object, returns: none. status msg on debug. 
// addQuestion: in: database object, question text. returns: question number.


// checkAnswerTable in: database object, returns: T/F if table exists
// createAnswerTable in: database object, returns: none. status msg on debug. 
// addAnswer: in: database object, question number, answer text. returns: answer number.


	function readCSV($csvFile){
		$fp = fopen($csvFile, 'r');
		$line_of_text = fgetcsv($fp, 1024);
		// while (!feof($fp) ) {
		// 	$line_of_text[] = fgetcsv($fp, 1024);
		// }
		fclose($fp);
		return $line_of_text;
	}

	function writeCSV($csvFile, $array){ //
		$fp = fopen($csvFile, 'w');
		fputcsv($fp, $array);
		fclose($fp);
	}

	function checkQuestionTable ($db){
		$q = @$db->query('SELECT * FROM Question'); 
		return $q === false; 
	}

	function createQuestionTable ($db){
		$qta = $db->exec('CREATE TABLE Question '.'(fldQuestionNumber INTEGER PRIMARY KEY, fldQuestionText TEXT NOT NULL, fldRedirect TEXT);');
		if ($qta){ debug("table Question hadn't been made, but I got it.</br>");
		} else { debug("Something went wrong with Question table creation"); 
		}	
	}


	function addQuestion($db, $qtext, $redirect="null"){//ques fldQuestionNumber, fldQuestionText, fldRefIn, fldRedirect
		$db->exec('INSERT into Question VALUES (null, "'.$qtext.'", "'.$redirect.'");'); 
		$result = $db -> query("SELECT last_insert_rowid() FROM Question");
		$rArr = $result -> fetchArray();
		debug("INSERT ID: ".$rArr[0]);
		return $rArr[0];
	}


	function getQuestions($db, $questionNumber='*'){ //defaults to return all question, one if specified.
		 $qs = @$db->query('SELECT '.$questionNumber.' FROM Question');
		 return $qs;
	}
	
	function getAnswers($db, $questionNumber, $answerNumber="*"){
		$as = @$db->query(' SELECT '.$answerNumber.' FROM Answer WHERE fldQuestionNumber='.$questionNumber.';');
		return $as;
	}

	function checkAnswerTable ($db){
		$p = @$db->query('SELECT * FROM Answer'); //test if number is within range
		return $p === false; 
	}

	function createAnswerTable($db){ //ans AnsNumber, QNumber, AnsText, TimesPicked
		$cta = $db->exec('CREATE TABLE Answer '.'(	fldAnswerNumber INTEGER PRIMARY KEY,fldQuestionNumber INTEGER,fldAnswerText TEXT NOT NULL, fldTimesPicked INTEGER DEFAULT 0,FOREIGN KEY (fldQuestionNumber) REFERENCES Question(fldQuestionNumber) ON DELETE CASCADE );');
		if ($cta){ debug("table Answer hadn't been made, but I got it.</br>");
		} else { debug("Something went wrong with Answer table creation"); 
		}
	}

	function addAnswer($db, $questionNumber, $answerText){
		$db->exec('INSERT into Answer VALUES (null,"'.$questionNumber.'","'.$answerText.'",0)');
	}

//ans fldAnswerNumber, fldQuestionNumber, fldAnswerText, fldTimesPicked   
//ques fldQuestionNumber, fldQuestionText, fldRefIn, fldRedirect

	function deleteQuestion($db, $questionNumber){ #delete a question, also follow and delete answers. 
		$db->exec('DELETE FROM Answer WHERE fldQuestionNumber='.$questionNumber.' AND fldAnswerNumber='.$ans.';');
	}

	function deleteTables($db){ #delete a question, also follow and delete answers. 
		$db->exec('DROP TABLE Question;');
		$db->exec('DROP TABLE Answer;');
	}

	function renameItem($db, $table, $oldText, $newText){ //update old name to new name. Can be question or ans
		switch ($table) {
			case 'value':
				
				$db -> exec('UPDATE Answer SET fldAnswerText="'.$newText.'" WHERE fldAnswerText="'.$oldText.'";' );
				break;

			case 'value':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}
?>