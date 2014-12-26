<div class="widget">
	<h2>Hello, <?php echo get_name($_SESSION['user_id']); ?>!!</h2>
	<div class="inner">
		
		<ul>
		<li>
		<a href="logout.php" >Logout</a>
		</li>
		
		<li>
		<a href="changepassword.php">Change Password</a>
		</li>
		</ul>
	</div>
</div>