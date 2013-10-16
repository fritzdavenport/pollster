<!--formprocess.php -->
<!-- recieves results from main.php and posts into db -->
<!-- redirects to post.php upon success -->
<html> 
	<head>
		<?php //DO ALL THIS STUFF IF THEY DONT HAVE A COOKIE. GIVE THEM A COOKIE AFTER
			$DEBUG = true; 
			if ($DEBUG) print_r($_GET);	echo "</br>";

			if ($db = new SQLiteDatabase('record')) {
				$q = @$db->query('SELECT * FROM Question WHERE QuestionNumber = '.$_GET["fQN"]); //test if number is within range
				if ($q === false) {
					$q = @$db->query('SELECT * FROM Question'); // and the table exists
					if ($q === false) { //table didn't exist
						$qta = $db->queryExec('CREATE TABLE Question '.'(QuestionNumber INTEGER PRIMARY KEY, 
															QuestionText TEXT NOT NULL)');
						if ($DEBUG && $qta){echo "table Question hadn't been made, but I got it.</br>";} else {if ($DEBUG){echo "Something went wrong with table creation";}}
						if ($DEBUG){ $db->queryExec('INSERT into Question (QuestionText) VALUES ("This is an example")'); }
					} else { //table did exist. Q# is out of range. 
						$dnr = 1;
						if ($DEBUG){echo "Value for QuestionNumber was out of range</br>";}
					}
				} else { if ($DEBUG){echo "table Question was made previously.</br>";} } // end if table wasn't made or qn non-existant

				$p = @$db->query('SELECT * FROM Answer WHERE AnswerNumber = '.$_GET["fAN"]); //test if number is within range
				if ($p === false) {
					$p = @$db->query('SELECT * FROM Answer');//test if the table exists
					if ($p === false) {
						$cta = $db->queryExec('CREATE TABLE Answer '.'(AnswerNumber PRIMARY KEY, 
															AnswerText TEXT NOT NULL, 
															TimesPicked INTEGER DEFAULT 0,
															QuestionNumber INTEGER,
															FOREIGN KEY (QuestionNumber) REFERENCES Question(QuestionNumber) )');
						if ($DEBUG){ $db->queryExec('INSERT into Answer VALUES (0,"Example",0,1)'); }
						if ($DEBUG && $cta){echo "table Answer hadn't been made, but I got it.</br>";} else {if ($DEBUG){echo "Something went wrong with table creation";}}
						} else { //table did exist. Q# is out of range. 
							$dnr = 1;							
							if ($DEBUG){echo "Value for AnswerNumber was out of range</br>";}
						}
				} else { if ($DEBUG){echo "table Answer was made previously.</br>";} } // /if q=false and else

				//everything has been setup. We execute some code here now. AKA normal runtime.
				if (!$dnr) $db->queryExec("UPDATE Answer SET TimesPicked = TimesPicked +1 
											WHERE QuestionNumber = ".$_GET['fQN'] ."
											AND AnswerNumber=".$_GET['fAN'].";"); //if not "do not run" (question number or answer number out of range)
					$result = $db->query("SELECT * FROM Answer", SQLITE_ASSOC);
					$resultArr = $result->FetchAll();
					print_r($resultArr);

			} else { die($err); } // /if db
			//if it gets here, something was wrong with setting up the initial database in the folder. 
			//Check file permissions? Folder permissions??
		?>
	</head>
	<body>
		<? if ($DEBUG) { ?>
			<p>Everythings working so far!</p>
		<? } ?>
	</body>
</html>