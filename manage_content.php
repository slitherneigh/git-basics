
<?php 
	 $dbhost = "localhost";
	 $dbuser = "widget_cms"	 ;
	 $dbpass = "NeaHydra83";
	 $dbname = "widget_corp";
	 $connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	 if (mysqli_connect_errno()) {
	 	die("Database connection failed: " . 
	 		mysqli_connect_error() . 
	 		" (" . mysqli_connect_errno() . ")"
	 		);

	 }
?>
<?php 
	include("../includes/functions.php");
?>
<?php 
	 $query = "SELECT * ";
	 $query .= "FROM subjects"; 
	 $subject_set = mysqli_query($connection, $query);
	 if (!$subject_set) {
	 	die("Data query failed");
	 }

?>
<?php	
	include("../includes/layouts/header.php");

?>
	<div id="main">
		<div id="navigation">
		<ul>
		<?php 
	 		while ($subject = mysqli_fetch_assoc($subject_set)) {
	 	?>
	 		<li>
	 		<?php 
	 		 echo $subject["menu_name"]  . "<br />";
	 		?>
	 		<?php 
	 			$query = "SELECT * ";
	 			$query .= "FROM pages ";
	 			$query .= "WHERE visible = 1 ";
	 			$query .= "AND subject_id = {$subject["id"]} ";
	 			$query .= "ORDER BY position ASC"; 
				$page_set = mysqli_query($connection, $query);
	 			if (!$page_set) {
	 			die("Data query failed");
	 			}

			?>	
	 		<ul class="pages">
	 			<?php 
	 		while ($page = mysqli_fetch_assoc($page_set)) {
	 		?>
	 		<li><?php echo $page["menu_name"]  . "<br />";?></li>
	 		<?php 
	 				 }
	 			?>	
	 		</ul>
	 		</li>
	 		<?php 
	 			 }
	 		?>
	 		<?php 
	 			mysqli_free_result($page_set);
			?>	
	 	</ul>
		</div>
		<div id="page">
			<h2>Admin Menu</h2>
			<p>Welcome to the admin area.</p>
			
			<ul>
				<li><a href="manage_content.php">
				Manage Website Content</a></li>
				<li><a href="manage_admins.php">
				Manage Admin Users</a></li>
				<li><a href="logout.php">
				Logout</a></li>
			</ul>
		</div>		
	</div>
	<?php 
	 mysqli_free_result($subject_set);
	?>
	<?php 
	 include("../includes/layouts/footer.php");
	 ?>
	 <?php 
	 mysqli_close($connection);
	 ?>
