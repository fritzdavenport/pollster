<!DOCTYPE html>
<html lang="en">
	<head>
		<?php if (@$redirectURL) print '<meta http-equiv="REFRESH" content="0;url="'.$redirectURL.'">'; ?>
		<meta charset="utf-8">
		<meta name="author" content="Fritz Davenport">
		<meta name="description" content="<?php echo $pageDesc; ?>" >
		<title>Admin Control Panel for Online Poll</title> <!-- if https, get directory one less. if http, get curr directory -->
		<link rel="stylesheet" href=<?php echo ((@$_SERVER["HTTPS"])?'https://':'http://').$_SERVER['SERVER_NAME'].explode("/s",$_SERVER["PHP_SELF"])["0"]."/mainstyle.css"; ?> type="text/css" media="screen">
		<!--[if lt IE 9]> 
			<script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
		<![endif] --> <!-- cond. comment - HTML5 shim for older browsers -->
	</head>
	<body>
		