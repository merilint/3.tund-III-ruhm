
<h2>Menüü</h2>
<ul>
<?php if ($page_file_name == "home.php") { ?>
	<li>
		Home
	</li>
<?php } else { ?>	
	<li>
		<a href="home.php">Home</a>
	</li>
	<?php } ?>

<?php 	
		if ($page_file_name == "login.php") {
				echo '<li>login</li>';
			} else {
				echo '<li><a href="login.php">login</a></li>';
		}
?>
</ul>