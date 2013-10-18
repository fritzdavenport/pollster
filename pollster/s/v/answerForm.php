<form action= <?php echo '"'.$_SERVER['PHP_SELF'].'"'; ?> method="post">
	<? if ( $_POST['numAnswers'] && $_POST['fldQuestionNumber'] ){ //if it has a number of answers and a question number to give the answers to
			for($i=0; $i>$_POST['numAnswers']; $i++){ 
	?>
				<p>Answer <? echo $i ?>
				<input type="text" name="fldAnswer" placeholder=<? echo "'Answer ".$i."'"; ?> >
				</p>
	<?		} 
		} 
	?>
				<INPUT TYPE=SUBMIT VALUE="submit">
</form>