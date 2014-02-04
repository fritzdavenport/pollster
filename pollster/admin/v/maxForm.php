<form id="maxForm" action=<?php echo "'".$_SERVER['PHP_SELF']."'"; ?> method="post">
		<p>Input a class size or 'val'
			<input type=hidden name="s" value="max">
			<input name="maxVal" value=<?php echo "'".getMax($db)."'"; ?> />
			<INPUT TYPE=SUBMIT VALUE="submit">
		</p>
</form>