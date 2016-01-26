<?php 
$your_email ='greenmachine777@gmail.com';// <<=== update to your email address

session_start();
$errors = '';
$name = '';
$visitor_email = '';
$user_message = '';

if(isset($_POST['submit']))
{
	
	$name = $_POST['name'];
	$visitor_email = $_POST['email'];
	$user_message = $_POST['message'];
	///------------Do Validations-------------
	if(empty($name)||empty($visitor_email))
	{
		$errors .= "\n Name and Email are required fields. ";	
	}
	if(IsInjected($visitor_email))
	{
		$errors .= "\n Bad email value!";
	}
	if(empty($_SESSION['6_letters_code'] ) ||
	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		$errors .= "\n The captcha code does not match!";
	}
	
	if(empty($errors))
	{
		//send the email
		$to = $your_email;
		$subject="New Message From Website";
		$from = $your_email;
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		
		$body = "A user $name submitted the contact form:\n".
		"Name: $name\n".
		"Email: $visitor_email \n".
		"Message: \n ".
		"$user_message\n".
		"IP: $ip\n";	
		
		$headers = "From: $from \r\n";
		$headers .= "Reply-To: $visitor_email \r\n";
		
		mail($to, $subject, $body,$headers);
		
		header('Location: thank-you.html');
	}
}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<title>Contact Us</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- tab icon and shortcut icon -->
		<link rel="icon" type="image/png" href="images/favicon.jpg"/>
		<link rel="shortcut icon" href="images/favicon.jpg" />

		<!-- style for submit button -->
		<!-- define some style elements-->
		<style>
			label, body 
			{
				font-family : Arial, Helvetica, sans-serif;
				font-size : 12px; 
			}
			/*label {
				font-family: 'Adine Kirnberg';
				font-size: 30px;
			}
			h1 {
				font-family: 'Adine Kirnberg';
				font-size: 50px;
			}*/
			.err
			{
				font-family : Verdana, Helvetica, sans-serif;
				font-size : 12px;
				color: red;
			}
		</style>
		<!-- submit button style -->
		<style type="text/css"> 
			.styled-button {
				font-size: 1.2em;
				margin-top: 5px;
				background-color:#ed8223;
				color:#fff;
				font-family:'Helvetica Neue',sans-serif;
				font-size:18px;
				line-height:30px;
				border-radius:20px;
				-webkit-border-radius:20px;
				-moz-border-radius:20px;
				border:0;
				text-shadow:#C17C3A 0 -1px 0;
				width:120px;
				height:32px;
				cursor: pointer;
				transition: .3s background-color;
			}
			.styled-button:hover{
				background-color: #A30052;
			}
		</style>


		<link rel="stylesheet" href="styles/main.css" />

	    <!-- for fancy form	 -->
        <link rel="stylesheet" type="text/css" href="css/contact_form.css" />
        
		<script type="text/javascript" src="js/modernizr.custom.04022.js"></script>
		<!-- a helper script for vaidating the form-->
		<script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>	
	</head>

	<body class = "myBody" style="background: rgba(204, 51, 255, .2)" >
	<!-- style="background-image: url(Art/contact_background.jpg);
	 background-size: cover;" -->
		<?php
			if(!empty($errors)){
				// echo "<p class='err'>".nl2br($errors)."</p>";
				$message = "Captcha incorrect. Please try again";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		?>
		<header>
		    <div id="nav">
		      <ul>
		        <li><a class="navLinks" style= "font-size: 1.2em"  href="index.html">Home</a></li>
		        <li><a class="navLinks" style= "font-size: 1.2em" href="Chain_Maille.html">Gallery</a></li>
		        <li><a class="navLinks" style= "font-size: 1.2em" href="about.html">About</a></li>
		        <li><a class="navLinks active" style= "font-size: 1.2em" >Contact</a></li>
		      </ul>
		    </div>
	    </header>

	    <br>


		<div id='contact_form_errorloc' class='err'></div>

		<br>
		<br>
		<br>
		
		<div class="container" >
			<section class="af-wrapper">
	            <h2>Contact Us</h2>
		        
				<input id="af-showreq" class="af-show-input" type="checkbox" name="showreq" />
				<label for="af-showreq" class="af-show">Enhance required fields</label>
				
				<form method="POST" class="af-form" id="af-form" name="contact_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" novalidate>
				
					<div class="af-outer af-required">
						<div class="af-inner">
							<label for="name">Name</label>
							<input type="text" name="name" id="input-name" value='<?php echo htmlentities($name) ?>' required>
						</div>
					</div>
					
					<div class="af-outer af-required">
						<div class="af-inner">
						  <label for="email">Email address</label>
						  <input type="text" name="email" value='<?php echo htmlentities($visitor_email) ?>' required>
						</div>
					</div>
					
					<div class="af-outer">
						<div class="af-inner">
						  <label for='message'>Message</label>
							<textarea name="message" placeholder="Your message here..." rows=8 cols=28><?php echo htmlentities($user_message) ?></textarea>

						</div>
					</div>

					<div class="af-outer af-required">
						<div class="af-inner">
							<img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>
							<label for='message' style="font-size: .6em">Enter the code above here</label><br>
							<input id="6_letters_code" name="6_letters_code" type="text"><br>
							<small>Can't read the image? click <a style="color:blue" href='javascript: refreshCaptcha();'>here</a> to refresh</small>
						</div>
					</div>
					
					<input type="submit" value="Submit!" name='submit'/> 
					
				</form>
			</section>
		</div>

		<br>
		<br>

		<script language="JavaScript">
			// Code for validating the form
			// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
			// for details
			var frmvalidator  = new Validator("contact_form");
			//remove the following two lines if you like error message box popups
			// frmvalidator.EnableOnPageErrorDisplaySingleBox();
			// frmvalidator.EnableMsgsTogether();

			frmvalidator.addValidation("name","req","Please provide your name"); 
			frmvalidator.addValidation("email","req","Please provide your email"); 
			frmvalidator.addValidation("email","email","Please enter a valid email address"); 
		</script>

		<script language='JavaScript' type='text/javascript'>
			function refreshCaptcha()
			{
				var img = document.images['captchaimg'];
				img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
			}
		</script>
	</body>
</html>