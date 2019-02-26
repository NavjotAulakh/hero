<?php
require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
// Instantiate the client.
use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;
	// Set Amazon S3 Credentials
	$s3 = S3Client::factory(
		array(
			'credentials' => array(
				'key' => 'ASIAYZ4HZNCRQZYVMEEY',
				'secret' => 'l//DO3oZSs5cbcodpEKdrLnX6K0a6n0nkoOMVAOD'
			),
			'version' => 'latest',
			'region'  => 'us-east-1'
		)
	);
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
?>
<html>
    <head><meta charset="UTF-8"></head>
    <body>
        <h1>Event Prompter - Main Page</h1>
		
		<a href="https://eventprompter.herokuapp.com/list.php">Event List</a>
	    	<a href="https://eventprompter.herokuapp.com/sendEventSMS.php">Send SMS Message</a>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    try {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="userfile" type="file"><input type="submit" value="Upload">
        </form>
    </body>
</html>
