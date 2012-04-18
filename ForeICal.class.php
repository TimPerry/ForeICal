<?php

require('ForeICalEvent.class.php');

class ForeICal {

	private $name;
	private $filename;
	private $events=array();
	private $events_colour;
	
	function __construct($name='calendar', $filename ='calendar.ics', $events_colour='#B027AE')
	{	
        $this->name = $name;
		$this->filename = $filename;
		$this->events_colour = $events_colour;
	}

	public function addEvent($event)
	{
		$this->events[]=$event;	
	}
	
	public function output()
	{	
	
		// get our variables
		$filename = $this->filename;
		$name = $this->name;
		$colour = $this->events_colour;
		
		// set the header so it forces the download
		header("Content-Type: text/Calendar");
		header("Content-Disposition: inline; filename={$filename}");
		header("HTTP/1.0 200 OK");
			
		// create the textual representation of the calendar	
		echo "BEGIN:VCALENDAR\n";
		echo "METHOD:PUBLISH\n";
		echo "VERSION:2.0\n";
		echo "X-WR-CALNAME:{$name}\n";
		echo "PRODID:-//{$name}//iCal 4.0.3//EN\n";
		echo "X-APPLE-CALENDAR-COLOR:{$colour}\n";
		echo "X-WR-TIMEZONE:Europe/London\n";
		echo "CALSCALE:GREGORIAN\n";
		
		// loop our events and get the textual representation of them
		foreach ($this->events as $event)
		{
			echo $event->getEvent();
		}
		
		// close our calendar
		echo "END:VCALENDAR\n";
	}
}

?>