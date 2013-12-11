<form action= <?php echo '"'.$_SERVER['PHP_SELF'].'"'; ?> method="post">
	<?php if ( $_POST['numAnswers'] && $_POST['fldQuestionText'] ){ //if it has a number of answers and a question number to give the answers to
			echo "<p>Question Text: ".$_POST['fldQuestionText']."</p>";
			for($i=0; $i<$_POST['numAnswers']; $i++){ 
				$humanReadable = $i + 1;
				echo "Answer ";
				echo '<input type="text" name="fldAnswer'.$i.'" placeholder="Answer '.$humanReadable.'">';
				echo "</p>";

			} // /for
		} // /if
	?>
				<input type=hidden name="s" value="sub" >
				<input type=hidden name="fldQuestionNumber" value=<?php echo $qn; ?> >
				<INPUT TYPE=SUBMIT VALUE="submit">
</form>