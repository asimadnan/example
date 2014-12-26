<?php
include 'core/init.php';
protect_page();
include 'include/overall/header.php';


if (empty($_POST) === false){
	$required_fields = array('title', 'description', 'release_year', 'language_id', 'length','rating');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key,$required_fields) === true ){
			$errors[] = 'Fields marked with a * are required.';
			break 1;
		}
	}
	
	if(empty($errors) === true) {
		if (film_exists($_POST['title']) === true) {
			$errors[] = 'Sorry The title \''.htmlentities($_POST['title']) .'\' is already in database' ;
		}
	}
}

?>



<h1>Add Movie</h1>

<?php 
 if (isset($_GET['success']) && empty($_GET['success'])) {
	echo 'Film Added successfully';
} else {
	
			if(empty($_POST) === false && empty($errors) === true) {
				$film_data = array(
				'title' 			=> $_POST['title'],
				'description' 		=> $_POST['description'],
				'release_year' 		=> $_POST['release_year'],
				'language_id' 		=> $_POST['language_id'],
				'length' 			=> $_POST['length'],
				'rating' 			=> $_POST['rating']
				);
				
				//add_rating($session_user_id,$_POST['title'],$_POST['user_rating']);
				add_film($film_data);
				header('Location: addfilm.php?success');
				exit();
			}
			else if (empty($errors) === false) {
				echo output_errors($errors);
			}
		
?>


<form action="" method="post">
	<ul>
		<li>
			Title*:<br>
			<input type="text" name="title">
		</li>
		<li>
			Description*:<br>
			<input type="text" name="description">
		</li>
		<li>
			Release year*:<br>
			<input type="date" name="release_year">
		</li>
		<li>
			Language*:<br>
				<select name="language_id">
					<option value="English">English</option>
					<option value="French">French</option>
					<option value="Spanish">Spanish</option>
					<option value="Hindi">Hindi</option>
					<option value="Dutch">Dutch</option>
					<option value="Persian">Persian</option>
				</select>
		</li>
		<li>
			Length*:<br>
			<input type="text" name="length">
		</li>
		<li>
			Rate The Movie*:<br>
			<select name="user_Rating">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select>
		</li>
		<li>
			Rating*:<br> 
			<select name="rating">
					<option value="G">G</option>
					<option value="PG">PG</option>
					<option value="PG-13">PG-13</option>
					<option value="R">R</option>
					<option value="NC-17">NC-17</option>
				</select>
		</li>
		<li>
			<input type="submit" value="Add Movie">
		</li>
	
	</ul>
</form> 


<?php } include 'include/overall/footer.php'; ?>   