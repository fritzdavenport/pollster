<!DOCTYPE html>
<html lang="en">
	<head>
		<?php if (@$redirectURL) print '<meta http-equiv="REFRESH" content="0;url="'.$redirectURL.'">'; ?>
		<meta charset="utf-8">
		<meta name="author" content="Fritz Davenport">
		<meta name="description" content=<?php echo '"'.$pageDesc.'"'; ?> />
		<title>Live Survey</title>
		<link rel="stylesheet" href=<?php echo $rootLoc."/mainstyle.css"; ?> type="text/css" media="screen">
		<title>Test Page for Jquery</title>
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script>if (typeof jQuery == 'undefined'){document.write(unescape("%3Cscript src='../js/jquery-2.0.2.min.js' type='text/javascript'%3E%3C/script%3E"));}</script>
		<?php if ( isset($_GET["qn"]) ) echo "<script src='".$rootLoc."/js/question.js'></script>" ?>
		<!--[if lt IE 9]>
		    <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
		<![endif] --> <!-- cond. comment - HTML5 shim for older browsers -->
	</head>
	<body>