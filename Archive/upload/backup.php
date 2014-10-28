<?php
// The user credentials I will use to login to the WebDav host

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/Amsterdam');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

// Options
$shortopts  = "";
$shortopts .= "e:";
$shortopts .= "u:";
$shortopts .= "p:";
$shortopts .= "m:";
$shortopts .= "f:";
$shortopts .= "h::";

$longopts  = array(
    "environment::",
    "username:",
    "password:",
	"market::",
	"file:",
	"h:"
);
$options = getopt($shortopts, $longopts);

// Validation
foreach (array_keys($options) as $option) switch ($option) {
	case ("e" || "environment"):
		$environment = $options[$option];
    	break;
	case ("u" || "u"):
		die('need username');
    	break;
}

echo $environment, EOL;

exit;


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

$credentials = array(
	'stegetho',
	'spring15'
);

// Prepare the file we are going to upload
$filename = $input;
$filepath = ''.$filename;
$filesize = filesize($filepath);
$fh = fopen($filepath, 'r');

//$remoteUrl = 'https://development.store.adidasgroup.demandware.net/on/demandware.servlet/webdav/Sites/Impex/src/library/';
$remoteUrl = 'https://development.store.adidasgroup.demandware.net/on/demandware.servlet/webdav/Sites/Impex/src/upload/library/';

$locales = array(
	'DE',
	'NL',
	'GB',
	'FR',
	'IT',
	'ES',
	'BE',
	'IE',
	'AT',
	'DK',
	'FI',
	'SE',
	'PL',
	'SK',
	'CZ'	
);




/*
$locales = array(
	'DE'
);
*/


/*

foreach($locales as $local):
	$adjustedFilename = str_replace('.xml', '', $filename) . "-adidas-" . $local . ".xml";

	echo date('H:i:s') , " Uploading $adjustedFilename to adidas-$local" , EOL;
	$callStartTime = microtime(true);
		
	$ch = 	curl_init($remoteUrl . $adjustedFilename);
			curl_setopt($ch, CURLOPT_VERBOSE, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			curl_setopt($ch, CURLOPT_USERPWD, implode(':', $credentials));
	
			$cfile = curl_file_create($filename, mime_content_type($filename), $adjustedFilename);
			$data = array('test_file' => $cfile);
			curl_setopt($ch, CURLOPT_POST,1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			
			if (!curl_exec($ch)) {
			    echo date('H:i:s'), ' Error #', curl_errno($ch), ': ',  curl_error($ch), EOL;
			}
			else {
				$callEndTime = microtime(true);
				$callTime = $callEndTime - $callStartTime;
				echo date('H:i:s') , " Uploaded $adjustedFilename to adidas-$local in ", sprintf('%.4f',$callTime) , EOL;				
			}
					
			curl_close ($ch);
			
endforeach;

fclose($fh);

*/
