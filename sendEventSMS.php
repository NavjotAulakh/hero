<?php
require './vendor/autoload.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);
echo "Test";
use Aws\Sns\SnsClient;

// Instantiate the S3 client with your AWS credentials
$snsClient = SnsClient::factory(array(
    'credentials' => array(
        'key'    => 'ASIAYZ4HZNCR235B5CXF',
        'secret' => '1tX2UHCCV5ifT1wh3WUkrfoKiCPzhxmdd7O1FQ5x',
    )
));

// You just need to publish it and include the `PhoneNumber` parameter
$snsClientResult = $snsClient->publish([
    'Message' => 'Event Message',
    'PhoneNumber' => '+16475334532',
    'MessageStructure' => 'SMS',
    'MessageAttributes' => [
        'AWS.SNS.SMS.SenderID' => [
            'DataType' => 'String',
            'StringValue' => 'SENDER_ID',
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
