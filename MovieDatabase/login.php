<?php
include 'core/init.php';
//logged_in_redirect();



if (empty($_POST) === false) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			if(empty($username) === true || empty($password) === true) {
				$errors[] = 'You Need to Enter a username and password';
			} else if (user_exists($username) === false) {
				$errors[] = 'We can/t find the username. Have you registered?';
			} 
			else {	
				$login = login ($username,$password);
					echo $login;
				 if($login === false){
				$errors[] = 'The username/Password combination is incorrect';
				} 	
			 else {
				$_SESSION['user_id'] = $login;
				//header('Location: index.php');
				//exit();
				}
				}
				
				
			} 

	else {
		$errors[] = 'No data recived';
		}
		
include  'include/overall/header.php';
if (empty($errors) === false){
	?>
	<h2> We Tried to log you in but....</h2>
	<?php
	echo output_errors($errors);
}
include  'include/overall/footer.php';
?>