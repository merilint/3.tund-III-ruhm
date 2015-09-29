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
			if($email_error == "" && $password_error ==""){
				
				echo "kontrollin sisselogimist ".$email." ja parool ";
			}
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
		// kontrollin et ei oleks ühtegi errorit
		
			
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
	// Loon andmebaasi ühenduse
	require_once("../config.php");
	$database = "if15_meritak";
	$mysqli = new mysqli($servername, $username, $password, $database);

  // muuutujad errorite jaoks
	$email_error = "";
	$password_error = "";
	$create_email_error = "";
	$create_password_error = "";

  // muutujad väärtuste jaoks
	$email = "";
	$password = "";
	$create_email = "";
	$create_password = "";


	if($_SERVER["REQUEST_METHOD"] == "POST") {

    // *********************
    // **** LOGI SISSE *****
    // *********************
		if(isset($_POST["login"])){

			if ( empty($_POST["email"]) ) {
				$email_error = "See väli on kohustuslik";
			}else{
        // puhastame muutuja võimalikest üleliigsetest sümbolitest
				$email = cleanInput($_POST["email"]);
			}

			if ( empty($_POST["password"]) ) {
				$password_error = "See väli on kohustuslik";
			}else{
				$password = cleanInput($_POST["password"]);
			}

      // Kui oleme siia jõudnud, võime kasutaja sisse logida
			if($password_error == "" && $email_error == ""){
				echo "Võib sisse logida! Kasutajanimi on ".$email." ja parool on ".$password;
				
				$hash = hash("sha512", $password);
				
				$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
				$stmt->bind_param("ss", $email, $hash);
				
				//muutujad tulemustele
				$stmt->bind_result($id_from_db, $email_from_db);
				$stmt->execute();
				
				//kontrolli, kas tulemus leiti
				if($stmt->fetch()){
					//ab'i oli midagi
					echo "Email ja parool õiged, kasutaja id=".$id_from_db;
					
				}else{
					//ei leidnud
					echo "wrong credentials";
				}
				
				$stmt->close();
				
			}

		} // login if end

    // *********************
    // ** LOO KASUTAJA *****
    // *********************
    if(isset($_POST["create"])){

			if ( empty($_POST["create_email"]) ) {
				$create_email_error = "See väli on kohustuslik";
			}else{
				$create_email = cleanInput($_POST["create_email"]);
			}

			if ( empty($_POST["create_password"]) ) {
				$create_password_error = "See väli on kohustuslik";
			} else {
				if(strlen($_POST["create_password"]) < 8) {
					$create_password_error = "Peab olema vähemalt 8 tähemärki pikk!";
				}else{
					$create_password = cleanInput($_POST["create_password"]);
				}
			}

			if(	$create_email_error == "" && $create_password_error == ""){
				
				// räsi paroolist, mille salvestame ab'i
				$hash = hash("sha512", $create_password);
				
				echo "Võib kasutajat luua! Kasutajanimi on ".$create_email." ja parool on ".$create_password. "ja räsi on" .$hash;
				
				$stmt = $mysqli->prepare('INSERT INTO user_sample (email, password) VALUES (?, ?)');
				
				// asendame küsimärgid. ss - s ons tring email, s on string password
				
				$stmt->bind_param("ss", $create_email, $hash);
				$stmt->execute();
				$stmt->close();
      }

    } // create if end

	}

  // funktsioon, mis eemaldab kõikvõimaliku üleliigse tekstist
  function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }

	// paneme ühenduse kinni
	$mysqli->close();
  
?>

<?php require_once("../header.php"); ?>

 <h2>Log in</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<input name="email" type="email" placeholder="E-post" value="<?php echo $email; ?>"> <?php echo $email_error; ?><br><br>
  	<input name="password" type="password" placeholder="Parool" value="<?php echo $password; ?>"> <?php echo $password_error; ?><br><br>
  	<input type="submit" name="login" value="Log in">
  </form>

  <h2>Create user</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<input name="create_email" type="email" placeholder="E-post" value="<?php echo $create_email; ?>"> <?php echo $create_email_error; ?><br><br>
  	<input name="create_password" type="password" placeholder="Parool"> <?php echo $create_password_error; ?> <br><br>
  	<input type="submit" name="create" value="Create user">
  </form>
<body>
<html>
	
	
<h1>Pealkiri - teemale</h1>
<p>Siia leheküljele soovin luua <i>wannabe</i> Twitteri. See <i>wannabe</i> Twitter edastaks inimeste mõtteid IT alaselt. Inimesed saavad postitada oma mõtteid IT valdkonnast ja kuidas muuta keskkonda paremaks. Huvitavad teemad ja postitused mille üle mõelda.</p>

<?php require_once("../footer.php"); ?>