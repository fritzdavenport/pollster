<!-- Displays results of Question and Answer tables -->

<table>
<?php 
	$q = getQuestions($db); 
	while ( $qArr = $q->fetchArray() ){
		$a = getAnswers($db, $qArr["fldQuestionNumber"]); 
		echo "<tr><td>Question ".
					$qArr["fldQuestionNumber"]
				.":</td><td>".
					$qArr["fldQuestionText"]
				."</td></tr>";
				// link to question
				//link to referer
		while ( $aArr = $a->fetchArray() ){
			echo "<tr><td></td><td class='answer'>Answer ".
					$aArr["fldAnswerNumber"]
				.":</td><td>".
					$aArr["fldAnswerText"]
				."</td><td class='picked'>Times Picked: ".
					$aArr["fldTimesPicked"]  
				."</td></tr>";
		}
	}
?>
</table>