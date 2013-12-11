<!-- a view to display table results of selected Question Number -->
	<table id="tblAnswers">
		<?php
			echo "<thead>";
				echo "<tr>";
					foreach (array_keys($answersList) as $key) {
						echo "<th scope='col'>".$key."</th>";
					}
				echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
				echo "<tr>";
					foreach ($answersList as $value) {
						echo "<td>".$value."</td>";
					}
				echo "</tr>";
			echo "</tbody>";
		?>
	</table>