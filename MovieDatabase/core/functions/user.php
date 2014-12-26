<?php
	function film_exists($title){
		$title = sanitize($title); 
		$query = mysql_query("SELECT * FROM film WHERE title = '". $title ."'"); 
		return (mysql_num_rows($query) > 0) ? true:false; 
	}
	
//	function search_film($title){
		
	//	$query = mysql_query ("SELECT title FROM film WHERE title LIKE %.$title.%")
//	}
	function add_film($film_data){
		array_walk($film_data,'array_sanitize');
		
		$fields = '`'.implode('`,`',array_keys($film_data)).'`';
		$data = '\''.implode('\',\'',$film_data).'\'';
		
		$query = mysql_query("INSERT INTO `film` ($fields) VALUES ($data)");
		
					
	}


	function change_password($user_id,$password){
		$user_id = (int)$user_id;
		$password = md5($password);

		mysql_query("UPDATE `users` SET `password` = '$password' WHERE `user_id` = $user_id");
	}

	function register_user($register_data){
		array_walk($register_data,'array_sanitize');
		$register_data['password'] = md5($register_data['password']);
		
		$fields = '`'.implode('`,`',array_keys($register_data)).'`';
		$data = '\''.implode('\',\'',$register_data).'\'';
	
		mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
	}
	
	
	function user_count() {
		return mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `active` = 1"),0);
	}
	
	function user_data($user_id){
		$data = array();
		$user_id = (int)$user_id;
		$func_num_args = func_num_args();
		$func_get_args = func_get_args();
		
		if ($func_num_args > 1){
				unset($func_get_args[0]);
				
				$fields = '`'.implode('`,`',$func_get_args).'`';
				$data = mysql_fetch_assoc( mysql_query("SELECT $fields FROM `users` WHERE `user_id` = '". $user_id ."'"));
				
				return $data;
		}
		
	}
	
	function get_name($user_id){
		
		return mysql_result(mysql_query("SELECT `first_name` FROM `users` WHERE `user_id` = '". $user_id ."'"),0,'first_name');
	
	}
	
	function add_rating($userid,$title,$rating){
		
		$query1 = mysql_query("SELECT `film_id` FROM `film` WHERE `title` = '". $title ."'");
		$filmid = mysql_result($query1,0);
		//echo $filmid;
		$query = mysql_query("INSERT INTO `rating`  (`film_id` ,`user_id` ,`user_rating`) VALUES ('". $filmid ."','". $userid ."','". $rating ."') ");
		
	}
		
		function add_rating_film_id($userid,$filmid,$rating){
		
		$query = mysql_query("INSERT INTO `rating`  (`film_id` ,`user_id` ,`user_rating`) VALUES ('". $filmid ."','". $userid ."','". $rating ."') ");
		
	}

	function logged_in(){
		return (isset($_SESSION['user_id'])) ? true : false ;
	}

	function user_exists($username){
		$username = sanitize($username); 
		$query = mysql_query("SELECT * FROM users WHERE username = '". $username ."'"); 
		return (mysql_num_rows($query) > 0) ? true:false; 
	}
	
	function email_exists($email){
		$username = sanitize($email); 
		$query = mysql_query("SELECT * FROM users WHERE email = '". $email ."'"); 
		return (mysql_num_rows($query) > 0) ? true:false; 
	}
	
	function user_active($username){
		$username = sanitize($username); 
		$query = mysql_query("SELECT * FROM users WHERE username = '". $username ."' AND active = 1"); 
		return (mysql_num_rows($query) > 0) ? true:false; 
	}
	
	function user_id_from_username($username){
		$username = sanitize($username);
		return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'"),0,'user_id');
	}
	
	function login($username,$password){
		$user_id = user_id_from_username($username);
		$username = sanitize($username);
		$password = md5($password);
		
		$query = mysql_query("SELECT * FROM users WHERE username = '". $username ."' AND password = '". $password ."'");
		return (mysql_num_rows($query) > 0) ? $user_id : false;
		
	}
	
	function view_films(){
		
		$query = mysql_query("SELECT `film_id`, `title` FROM `film` LIMIT 0, 30 ");
		 while($rows = mysql_fetch_array($query)) {

				$film_id			=$rows['film_id'];
				$title 				=$rows['title'];
			
			//echo "<br><b>$title</b><br><br>";
			print '<a href="index.php?id=' . $rows['film_id'] . '"><b>'.$title.'<br><br></b></a>';
			
			}
	
	}
	// checks if the movie is rated by current user or not
	function isRated($film_id){
		
		$userid = $_SESSION['user_id'];
		$query = mysql_query("SELECT * FROM `rating` WHERE `film_id` = '". $film_id ."' AND `user_id` = '". $userid ."'");
		return (mysql_num_rows($query) > 0) ? true:false;
	
	}
	// returns the rating of movie
	function get_rating($film_id){
	
		$query = mysql_query("SELECT AVG(user_rating) FROM `rating` WHERE `film_id` = '". $film_id ."'");
		$rating = mysql_result($query,0);
		return round($rating,2);
	
	}
	
	function movie_detail($film_id){
		$query = mysql_query("SELECT * FROM `film` WHERE film_id = '". $film_id ."'");
		while($rows = mysql_fetch_array($query)) {

				$film_id			=$rows['film_id'];
				$title 				=$rows['title'];
				$description 		=$rows['description'];
				$release_year 		=$rows['release_year'];
				$language_id 		=$rows['language_id'];
				$length 				=$rows['length'];
				$rating 				=$rows['rating'];
			
			
			
			echo "<br>
					  <b>Title:</b> $title<br>
					  <b>Description:</b> $description<br>
					  <b>Release Year:</b> $release_year<br>
					  <b>Language:</b> $language_id <br>
					  <b>Duration:</b> $length <br>
					  <b>Rating :</b>$rating <br>";
			
			}
			$user_rating = get_rating($film_id);
			echo "<b>User Rating :<b>$user_rating<br>";
			
			
			
			
	}
	
	// function that calls movie titles and displys them
	
	function search_film ($search){
	
		$search = '%'.$search.'%';
		$query  = mysql_query("SELECT `title`, `film_id` FROM `film` WHERE `title` LIKE '". $search ."'");
		while($rows = mysql_fetch_array($query)) {

				$title			=$rows['title'];	
				$film_id		=$rows['film_id'];
				echo '<a href="index.php?id=' . $rows['film_id'] . '">'.$title.'<br></a>';
				
	}
	}
	
	
?>