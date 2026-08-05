<?php
session_start();

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (array_key_exists ("token", $_POST) && array_key_exists ("token", $_SESSION)) {
		if (array_key_exists ("token", $_SESSION)) {
			if ($_POST['token'] == $_SESSION['token']) {
				$message = "Success";
			} else {
				$message = "Tokens don't match - submitted " . htmlspecialchars($_POST['token']) . "";
			}
		} else {
			$message = "Token not in session";
		}
	} else {
		$message = "Token not sent in POST";
	}
}
$token = md5(mt_rand());
$_SESSION['token'] = $token;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Burp Suite Macro Demo Test Page</title>
	<meta name="Description" content="A page to use to practice with Burp Suite macros and session handling rules to bypass CSRF protections." />
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
</head>
<body>
	<h1>Burp Suite Macro Test Form</h1>
	<p>This form is designed to be used alongside the <a href="https://digi.ninja/blog/burp_macros.php">Burp Macros and Session Handling</a> blog post.</p>
	<p><?=$message?></p>
	<form method="post" action="<?=htmlentities ($_SERVER['PHP_SELF'])?>">
		<input type="submit" value="Submit" name="submit" />
		<input type="hidden" value="" name="token" id="token" />
	</form>
	<hr />
	<p>
		Demo created by Robin Wood - <a href="https://digi.ninja">DigiNinja</a>
	</p>
	<script>
		document.getElementById("token").value = "<?=htmlentities ($token)?>";
	</script>
</body>
</html>
