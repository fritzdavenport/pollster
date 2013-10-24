		<!-- Main view to ask question -->
		<form action=<?php echo "'".$_SERVER['PHP_SELF']."'"; ?> method="post">
			<?php 
				$a = @$db->query('SELECT * FROM Answer WHERE fldQuestionNumber="'.$questionNumber.'";'); //"'.$questionNumber.'"
				echo "<input type=hidden name='fldQuestionNumber' value='".$questionNumber."'>";
				while( $aArr = $a->fetchArray() ){
					echo $aArr["fldAnswerText"]." <input type='radio' name='fldAnswerNumber' value='".$aArr["fldAnswerNumber"]."'>";
				}
			?>
			<INPUT TYPE=SUBMIT VALUE="submit">
		</form>