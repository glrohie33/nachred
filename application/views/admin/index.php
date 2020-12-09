<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nachred Admin Section</title>
	<?php
	include 'head.php';
	?>
</head>

<body class="sidebar-menu-collapsed">

	<div id="wrapper">
		<?php include 'header.php' ?>
		<div class="main">

			<!-- content -->
			<?php include "$page_name.php"; ?>
			<!-- //content -->
		</div>
		<!-- main content end-->
	</div>
	<!--footer section start-->
	<?php include "footer.php" ?>
	<!--footer section end-->
	<!-- move top -->

</body>

</html>
