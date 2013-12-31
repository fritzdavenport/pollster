<form id="createQuestions" action=<?php echo "'".$_SERVER['PHP_SELF']."'"; ?> method="post">
	<p>
		<input type=hidden name="s" value="ans">
		<INPUT TYPE="text" name="fldQuestionText" placeholder="New Question Text">  
	</p>
	<p>
		<SELECT name="numAnswers">
		<?php 	for ($i=2; $i < 10; $i++) {  
			echo "<OPTION ";
			if ($i == 4) echo "selected";
			echo "value='".$i."'>".$i." Answers</OPTION>";
		} ?>
		</SELECT> 
	</p>
	<INPUT TYPE=SUBMIT VALUE="submit">
</form>	