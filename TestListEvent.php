<?php
header('Content-Type: text/html; charset=utf-8');
echo "=====List All Event from calendar Admin ========<br>";

//Clendar Admin :LH075-ตารางนัดหมายงาน  :Admin@gmail.com
$calendarIdOwner = "6tjmqelo32n6tjbcuqid596qcg@group.calendar.google.com";

//Call fuction below
getEventCalendarize($calendarIdOwner);

function getEventCalendarize ($cal_id) {
	session_start();
	require_once 'src/Google/autoload.php';
	
	//Google credentials Authication :Config of Admin@gmail.com
	//CalendarDevLogin
	$client_id = '972640656104-fmsikd608rbbialte1vmfu1fac67lq22.apps.googleusercontent.com';
	$service_account_name = 'calendardevp12@calendardev-147810.iam.gserviceaccount.com';
	$key_file_location = 'CalendarDev-ed00ea078c13.p12';
	
	//private key :notasecret
	//calendardevp12
	echo "1.=====xxxx [OK.]<br>";
	if (!strlen($service_account_name) || !strlen($key_file_location))
		echo missingServiceAccountDetailsWarning();
	$client = new Google_Client();
	echo "2.New Google_Client [OK.]<br>";
	
	$client->setApplicationName("Dev1");
	if (isset($_SESSION['service_token'])) {
		$client->setAccessToken($_SESSION['service_token']);
	}
	echo "3.SetApplicationName [OK.]<br>";
	$key = file_get_contents($key_file_location);
	$cred = new Google_Auth_AssertionCredentials(
			$service_account_name,
			array('https://www.googleapis.com/auth/calendar'),
			$key
	);
	
	echo "4. Google credentials Authication [OK.]<br>";
	$client->setAssertionCredentials($cred);
	if($client->getAuth()->isAccessTokenExpired()) {
		try {
			$client->getAuth()->refreshTokenWithAssertion($cred);
		} catch (Exception $e) {
			var_dump($e->getMessage());
		}
	}
	//plealse open ssl php.ini =extension=php_openssl.dll  and Restart -->Apache Restart
	echo "5.Get service_token  [OK.]<br>";	
	
	$_SESSION['service_token'] = $client->getAccessToken();
	$calendarService = new Google_Service_Calendar($client);
	
	echo "6.Create Google_Service_Calendar  [OK.]<br>";

	$events = $calendarService->events->listEvents($cal_id);
	//event object
	
//// Loop for Lookup Getid and Detail List calendar (VIEW)
	while(true) {
		foreach ($events->getItems() as $event) {
			echo "ID: ".$event->getId()." ,Title:".$event->getSummary().",Desc:".$event->getDescription()."<BR>";
		}
		$pageToken = $events->getNextPageToken();
		if ($pageToken) {
			$optParams = array('pageToken' => $pageToken);
			$events = $calendarService->events->listEvents($cal_id, $optParams);
		} else {
			break;
		}
	}	
	
	echo "===========Successfully==========<br>";
}	
?>