<!-- Displays results of Question and Answer tables -->
<table>
<?php 
	$q = @$db->query('SELECT * FROM Question'); 
	while ( $qArr = $q->fetchArray() ){
		$a = @$db->query(' SELECT * FROM Answer WHERE fldQuestionNumber='.$qArr["fldQuestionNumber"].';'); 
		echo "<tr><td>Question Number:".
					$qArr["fldQuestionNumber"]
				."</td><td>".
					$qArr["fldQuestionText"]
				."</td></tr>";
		while ( $aArr = $a->fetchArray() ){
			echo "<tr><td></td><td>Answer: ".
					$aArr["fldAnswerText"]
				."</td><td>Times Picked".
					$aArr["fldTimesPicked"]
				."</td></tr>";
		}

	}
	echo "out";
	// foreach ($qArr as $key => $value) {
	// 	debug($key);
	// 	debug($value);
	// }
	echo "<tr><td>";

	echo "</td></tr>";

?>
</table>