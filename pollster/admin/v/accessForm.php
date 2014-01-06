<form id="accessForm" action=<?php echo "'".$_SERVER['PHP_SELF']."'"; ?> method="post">
		<p>Admin NetID's
			<input type=hidden name="s" value="adm">
			<input name="accessList" value=<?php echo "'".implode(",", $accessList)."'"; ?> />
			<INPUT TYPE=SUBMIT VALUE="submit">
		</p>
</form>