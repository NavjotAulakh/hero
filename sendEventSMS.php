<?php
require 'vendor/autoload.php';
$sdk = new Aws\Sns\SnsClient([
    'region'  => 'us-east-1',
    'version' => 'latest',
    'credentials' => ['key' => 'ASIAYZ4HZNCR235B5CXF', 'secret' => '1tX2UHCCV5ifT1wh3WUkrfoKiCPzhxmdd7O1FQ5x']
  ]);
$result = $sdk->publish([
    'Message' => 'Event SMS Test Message',
    'PhoneNumber' => '+16475334532',
    'MessageAttributes' => ['AWS.SNS.SMS.SenderID' => [
         'DataType' => 'String',
         'StringValue' => 'WebNiraj'
      ]
  ]]);
print_r( $result );
?>
