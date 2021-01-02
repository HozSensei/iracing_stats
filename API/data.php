<?php

$USERNAME = 'xxxxxxxxxxxxxxxxxx'; //Iracing Username/Email
$PASSWORD = 'xxxxxxxxxxxxxxxxxx'; //Iracing Password
$COOKIEFILE = 'cookies.txt'; // Don't really know if it's necessary

$LOGINREQUEST = 'https://members.iracing.com/membersite/Login'; //URL for CURL request

// initialize curl handle used for all requests
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, $COOKIEFILE);
curl_setopt($ch, CURLOPT_COOKIEFILE, $COOKIEFILE);
curl_setopt($ch, CURLOPT_HEADER, 0);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

// inject email and password into form
$formFields['username']  = $USERNAME;
$formFields['password'] = $PASSWORD;
$formFields["AUTOLOGIN"] = 'on';
$formFields["utcoffset"] = '-60';

$post_string = http_build_query($formFields); // build urlencoded POST string for login

// set url to login page as a POST request
curl_setopt($ch, CURLOPT_URL, $LOGINREQUEST);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);

// execute login request
$curlloginrequest = curl_exec($ch);

// remove post mode to curl
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, null);



// REQUEST ALL DATA
// Now, we can try to get some DATA with different endpoint
// Exemple

curl_setopt($ch, CURLOPT_URL, 'http://members.iracing.com/memberstats/member/GetCareerStats?custid=351100');
$result = curl_exec($ch);

// We get back a JSON, i decide to decode it
$resultEncode = json_decode(urldecode($result));

//Now i stock all data in variable
// NOTE : [0] get ROAD stats look at the JSON to understand what i mean
$wins = $resultEncode[0]->wins;
$totalclubpoints = $resultEncode[0]->totalclubpoints;
$winPerc = $resultEncode[0]->winPerc;
$poles = $resultEncode[0]->poles;
$avgStart = $resultEncode[0]->avgStart;
$avgFinish = $resultEncode[0]->avgFinish;
$top5Perc = $resultEncode[0]->top5Perc;
$totalLaps = $resultEncode[0]->totalLaps;
$avgIncPerRace = $resultEncode[0]->avgIncPerRace;
$avgPtsPerRace = $resultEncode[0]->avgPtsPerRace;
$lapsLed = $resultEncode[0]->lapsLed;
$top5 = $resultEncode[0]->top5;
$lapsLedPerc = $resultEncode[0]->lapsLedPerc;
$starts = $resultEncode[0]->starts;

//I can now easily prepare an SQL to get data in my database
$insertDB = "INSERT INTO `iracing_drivers`(`id`, `wins`, `totalclubpoints`, `winPerc`, `poles`, `avgStart`, `avgFinish`, `top5Perc`, `totalLaps`, `avgIncPerRace`, `avgPtsPerRace`, `lapsLed`, `top5`, `lapsLedPerc`, `starts`) VALUES ('$id','$wins','$totalclubpoints','$winPerc','$poles','$avgStart','$avgFinish','$top5Perc','$totalLaps','$avgIncPerRace','$avgPtsPerRace','$lapsLed','$top5','$lapsLedPerc','$starts')";

?>