<?php
    //login.php
	//echo $_POST["email"];
	
	$email_error = "";
	$password_error = "";
	
	//kontrollime, et keegi vajutas input nuppu
	if($_SERVER["REQUEST_METHOD"]== "POST"){
		//echo "keegi vajutas nuppu";
		
		//kontrollin, et e-post ei ole tühi
		if(empty($_POST["email"]) ){
		$email_error = "See väli on kohustuslik";
		}
		
		//kontrollin, et parool ei ole tühi
		if(empty($_POST["password"]) ){
		$password_error = "See väli on kohustuslik";	
		} else {
			//kui oleme siia jõudnud. siis parool ei ole tühi
			//kontrollin, et oleks vähemalt 8 sümbolit pikk
			
			if(strlen($_POST["password"]) < 8){
				$password_error = "Peab olema vähemalt 8 tähemärki pikk!";
			
			
			}  
			
		
		}	
		//kontrollin, et parool ei ole tühi
	}	
	
?>


<html>
<head>
    <title>Login page</title>
	<style>
	body {background-color:lightblue}
	h1   {color:black}
	p    {color:black}
	</style>
</html>
</head>
    <h2>Registreeri!</h2>

<form id='register' action='register.php' method='post'
    accept-charset='UTF-8'>
<fieldset >
<legend>Registreeri!</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<label for='name' >Nimi*: </label>
<input type='text' name='name' id='name' maxlength="50" /><?php echo $name_error; ?> <br><br>
<label for='email' >E-posti aadress*:</label>
<input type='text' name='email' id='email' maxlength="50" /><?php echo $email_error; ?> <br><br>
 
<label for='username' >Kasutajanimi*:</label>
<input type='text' name='username' id='username' maxlength="50" /><?php echo $username_error; ?> <br><br>
 
<label for='password' >Parool*:</label>
<input type='password' name='password' id='password' maxlength="50" /><?php echo $password_error; ?> <br><br>
<input type='submit' name='Registreeru!' value='Registreeru!' />
 
</fieldset>
</form>



	<h2>Logi sisse</h2>
	
	<form action="login.php" method="post" >
	<input name="email" type="email" placeholder="E-post"> <?php echo $email_error; ?> <br><br>
	<input name="password" type="password" placeholder="Parool" > <?php echo $password_error; ?> <br><br>
	<input type ="submit" value="Logi sisse!">
	</form>
	
	
<h1>Pealkiri - teemale</h1>
<p>alltekst,mis toimuma hakkab.</p>

</body>
</html>