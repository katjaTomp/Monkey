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
// Order of locales in Excel - Columns 
$locales = array(
	'en-GB',
	'en-US',
	'nl',
	'fr-FR',
	'de-DE',
	'it',
	'es',
	'zh',
	'ja-JP',
	'cs-CZ',
	'pl',
	'sk-SK'
);

// Order of fields  in Excel - Rows
$translations = array(
	'display-name' => 7,
	'callOutText' => 8,
	'introText' => 9,
	'featureTitle1' => 10,
	'featureText1-intro' => 11,
	'featureText1-bullet-1' => 14,
	'featureText1-bullet-2' => 15,
	'featureText1-bullet-3' => 16,
	'featureText1-bullet-4' => 17,
	'featureText1-bullet-5' => 18,
	'featureTitle2' => 19,
	'featureText2' => 20,
	'featureTitle3' => 19,
	'featureText3' => 20
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

$worksheet = $objPHPExcel->getSheet(0);

$content = array();

foreach($translations as $key => $value): 
	$content[$key] = $worksheet->rangeToArray('B' . $value . ':M' . $value, FALSE, TRUE, FALSE);
endforeach;

$worksheet = $objPHPExcel->getSheet(1);

$content['article'] = $objPHPExcel->getActiveSheet()->getCell('B2')->getValue();
$content['feature-image-1'] = $objPHPExcel->getActiveSheet()->getCell('B6')->getValue();
$content['feature-image-2'] = $objPHPExcel->getActiveSheet()->getCell('B7')->getValue();
$content['feature-image-3'] = $objPHPExcel->getActiveSheet()->getCell('B8')->getValue();
$content['sizes'] = $objPHPExcel->getActiveSheet()->getCell('B10')->getValue();
$content['colors'] = $objPHPExcel->getActiveSheet()->getCell('B12')->getValue();

echo date('H:i:s') , " Generating output file mipdp-". $content['article'] .".xml." , EOL;
$callStartTime = microtime(true);

ob_start();
include('mi-product-template.xml');
$output = ob_get_contents();
ob_end_clean();

file_put_contents("mipdp-". $content['article'] . "-original.xml", $output);

$dom = new DOMDocument;
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($output);
$dom->formatOutput = TRUE;
$dom->save("mipdp-". $content['article'] . ".xml");

$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
echo date('H:i:s') , ' Generated file in  ' , sprintf('%.4f',$callTime) , " seconds" , EOL;


echo date('H:i:s') , " Done" , EOL;
