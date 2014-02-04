<!-- a view to display table results of selected Question Number -->
	<span id="classSize" style="display:none"><?php echo getMax($db);//getClassSize(); ?></span>
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
	<p id="desc">
		<?php 
			if (!!$questionDescription && !($questionDescription == 'null')){ 
				echo $questionDescription;
			} else { 
				echo "<span style='display:none;'>no description set</span>";
			}
		?>
	</p>