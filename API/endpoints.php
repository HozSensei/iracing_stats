<?php

//Don't forget replace XXXXX by real id or data

$URL_CAREER_STATS = 'http://members.iracing.com/memberstats/member/GetCareerStats?custid=XXXXXXX'; // STATS all time
$URL_YEARLY_STATS = 'http://members.iracing.com/memberstats/member/GetYearlyStats?custid=XXXXXXX'; // Yearly STATS
$URL_LAST_SERIES = 'https://members.iracing.com/memberstats/member/GetLastSeries?custid=XXXXXXX'; // GET Last series(IMSA, F3,...) STATS
$URL_LAST_RACE = 'https://members.iracing.com/memberstats/member/GetLastRacesStats?custid=XXXXXXX'; // GET 10 last races data
$URL_BEST_CHRONO = 'https://members.iracing.com/memberstats/member/GetPersonalBests?carid=XXXXXXX&custid=XXXXXXX'; // GET Best chrono from CarID

// POST 
$URL_RACE_DATA = 'https://members.iracing.com/membersite/member/GetSubsessionResults'; //This one is a POST Request that use 2 parameter (subsessionID: 36505411  -  custid: 351100)

?>