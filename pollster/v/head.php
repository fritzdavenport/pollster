<!DOCTYPE html>
<html lang="en">
	<head>
		<?php if (@$redirectURL) print '<meta http-equiv="REFRESH" content="0;url="'.$redirectURL.'">'; ?>
		<meta charset="utf-8">
		<meta name="author" content="Fritz Davenport">
		<meta name="description" content="<?php echo $pageDesc; ?>" >
		<title>Admin Control Panel for Online Poll</title> <!-- if https, get directory one less. if http, get curr directory -->
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<!-- conditional script statement -->
		<link rel="stylesheet" href=<?php echo $rootLoc."/mainstyle.css"; ?> type="text/css" media="screen">
		<!--[if lt IE 9]> 
			<script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
		<![endif] --> <!-- cond. comment - HTML5 shim for older browsers -->
	</head>
	<body>