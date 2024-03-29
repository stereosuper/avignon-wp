<?php

/*-----------------------------------------------------------------------------------*/
/* Generate .ics file
/*-----------------------------------------------------------------------------------*/

function cleanTxt($string){
    $cleanString = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($string))))));
    return $cleanString;
}

function setTimeFormat($time){
    switch($time){
        case '12:00 AM':
            $time = 'T000000';
            return $time;
            break;
        case '12:15 AM':
            $time = 'T001500';
            return $time;
            break;
        case '12:30 AM':
            $time = 'T003000';
            return $time;
            break;
        case '12:45 AM':
            $time = 'T004500';
            return $time;
            break;
        case '1:00 AM':
            $time = 'T010000';
            return $time;
            break;
        case '1:15 AM':
            $time = 'T011500';
            return $time;
            break;
        case '1:30 AM':
            $time = 'T013000';
            return $time;
            break;
        case '1:45 AM':
            $time = 'T014500';
            return $time;
            break;
        case '2:00 AM':
            $time = 'T020000';
            return $time;
            break;
        case '2:15 AM':
            $time = 'T021500';
            return $time;
            break;
        case '2:30 AM':
            $time = 'T023000';
            return $time;
            break;
        case '2:45 AM':
            $time = 'T024500';
            return $time;
            break;
        case '3:00 AM':
            $time = 'T030000';
            return $time;
            break;
        case '3:15 AM':
            $time = 'T031500';
            return $time;
            break;
        case '3:30 AM':
            $time = 'T033000';
            return $time;
            break;
        case '3:45 AM':
            $time = 'T034500';
            return $time;
            break;
        case '4:00 AM':
            $time = 'T040000';
            return $time;
            break;
        case '4:15 AM':
            $time = 'T041500';
            return $time;
            break;
        case '4:30 AM':
            $time = 'T043000';
            return $time;
            break;
        case '4:45 AM':
            $time = 'T044500';
            return $time;
            break;
        case '5:00 AM':
            $time = 'T050000';
            return $time;
            break;
        case '5:15 AM':
            $time = 'T051500';
            return $time;
            break;
        case '5:30 AM':
            $time = 'T053000';
            return $time;
            break;
        case '5:45 AM':
            $time = 'T054500';
            return $time;
            break;
        case '6:00 AM':
            $time = 'T060000';
            return $time;
            break;
        case '6:15 AM':
            $time = 'T061500';
            return $time;
            break;
        case '6:30 AM':
            $time = 'T063000';
            return $time;
            break;
        case '6:45 AM':
            $time = 'T064500';
            return $time;
            break;
        case '7:00 AM':
            $time = 'T070000';
            return $time;
            break;
        case '7:15 AM':
            $time = 'T071500';
            return $time;
            break;
        case '7:30 AM':
            $time = 'T073000';
            return $time;
            break;
        case '7:45 AM':
            $time = 'T074500';
            return $time;
            break;
        case '8:00 AM':
            $time = 'T080000';
            return $time;
            break;
        case '8:15 AM':
            $time = 'T081500';
            return $time;
            break;
        case '8:30 AM':
            $time = 'T083000';
            return $time;
            break;
        case '8:45 AM':
            $time = 'T084500';
            return $time;
            break;
        case '9:00 AM':
            $time = 'T090000';
            return $time;
            break;
        case '9:15 AM':
            $time = 'T091500';
            return $time;
            break;
        case '9:30 AM':
            $time = 'T093000';
            return $time;
            break;
        case '9:45 AM':
            $time = 'T094500';
            return $time;
            break;
        case '10:00 AM':
            $time = 'T100000';
            return $time;
            break;
        case '10:15 AM':
            $time = 'T101500';
            return $time;
            break;
        case '10:30 AM':
            $time = 'T103000';
            return $time;
            break;
        case '10:45 AM':
            $time = 'T104500';
            return $time;
            break;
        case '11:00 AM':
            $time = 'T110000';
            return $time;
            break;
        case '11:15 AM':
            $time = 'T111500';
            return $time;
            break;
        case '11:30 AM':
            $time = 'T113000';
            return $time;
            break;
        case '11:45 AM':
            $time = 'T114500';
            return $time;
            break;
        case '12:00 PM':
            $time = 'T120000';
            return $time;
            break;
        case '12:15 PM':
            $time = 'T121500';
            return $time;
            break;
        case '12:30 PM':
            $time = 'T123000';
            return $time;
            break;
        case '12:45 PM':
            $time = 'T124500';
            return $time;
            break;
        case '1:00 PM':
            $time = 'T130000';
            return $time;
            break;
        case '1:15 PM':
            $time = 'T131500';
            return $time;
            break;
        case '1:30 PM':
            $time = 'T133000';
            return $time;
            break;
        case '1:45 PM':
            $time = 'T134500';
            return $time;
            break;
        case '2:00 PM':
            $time = 'T140000';
            return $time;
            break;
        case '2:15 PM':
            $time = 'T141500';
            return $time;
            break;
        case '2:30 PM':
            $time = 'T143000';
            return $time;
            break;
        case '2:45 PM':
            $time = 'T144500';
            return $time;
            break;
        case '3:00 PM':
            $time = 'T150000';
            return $time;
            break;
        case '3:15 PM':
            $time = 'T151500';
            return $time;
            break;
        case '3:30 PM':
            $time = 'T153000';
            return $time;
            break;
        case '3:45 PM':
            $time = 'T154500';
            return $time;
            break;
        case '4:00 PM':
            $time = 'T160000';
            return $time;
            break;
        case '4:15 PM':
            $time = 'T161500';
            return $time;
            break;
        case '4:30 PM':
            $time = 'T163000';
            return $time;
            break;
        case '4:45 PM':
            $time = 'T164500';
            return $time;
            break;
        case '5:00 PM':
            $time = 'T170000';
            return $time;
            break;
        case '5:15 PM':
            $time = 'T171500';
            return $time;
            break;
        case '5:30 PM':
            $time = 'T173000';
            return $time;
            break;
        case '5:45 PM':
            $time = 'T174500';
            return $time;
            break;
        case '6:00 PM':
            $time = 'T180000';
            return $time;
            break;
        case '6:15 PM':
            $time = 'T181500';
            return $time;
            break;
        case '6:30 PM':
            $time = 'T183000';
            return $time;
            break;
        case '6:45 PM':
            $time = 'T184500';
            return $time;
            break;
        case '7:00 PM':
            $time = 'T190000';
            return $time;
            break;
        case '7:15 PM':
            $time = 'T191500';
            return $time;
            break;
        case '7:30 PM':
            $time = 'T193000';
            return $time;
            break;
        case '7:45 PM':
            $time = 'T194500';
            return $time;
            break;
        case '8:00 PM':
            $time = 'T200000';
            return $time;
            break;
        case '8:15 PM':
            $time = 'T201500';
            return $time;
            break;
        case '8:30 PM':
            $time = 'T203000';
            return $time;
            break;
        case '8:45 PM':
            $time = 'T204500';
            return $time;
            break;
        case '9:00 PM':
            $time = 'T210000';
            return $time;
            break;
        case '9:15 PM':
            $time = 'T211500';
            return $time;
            break;
        case '9:30 PM':
            $time = 'T213000';
            return $time;
            break;
        case '9:45 PM':
            $time = 'T214500';
            return $time;
            break;
        case '10:00 PM':
            $time = 'T220000';
            return $time;
            break;
        case '10:15 PM':
            $time = 'T221500';
            return $time;
            break;
        case '10:30 PM':
            $time = 'T223000';
            return $time;
            break;
        case '10:45 PM':
            $time = 'T224500';
            return $time;
            break;
        case '11:00 PM':
            $time = 'T230000';
            return $time;
            break;
        case '11:15 PM':
            $time = 'T231500';
            return $time;
            break;
        case '11:30 PM':
            $time = 'T233000';
            return $time;
            break;
        case '11:45 PM':
            $time = 'T234500';
            return $time;
            break;
    }
}

function avignon_events_ical(){
      // - start collecting output -
      ob_start();
       
      // - file header -
      header('Content-type: text/calendar');
      header('Content-Disposition: attachment; filename="avignon-events.ics"');
?>
BEGIN:VCALENDAR
CALSCALE:GREGORIAN
VERSION:2.0
PRODID:-// Institut d'Avignon // Events // EN
X-WR-CALNAME:Institut d'Avignon - Events
X-WR-TIMEZONE:Europe/Paris
X-ORIGINAL-URL:<?php echo site_url().'/?feed=avignon-events' ?>

<?php
    // Loop through events
    if ( have_posts() ):

    	$now = new DateTime();
    	$datestamp = $now->format('Ymd\THis\Z');

        while( have_posts() ): the_post();
            global $post;

            $uid = md5(uniqid(mt_rand(), true)).'@avignon.com';

            $start = get_field('date1').setTimeFormat(get_field('time1'));
            $end = get_field('date2').setTimeFormat(get_field('time2'));

            $summary = cleanTxt(get_the_title());
            $description = cleanTxt(get_field('content'));


?>

BEGIN:VEVENT
UID:<?php echo $uid;?>

DTSTAMP:<?php echo $datestamp;?>

DTSTART:<?php echo $start; ?>

DTEND:<?php echo $end; ?>

SUMMARY:<?php echo $summary;?>

DESCRIPTION:<?php echo $description;?>

END:VEVENT

<?php
         endwhile;

    endif;
?>
END:VCALENDAR
<?php

    //Collect output and echo 
    $eventsical = ob_get_contents();
    ob_end_clean();
    echo $eventsical;
    exit();
}   
add_feed( 'avignon-events', 'avignon_events_ical' );

function events_feed_query( $query ) {

    $today = date('Ymd');

    if( $query->is_feed('avignon-events') ){
        $query->set('post_type', 'events');
        $query->set('posts_per_page', -1);
        $query->set('meta_key', 'date2');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        //$query->set('meta_compare', '>=');
        //$query->set('meta_value', $today);
    }
}
add_action( 'pre_get_posts', 'events_feed_query' );

function avignon_activities_ical(){
      // - start collecting output -
      ob_start();
       
      // - file header -
      header('Content-type: text/calendar');
      header('Content-Disposition: attachment; filename="avignon-activities.ics"');
?>
BEGIN:VCALENDAR
CALSCALE:GREGORIAN
VERSION:2.0
PRODID:-// Institut d'Avignon // Activities // EN
X-WR-CALNAME:Institut d'Avignon - Acitivities
X-WR-TIMEZONE:Europe/Paris
X-ORIGINAL-URL:<?php echo site_url().'/?feed=avignon-activities' ?>

<?php
    // Loop through activities
    if ( have_posts() ):

        $now = new DateTime();
        $datestamp = $now->format('Ymd\THis\Z');

        while( have_posts() ): the_post();
            global $post;

            $uid = md5(uniqid(mt_rand(), true)).'@avignon.com';

            $start = get_field('date1').setTimeFormat(get_field('time1'));
            $end = get_field('date2').setTimeFormat(get_field('time2'));

            $summary = cleanTxt(get_the_title());
            $description = cleanTxt(get_field('content'));


?>

BEGIN:VEVENT
UID:<?php echo $uid;?>

DTSTAMP:<?php echo $datestamp;?>

DTSTART:<?php echo $start; ?>

DTEND:<?php echo $end; ?>

SUMMARY:<?php echo $summary;?>

DESCRIPTION:<?php echo $description;?>

END:VEVENT

<?php
         endwhile;

    endif;
?>
END:VCALENDAR
<?php

    //Collect output and echo 
    $eventsical = ob_get_contents();
    ob_end_clean();
    echo $eventsical;
    exit();
}   
add_feed( 'avignon-activities', 'avignon_activities_ical' );

function activities_feed_query( $query ) {

    $today = date('Ymd');

    if( $query->is_feed('avignon-activities') ){
        $query->set('post_type', 'activities');
        $query->set('posts_per_page', -1);
        $query->set('meta_key', 'date2');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        //$query->set('meta_compare', '>=');
        //$query->set('meta_value', $today);
    }
}
add_action( 'pre_get_posts', 'activities_feed_query' );

// Update feeds all 600 seconds (about 10 minutes)
function update_feeds($a){
    return 600;
}
add_filter( 'wp_feed_cache_transient_lifetime', 'update_feeds' );

?>