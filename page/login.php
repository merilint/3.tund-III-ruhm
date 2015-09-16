<?php
    //login.php
	//echo $_POST["email"];
	
	$email_error = "";
	$password_error = "";
	$name_error = "";
	$username1_error = "";
	$email1_error = "";
	$password1_error = "";
	
	//kontrollime, et keegi vajutas input nuppu
	if($_SERVER["REQUEST_METHOD"]== "POST"){
		//echo keegi vajutas nuppu
		 //echo vajutas login nuppu
		  if(isset($_POST["login"])){
			
		    
			
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
		//keegi vajutas create nuppu
		}elseif(isset($_POST["create"])){
			
			//echo "vajutas create nuppu";
			if(empty($_POST["name"]) ){
			$name_error = "See väli on kohustuslik";
			}
			if(empty($_POST["password"]) ){
			$password1_error = "See väli on kohustuslik";
			}
			if(empty($_POST["email1"]) ){
			$email1_error = "See väli on kohustuslik";
			}
			if(empty($_POST["usename"]) ){
			$username1_error = "See väli on kohustuslik";
			}
		}else{
			//kõik korras
			//test_input
			$name = test_input($_POST["name"]);
			
		//		
		
		}	
		//kontrollin, et parool ei ole tühi
		
	}	
	
	function test_input($data) {
		//võtab ära enterid,tühikud
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}
		
?>
<?php 
 $page_title = "Sisselogimise leht";
    $page_file_name = "login.php";
	?>
<?php require_once("../header.php"); ?>
    <h2>Registreeri!</h2>

<form id='register' action='login.php' method='post'
    accept-charset='UTF-8'>
<fieldset >
<legend>Registreeri!</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<label for='name' >Nimi*: </label>
<input type='text' name='name' id='name' maxlength="50" /><?php echo $name_error; ?> <br><br>
<label for='email' >E-posti aadress*:</label>
<input type='text' name='email' id='email' maxlength="50" /><?php echo $email1_error; ?> <br><br>
 
<label for='username' >Kasutajanimi*:</label>
<input type='text' name='username' id='username' maxlength="50" /><?php echo $username1_error; ?> <br><br>
 
<label for='password' >Parool*:</label>
<input type='password' name='password' id='password' maxlength="50" /><?php echo $password1_error; ?> <br><br>
<input type='submit' name='create' value='Registreeru!' />
 
</fieldset>
</form>



	<h2>Logi sisse</h2>
	
	<form action="login.php" method="post" >
	<input name="email1" type="email" placeholder="E-post"> <?php echo $email_error; ?> <br><br>
	<input name="password1" type="password" placeholder="Parool" > <?php echo $password_error; ?> <br><br>
	<input name="login" type ="submit" value="Logi sisse!">
	</form>
	
	
<h1>Pealkiri - teemale</h1>
<p>alltekst,mis toimuma hakkab.</p>

<?php require_once("../footer.php"); ?>