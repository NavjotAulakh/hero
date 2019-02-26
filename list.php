<?php
require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$credentials = new Aws\Credentials\Credentials('ASIAYZ4HZNCRTCELYS6O', 'qsOVHY6zraQhuPdcKXKb5pvN8BHiCogTBdSQYaU1');
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1',
    'credentials' => $credentials
]);
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
?>
<html>
    <head><meta charset="UTF-8"></head>
    <body>
        <h1>S3 Download example</h1>
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
<?php }  ?>
    </body>
</html>
