<?php

require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

class Tw {

    public function hello(){
        echo 'hello';
    }
        
    public function sendSms($usermobile,$otp) {
        // Your Account SID and Auth Token from twilio.com/console
        $sid = 'ACe37cbf7cb57fce4f8130237d4a8a5155';
        $token = '36f0aedffb64a2af460bbd47fe48f2fa';
      
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
// A Twilio number you own with SMS capabilities
        //$twilio_number = "+972527349964";
		$twilio_number = "+12048081486";
         $usermobile = "+12049627031";
        $client = new Client($sid, $token);
        $client->messages->create(
                // Where to send a text message (your cell phone?)
                $usermobile, array(
            'from' => $twilio_number,
            'body' => 'Canadian e Market Otp Code is :'. $otp.'.'
                )
        );
    }

}
