<?php
header('Content-Type: text/html; charset=utf-8');
echo "=====Get Event from calendar Admin ========<br>";

//Clendar Admin :LH075-ตารางนัดหมายงาน  :Admin@gmail.com
//$calendarIdOwner = "r73n817q7lg2sj2vh4t3gbn174@group.calendar.google.com";
//$event_Id = "j86dim5f70b0qvvra0scmjjh4g";

$calendarIdOwner = "6tjmqelo32n6tjbcuqid596qcg@group.calendar.google.com";
$event_Id = "fsdat7g18t198pbso7nid179l8";


//Call fuction below
getEventCalendarize($calendarIdOwner,$event_Id);


function getEventCalendarize ($cal_id,$event_Id) {
	session_start();
	require_once 'src/Google/autoload.php';
	
	//Google credentials Authication :Admin@gmail.com
	//$client_id = '937566136451-p825gi4ad984tgg6b17rfmt248hqmlhl.apps.googleusercontent.com';
	//$service_account_name = '937566136451-p825gi4ad984tgg6b17rfmt248hqmlhl@developer.gserviceaccount.com';
	//$key_file_location = 'dev1-a20e4344ea69.p12';
	
	
	$client_id = '972640656104-fmsikd608rbbialte1vmfu1fac67lq22.apps.googleusercontent.com';
	$service_account_name = 'calendardevp12@calendardev-147810.iam.gserviceaccount.com';	
	$key_file_location = 'CalendarDev-ed00ea078c13.p12';
	
	
	
	if (!strlen($service_account_name) || !strlen($key_file_location))
		echo missingServiceAccountDetailsWarning();
	$client = new Google_Client();
	echo "1. New Google_Client [OK.]<br>";
	
	$client->setApplicationName("Dev1");
	if (isset($_SESSION['service_token'])) {
		$client->setAccessToken($_SESSION['service_token']);
	}
	echo "2. SetApplicationName [OK.]<br>";
	$key = file_get_contents($key_file_location);
	$cred = new Google_Auth_AssertionCredentials(
			$service_account_name,
			array('https://www.googleapis.com/auth/calendar','https://www.googleapis.com/auth/calendar.readonly'),
			$key
	);
	
	echo "3. Google credentials Authication [OK.]<br>";
	$client->setAssertionCredentials($cred);
	if($client->getAuth()->isAccessTokenExpired()) {
		try {
			$client->getAuth()->refreshTokenWithAssertion($cred);
		} catch (Exception $e) {
			var_dump($e->getMessage());
		}
	}
	echo "4. Get service_token  [OK.]<br>";
	
	
	$_SESSION['service_token'] = $client->getAccessToken();
	$calendarService = new Google_Service_Calendar($client);
	echo "5. Create Google_Service_Calendar  [OK.]<br>";
	
	//Get Command
	//$event = $calendarService->events->get($cal_id, $event_Id);  //******
    //Get Event Object
	
	
	//pradoem
	//echo "ID: ".$event->getId()." ,Title:".$event->getSummary().",Desc:".$event->getDescription()."<BR>";  //*****
		
//*******
// Loop for Lookup Getid and Detail Event calendar (GET)
$events = $calendarService->events->listEvents($cal_id);
while(true) {
		foreach ($events->getItems() as $event) {
			//echo "ID: ".$event->getId()." ,Title:".$event->getSummary().",Desc:".$event->getDescription()."<BR>";
			//echo "ID: ".$event->getId()."<BR>";
			echo "<br>";
		    echo "หัวเรื่อง: ".$event->getSummary()."<BR>";
		    echo "รายล่่ะเอียด: ".$event->getDescription()."<BR>";
			echo "วันที่สร้างนัดหมาย :".$event->getCreated();
			
			?>
			<a href="TestDeleteEvent.php?EventID=<?=$event->getId(); ?>" >กด เพื่อลบ</a>
			<?
			
			echo "<br>*********************************************";
		}
		$pageToken = $events->getNextPageToken();
		if ($pageToken) {
			$optParams = array('pageToken' => $pageToken);
			$events = $calendarService->events->listEvents($cal_id, $optParams);
		} else {
			break;
		}
	}	



//**
		
		
		
		
		
		
		
	echo "===========Successfully==========<br>";
}	
?>
