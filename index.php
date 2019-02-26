<?php
require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$s3 = Aws\S3\S3Client::factory();
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
?>
<html>
    <head><meta charset="UTF-8"></head>
    <body>
        <h1>Event Prompter</h1>
		
		<a href="https://eventprompter.herokuapp.com/index.php">Event SMS</a>
		<a href="https://eventprompter.herokuapp.com/location.php">Files List</a>
		<a href="https://eventprompter.herokuapp.com/vision.php">Files List</a>

<h1>Current Event Files Added</h1>
		<h3>S3 Files</h3>
<?php
	try {
		$objects = $s3->getIterator('ListObjects', array(
			"Bucket" => $bucket
		));
		foreach ($objects as $object) {
?>
		<p> <a href="<?=htmlspecialchars($s3->getObjectUrl($bucket, $object['Key']))?>"> <?echo $object['Key'] . "<br>";?></a></p>
		
<?		}?>

<?php } catch(Exception $e) { ?>
        <p>error :(</p>
<?php }  
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
