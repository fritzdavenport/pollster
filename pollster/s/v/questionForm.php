<form action=<?php echo '"'.$_SERVER['PHP_SELF'].'"'; ?> method="post">
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
</form>