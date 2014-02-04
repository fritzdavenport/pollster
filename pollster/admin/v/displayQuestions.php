<!-- Displays results of Question and Answer tables -->

<table id="displayQuestions">
<?php 
	$q = getQuestions($db); 
	while ( $qArr = $q->fetchArray() ){
		$a = getAnswers($db, $qArr["fldQuestionNumber"]); 
		echo "<tr class='question'><th scope='row'>Question ".
					$qArr["fldQuestionNumber"]
				."</th><td>".
					'"'.$qArr["fldQuestionText"].'"'
				."</td>"."<td>".
					"<a href='".$rootLoc."/question".$qArr["fldQuestionNumber"]."'>Link</a>"
				."</td><td>"
				."<form id='desc' action='".$_SERVER['PHP_SELF']."' method='post' >"
					."Description: <INPUT TYPE=SUBMIT VALUE='submit' /><br>"
					."<input type=hidden name='s' value='desc' />"
					."<input type=hidden name='qn' value='".$qArr["fldQuestionNumber"]."' />"
					."<textarea name='fldDescription' >"
						.($qArr['fldDescription']!="null" ? $qArr["fldDescription"]:"Not Set")
					."</textarea>"
				."</form>"
				."</td></tr>";
		while ( $aArr = $a->fetchArray() ){
			echo "<tr class='answer'><th scope='row' class='answer'>Answer ".
					$aArr["fldAnswerNumber"]
				."</th><td>".
					'"'.$aArr["fldAnswerText"].'"'
				."</td><td></td><td class='picked'>Times Picked: ".
					$aArr["fldTimesPicked"]  
				."</td></tr>";
		}
	}
?>
</table>