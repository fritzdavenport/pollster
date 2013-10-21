		<!-- TODO: check cookie, 
		check post to get question number, 
		check referrer for question number 
		A doesn't have ans numbers-->
		<h1><?php echo $questionText ?></h1>
		<form action=<?php echo "'".$_SERVER['PHP_SELF']."'"; ?> method="post">
			<?php 
				$a = @$db->query('SELECT * FROM Answer WHERE fldQuestionNumber=1;'); //"'.$questionNumber.'"

				echo "<input type=hidden name='fldQuestionNumber' value='".$questionNumber."'>";
				while( $aArr = $a->fetchArray() ){
					echo $aArr["fldAnswerText"]." <input type='radio' name='fldAnswerNumber' value='".$aArr["fldAnswerNumber"]."'>";
				}
			?>
			<INPUT TYPE=SUBMIT VALUE="submit">
		</form>