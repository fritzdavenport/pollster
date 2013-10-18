<form action=<?php echo '"'.$_SERVER['PHP_SELF'].'"'; ?> method="post">
	<p>
		<input type=hidden name="fldQuestionNumber" value=<? echo '"'.$qn.'"'; ?> >
		<INPUT TYPE="text" name="fldQuestionText" placeholder="Please input question text">
		<SELECT name="numAnswers">
		<? 	for ($i=2; $i < 10; $i++) { 3?> 
			<OPTION <? if ($i == 4){ echo "selected"; }?> > <? echo $i ?> </OPTION>
		<? } ?>
		</SELECT> How many answers will it have?
	</p>
	<INPUT TYPE=SUBMIT VALUE="submit">
</form>