<!-- Displays results of Question and Answer tables -->

<table>
<?php 
	$q = @$db->query('SELECT * FROM Question'); 
	while ( $qArr = $q->fetchArray() ){
		$a = @$db->query(' SELECT * FROM Answer WHERE fldQuestionNumber='.$qArr["fldQuestionNumber"].';'); 
		echo "<tr><td>Question ".
					$qArr["fldQuestionNumber"]
				.":</td><td>".
					$qArr["fldQuestionText"]
				."</td></tr>";
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