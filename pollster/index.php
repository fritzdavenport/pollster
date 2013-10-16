<? ?>
<!--main.php -->
<html>
	<head>
		<?
			//TODO: php form via text config file, put TEXT into DB if not already
			//jquery load(results)

		?>
	</head>
	<body>
		<form action="./formprocess.php" method="get">
			<p>
				<INPUT TYPE=hidden name="fQN" VALUE="1">
				<INPUT TYPE=RADIO NAME="fAN" VALUE="0">tiny<BR>
				<INPUT TYPE=RADIO NAME="fAN" VALUE="1">small<BR>
				<INPUT TYPE=RADIO NAME="fAN" VALUE="2" checked>medium<BR>
				<INPUT TYPE=RADIO NAME="fAN" VALUE="3">large
			</p>
			<INPUT TYPE=SUBMIT VALUE="submit">
		</form>
	</body>
</html>