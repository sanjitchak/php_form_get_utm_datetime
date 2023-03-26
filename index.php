<?php

	if(isset($_POST['email'])) {
    // Get the form data
$email = $_POST['email'];

$tz = 'Asia/Kolkata';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp

// Add any UTM parameters from the URL to the data
if(isset($_GET['utm_source'])) {
  $utm_source = $_GET['utm_source'];
  $utm_medium = $_GET['utm_medium'];
  $utm_campaign = $_GET['utm_campaign'];
  $utm_content = $_GET['utm_content'];
  
  // Add the UTM parameters to the data
  $data = array(
    'email' => $email,
    'utm_source' => $utm_source,
    'utm_medium' => $utm_medium,
    'utm_campaign' => $utm_campaign,
    'utm_content' => $utm_content,
    'program_name' => "4 Days Live Online Workshop",
    'date_time' => $dt->format('d.m.Y, H:i:s')
  );
}
else {
  // No UTM parameters in the URL, just add the form data
  $data = array(
 'utm_source' => '' ,
    'utm_medium' => '',
    'utm_campaign' => '',
    'utm_content' => '',
    'email' => $email,
    'program_name' => "4 Days Live Online Workshop",
    'date_time' => $dt->format('d.m.Y, H:i:s')
  );
}

// Convert the data to JSON
$data_json = json_encode($data);

// Set up the cURL request to send the data to the webhook
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://hooks.zapier.com/hooks/catch/8438582/33u6bhi/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Send the data to the webhook
$response = curl_exec($ch);

// Close the cURL connection
curl_close($ch);

// Redirect the user to a thank you page
header('Location: https://imjo.in/UUKvvT');
exit();
	}
?>

/** Font awesome script **/
<script src="https://kit.fontawesome.com/27d25b834e.js" crossorigin="anonymous"></script>

<script>
    function hideButton() {
  // get the first button by its ID
  var button1 = document.getElementById("registerbutton");
  
  // hide the first button
  button1.style.display = "none";
  
  // get the second button by its ID
  var button2 = document.getElementById("loadingbuttong");
  
  // show the second button
  button2.style.display = "block";
}

</script>

<form method="post" action="">
 
  <input   type="email" placeholder="Email" id="email" name="email" required>  

  <input onclick="hideButton()" id="registerbutton"
  style="background-color: #4D32CC; color: white; border-color: white; margin: 20px 0; padding:13px 40px;font-size: 18px;
    font-weight: 600;" type="submit" value="Register Now">
</form>
<button id="loadingbuttong" style="  display:none; background-color: #4D32CC; color: white; border-color: white; margin: 20px 0; padding:13px 40px;font-size: 18px;
    font-weight: 600;" >   <i class="fa fa-circle-o-notch fa-spin"></i> Registering...</button>

