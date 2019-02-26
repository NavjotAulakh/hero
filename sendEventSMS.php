<?php
require './vendor/autoload.php';

$sns = Aws\Sns\SnsClient::factory();

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
