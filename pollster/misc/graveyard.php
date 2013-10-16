graveyard.php

if (! (ifExists($database, 'Answer')) ){  			}
function ifExists($db, $name){ //check if the table exists already. 
				return $db->queryExec("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='".$name."';", $error);
			}
			



		function dbQuery($database, $query){ //shortcut function for executing queries into the database. 
				if ($DEBUG) echo $query;

				try {
					$ret = $database->queryExec($query, $error);
				} catch (Exception $e) {
					if ($DEBUG) echo "$e";
				}
				return $ret;
			}


			//dbQuery($database, 'CREATE TABLE Question '.'(QuestionNumber INTEGER PRIMARY KEY, 
			//												QuestionText TEXT NOT NULL)'); //TABLE NAME, VARIABLES

			//dbQuery($database, 'CREATE TABLE Answer '.'(QuestionNumber INTEGER NOT NULL, 
															// AnswerNumber PRIMARY KEY, 
															// AnswerText TEXT NOT NULL, 
															// TimesPicked INTEGER DEFAULT 0,
															// FOREIGN KEY(QuestionNumber) REFERENCES Question(QuestionNumber) )');







			try {
				$database->queryExec(
			} catch (Exception $e) {
				echo "";
			}

			$database->queryExec('CREATE TABLE Answer '.'(QuestionNumber INTEGER NOT NULL, 
															AnswerNumber PRIMARY KEY, 
															AnswerText TEXT NOT NULL, 
															TimesPicked INTEGER DEFAULT 0,
															FOREIGN KEY(QuestionNumber) REFERENCES Question(QuestionNumber) )',
															$error);

			// Get and show inputted data
			$tableArray = $database->arrayQuery("SELECT * FROM Answer;"); //testing... trying to see if table was blank
			print_r($tableArray);

			$database->queryExec("SELECT * FROM Question;", $error );
			$database->queryExec("UPDATE Answer SET TimesPicked = TimesPicked + 1 WHERE AnswerNumber='".$fAN."';"); //incrementDB 
				//IMPLEMENTATION,