<!-- a view to display table results of selected Question Number -->
<form>
	<table>
		<?php
			$answers = getAnswerArray($db, $questionNumber);
			debug($answers);
			foreach ($answers as $number => $array) {
				echo "<tr>".
				"<td>Answer: ".$array["fldAnswerText"]."</td>
				<td>".$array["fldTimesPicked"]."</td>".
				"</tr>"; //Array with fldAnswerText fldTimesPicked
			}
		?>
	</table>
</form>