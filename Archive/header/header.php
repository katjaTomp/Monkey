<?php

/*
 * To Do
 * 1. Locales need to updated
 * 2. What about Russia?
 * 3. Are we missing any other locales? 
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/Amsterdam');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

// Tell user how to use this. 
if(count($argv) < 2) {
		fwrite(STDOUT, "\n");
		fwrite(STDOUT, "-----------------------------------------------------\n");
		fwrite(STDOUT, "Hey! I need some arguments to work :-/\n");
		fwrite(STDOUT, "\n");
		fwrite(STDOUT, "Usage: input.xlsx\n");
		fwrite(STDOUT, "-----------------------------------------------------\n");		
		fwrite(STDOUT, "\n");
		exit;
}
$input = $argv[1];

// Inform user if file doesn't exit. 
if (!file_exists($input)) {
	exit("File $input doesn't exist." . EOL);
}

// Locales

$locales = array(
	'x-default' => 'B',	
	'cs-CZ' => 'AB',
	'da-DK' => 'J',
	'nl-NL' => 'T',
	'en-GB' => 'B',
	'en-IE' => 'D',
	'fi-FI' => 'L',
	'fr-BE' => 'F',
	'fr-FR' => 'N',
	'de-DE' => 'P',
	'de-AT' => 'R',
	'it-IT' => 'X',
	'pl-PL' => 'Z',
	'sk-SK' => 'AD',	
	'es-ES' => 'V',
	'sv-SE' => 'H',
);

// Including a library to read excel files
include 'inc/PHPExcel.php';

// Opening file
echo date('H:i:s') , " Loading file $input." , EOL;
$callStartTime = microtime(true);

$objPHPExcel = PHPExcel_IOFactory::load($input);

$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
echo date('H:i:s') , ' Loaded file in  ' , sprintf('%.4f',$callTime) , " seconds" , EOL;

echo date('H:i:s') , " Generating output file navigation-out.xml " , EOL;
$callStartTime = microtime(true);

ob_start();
include('navigation-template.xml');
$output = ob_get_contents();
ob_end_clean();

#file_put_contents("navigation-raw.xml", $output);

$dom = new DOMDocument;
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($output);
$dom->formatOutput = TRUE;
$dom->save("navigation-out.xml");

$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
echo date('H:i:s') , ' Generated file in  ' , sprintf('%.4f',$callTime) , " seconds" , EOL;


echo date('H:i:s') , " Done" , EOL;