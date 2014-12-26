<?php 
include 'core/init.php';
include 'include/overall/header.php';

?>
<h1>Internet Movie Database</h1>

<?php
if (isset($_SESSION['user_id']))
{
	echo   "Logged in<br>";
	
}
else
{
	echo  "<b><i><u>Not logged in</u></i></b>";
}

	//search_film ('the');


	if (isset($_GET['id'])){
		movie_detail( $_GET['id']);
		
	if(!isRated($_GET['id'])){ 
				?>
				
				<form action="" method="post">
				<ul>
				<li>
					Rate Movie :
					<input type="number" min="0" max="10" name="rating"> 
				</li>
				<li>
					<input type="submit" value="Rate">
				</li>
				</ul>
				</form>
				
				<?php
				
	if(isset($_POST['rating'])){
			
			add_rating_film_id($_SESSION['user_id'],$_GET['id'],$_POST['rating']);
			}
			
			}
			}
			
			
	

?>


<?php include 'include/overall/footer.php'; ?>   