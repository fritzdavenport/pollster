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
				."</td>"."<td>".
					"<input READONLY type='text' value='".$rootLoc."/index.php?qn=".$qArr["fldQuestionNumber"]."' />"
				."</td><td>Redirect: <input READONLY type='text' value='".($qArr['fldRedirect']!="null"?$qArr["fldRedirect"]:"Not Set")."' />"
				."</td></tr>";
				// link to question
				//link to redirect
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