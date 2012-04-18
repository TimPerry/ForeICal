<?php
// require the calendar class
require('ForeICal.class.php');

// create an instance of the calendar, usage (<calendar_name>, <filename> (must end in .ics))
$cal = new ForeICal('Tims Cal', 'tims_cal.ics');

// add an event, usage (<event_name>, <start_time> e.g. (01-01-2012), <end_time> e.g. ('01-01-2012'), <summary> (if blank summary=event_name, <location>)
$cal->addEvent(new ForeICalEvent('new events', '01-04-2012', '01-04-2012'));

// finally output the calendar
$cal->output();
?>