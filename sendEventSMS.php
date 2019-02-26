<?php
require './vendor/autoload.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);
use Aws\Sns\SnsClient; 
use Aws\Exception\AwsException;
// Instantiate the S3 client with your AWS credentials
$snsClient =new SnsClient([
    'version'     => 'latest',
    'region'      => 'us-east-1',
    'credentials' => [
        'key'    => 'ASIAYZ4HZNCRTCELYS6O',
        'secret' => 'qsOVHY6zraQhuPdcKXKb5pvN8BHiCogTBdSQYaU1',
    ],
]);

// You just need to publish it and include the `PhoneNumber` parameter
$snsClientResult = $snsClient->publish([
    'Message' => 'Event Message',
    'PhoneNumber' => '+16475334532',
    'MessageStructure' => 'SMS',
    'MessageAttributes' => [
        'AWS.SNS.SMS.SenderID' => [
            'DataType' => 'String',
            'StringValue' => 'Nav',
        ],
        'AWS.SNS.SMS.SMSType' => [
            'DataType' => 'String',
            'StringValue' => 'Promotional', // Transactional
        ]
    ]
]);

// Get the response

echo "<pre>";
var_dump($snsClientResult['MessageId']);
echo "</pre>";
?>
