<?php
// current address
$oldurl = strtolower($_SERVER['REQUEST_URI']);

// new redirect address
$newurl = '';

// old to new URL map (for you to configure)
$redir = array(

	'items/show/58' => '/stories/the-old-nyanza-provincial-headquarters-in-kisumu/',
	'items/show/54' => '/stories/if-only-the-monuments-could-speak/',
	'items/show/51' => '/stories/maseno-mission-hospital/',
	'items/show/50' => '/stories/how-come-i-never-saw-you-at-maseno-national-school/',
	'items/show/47' => '/stories/peoples-parliament-the-trafalgar-square-of-kisumu/',
	'items/show/45' => '/stories/the-only-university-on-the-equator/',
	'items/show/43' => '/stories/chief-nindo-and-the-colonial-administration-of-kenya/',
	'items/show/42' => '/stories/the-anglican-church-in-maseno/',
	'items/show/41' => '/stories/maseno-town/',
	'items/show/40' => '/stories/russia-hospital/',
	'items/show/39' => '/stories/living-with-the-hyacinth-weed/',
	'items/show/38' => '/stories/the-livestock-trade-in-kisumu-region/',
	'items/show/37' => '/stories/the-ambrose-ofafa-memorial-building/',
	'items/show/35' => '/stories/the-oginga-odinga-house-at-maseno-national-school/',
	'items/show/34' => '/stories/the-hiv-aids-pandemic-in-kisumu-county/',
	'items/show/33' => '/stories/jua-kali-in-kisumu/',
	'items/show/32' => '/stories/kibuye-market/',
	'items/show/31' => '/stories/kisumu-war-cemetery/',
	'items/show/30' => '/stories/the-ramogi-press/',
	'items/show/28' => '/stories/jaramogi-oginga-odinga-and-the-rise-of-opposition-politics-in-kisumu/',
	'items/show/26' => '/stories/the-kisumu-port/',
	'items/show/23' => '/stories/the-bombay-of-east-africa/',
	'items/show/18' => '/stories/miracle-healers-in-kisumu/',
	'items/show/17' => '/stories/mamboleo-murram-extraction-site/',
	'items/show/15' => '/stories/the-east-african-community-and-the-south-african-development-community/',
	'items/show/14' => '/stories/a-history-of-religious-and-secular-schools-in-kisumu/',
	'items/show/12' => '/stories/political-protests-resistance-and-unrest-in-kisumu/',
	'items/show/10' => '/stories/78/',
	'items/show/9' => '/stories/land-alienation-and-its-impact-in-kisumu/',
	'items/show/8' => '/stories/the-kenya-uganda-railway/',
	'items/show/6' => '/stories/the-mega-city-mall-in-kisumu/',
	'tours/show/1' => '/tours/religious-sites-and-sacred-spaces/',
	'tours/show/2' => '/tours/academic-institutions-in-kisumu/',
	'tours/show/3' => '/tours/roads-railroads-and-ports/',
);

while ((list($old, $new) = each($redir)) && !$newurl) {
	if (strpos($oldurl, $old) !== false) $newurl = $new;
}

// redirect
if ($newurl != '') {

	header('HTTP/1.1 301 Moved Permanently');
	header("Location: $newurl");
	exit();

}
?>