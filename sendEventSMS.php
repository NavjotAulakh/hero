<?php
require './vendor/autoload.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);
use Aws\Credentials\CredentialProvider;

$profile = 'sns-reminders';
$path = 'credentials';

$provider = CredentialProvider::ini($profile, $path);
$provider = CredentialProvider::memoize($provider);

$sdk = new Aws\Sdk(['credentials' => $provider]);
$sns = $sdk->createSns([
//        'profile' => $profile,
        'region'  => 'us-east-1',
        'version' => 'latest',
]);


// You just need to publish it and include the `PhoneNumber` parameter
$snsClientResult = $sns->publish([
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
