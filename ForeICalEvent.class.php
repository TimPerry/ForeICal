<?php

class ForeICalEvent
{
	private $name;
	private $summary;
	private $start_date;
    	private $end_date;

	function __construct($name, $start_date='01-01-2012', $end_date='01-01-2012', $summary='', $location='')
	{	
        $this->name=$name;
        $this->summary=$summary;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
	}

	public function getEvent()
	{	
		// set the event name
		$event = $this->name;
		
		// make the summary the event name if it's not set
		$summary = !empty($this->summary) ? $this->summary : $event;
		
		// set the end time to the start time if end time is not set
		$end_time = $this->end_date =='01-01-2012' ? $this->start_date: $this->end_date;
		
		// generate our uid
		$salt = 'forepoint_generated';
		$uid = md5(uniqid(mt_rand(), true)).$salt;
		
		// reverse the date and remove the hyphens
		$parts = explode('-', $this->start_time);
		$parts = array_reverse($parts);
		$start_date = sprintf("%s%s%s", $parts[0], $parts[1], $parts[2]);
		
		// reverse the date and remove the hyphens
		$parts = explode('-', $this->end_time);
		$parts = array_reverse($parts);
		$end_date = sprintf("%s%s%s", $parts[0], $parts[1], $parts[2]);
		
		// use the date function to get the date today and format to meet the ical spec
		$today = date("d, m, Y"); 
		$parts = date_parse($today);
		$stamp_date = sprintf("%s%s%s", $parts['year'], $parts['month'], $parts['day']);

		// create the textual representation of the event
		$calObj .=  "BEGIN:VEVENT\n";
		$calObj .=  "CLASS:PUBLIC\n";
		$calObj .=  "CREATED:{$stamp_time}\n";
		$calObj .=  "DESCRIPTION: {$event}\n";
		$calObj .=  "DTSTART:{$start_date}\n";
		$calObj .=  "DTEND:{$end_date}\n";
		$calObj .=  "DTSTAMP:{$stamp_date}\n";
		$calObj .=  "LAST-MODIFIED:{$stamp_date}\n";
		$calObj .=  "LOCATION: {$location}\n";
		$calObj .=  "PRIORITY:5\n";
		$calObj .=  "SEQUENCE:0\n";
		$calObj .=  "SUMMARY:{$summary}\n";
		$calObj .=  "TRANSP:OPAQUE\n";
		$calObj .=  "UID:{$uid}\n";
		$calObj .=  "END:VEVENT\n";
		
		return $calObj;
	}
}

?>