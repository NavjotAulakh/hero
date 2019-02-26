<?php
require './vendor/autoload.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);
use Aws\Sns\SnsClient;

$sns = \Aws\Sns\SnsClient::factory(array(
    'region' => 'us-east-1',
    'version'  => 'latest',
));

$result = $sns->publish([
    'Message' => 'Testing event message', // REQUIRED
    'MessageAttributes' => [
        'AWS.SNS.SMS.SenderID' => [
            'DataType' => 'String', // REQUIRED
            'StringValue' => 'Nav'
        ],
        'AWS.SNS.SMS.SMSType' => [
            'DataType' => 'String', // REQUIRED
            'StringValue' => 'Transactional' // or 'Promotional'
        ]
    ],
    'PhoneNumber' => '+16475334532',
]);
print_r($result);

echo "<pre>";
var_dump($result);
echo "</pre>";
?>
