<?php
require './vendor/autoload.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);

$params = array(
    'credentials' => array(
        'key' => 'ASIAYZ4HZNCR235B5CXF',
        'secret' => '1tX2UHCCV5ifT1wh3WUkrfoKiCPzhxmdd7O1FQ5x',
    ),
    'region' => 'us-east-1', // < your aws from SNS Topic region
    'version' => 'latest'
);
$sns = new \Aws\Sns\SnsClient($params);

$args = array(
    "MessageAttributes" => [
                'AWS.SNS.SMS.SenderID' => [
                    'DataType' => 'String',
                    'StringValue' => 'EventPrompter'
                ],
                'AWS.SNS.SMS.SMSType' => [
                    'DataType' => 'String',
                    'StringValue' => 'Transactional'
                ]
            ],
    "Message" => "Event Message",
    "PhoneNumber" => "6475334532"
);


$result = $sns->publish($args);
echo "<pre>";
var_dump($result);
echo "</pre>";
?>
