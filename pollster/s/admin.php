<!-- script to initialize and maintain db. No MVC, Only for initializing and adding/deleting -->
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Control Panel for Online Poll</title>
		<? $DEBUG = true; 
			if ($DEBUG) print_r($_POST); //[REMOTE_USER] => cdavenp1 [WEBAUTH_USER] => cdavenp1 

			if ($db = new SQLiteDatabase('../record')) { //check if database exists, can encounter problem if pollster isn't RW for group.
				$q = @$db->query('SELECT * FROM Question'); //if table doesn't exist
				if ($q === false) {
						$qta = $db->queryExec('CREATE TABLE Question '.'(fldQuestionNumber INTEGER PRIMARY KEY, 
															fldRefIn TEXT,
															fldRedirect TEXT,
															fldQuestionText TEXT NOT NULL)');
						if ($DEBUG && $qta){echo "table Question hadn't been made, but I got it.</br>";} else {if ($DEBUG){echo "Something went wrong with table creation";}}
						//if ($DEBUG){ $db->queryExec('INSERT into Question (QuestionText) VALUES ("This is an example")'); }
						$qn = 0; 
				} else { if ($DEBUG){echo "table Question was made previously.</br>";} } 

				$p = @$db->query('SELECT * FROM Answer'); //test if number is within range
				if ($p === false) {
					$cta = $db->queryExec('CREATE TABLE Answer '.'(fldAnswerNumber PRIMARY KEY, 
																fldAnswerText TEXT NOT NULL, 
																fldTimesPicked INTEGER DEFAULT 0,
																fldQuestionNumber INTEGER,
																FOREIGN KEY (fldQuestionNumber) REFERENCES Question(fldQuestionNumber) )');
					//if ($DEBUG){ $db->queryExec('INSERT into Answer VALUES (0,"Example",0,1)'); }
					if ($DEBUG && $cta){echo "table Answer hadn't been made, but I got it.</br>";} else {if ($DEBUG){echo "Something went wrong with table creation";}}
				} else { if ($DEBUG){echo "table Answer was made previously.</br>";} }
			} else { die($err); } // /if db
			//if it gets to this else, something was wrong with setting up the initial database in the folder. 
			
		?>
	</head>
	<body>
		<form action=<?php echo '"'.$_SERVER['PHP_SELF'].'"'; ?> method="post">
			<? if (! ($_POST["numAnswers"]) ){ echo "string"; //if no information was posted to the page 
			?> 
				<p>
					<input type=hidden name="fldQuestionNumber" value=<? echo '"'.$qn.'"'; ?> >
					<INPUT TYPE="text" name="fldQuestionText" placeholder="Please input question text">
					<SELECT name="numAnswers">
						<OPTION>2</OPTION>
						<OPTION>3</OPTION>
						<OPTION selected>4</OPTION>
						<OPTION>5</OPTION>
						<OPTION>6</OPTION>
						<OPTION>7</OPTION>
						<OPTION>8</OPTION>
						<OPTION>9</OPTION>
					</SELECT> How many answers will it have?
				</p>
				<INPUT TYPE=SUBMIT VALUE="submit">
			<? } else { 
				if ( $_POST['numAnswers'] && $_POST['fldQuestionNumber'] ){ //if it has a number of answers and a question number to give the answers to
					for($i=0; $i>$_POST['numAnswers']; $i++){ 
			?>
						<p>WORDS!
						<input type="text" name="fldAnswer" placeholder=<? echo "Answer ".$i; ?> >
						</p>
			<?		}
				} 
			} 
			?>
		</form>
	</body>
</html>