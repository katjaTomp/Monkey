<?php

include('cli.php');

$cli = new Commandline();

//$url = 'https://development.store.adidasgroup.demandware.net/on/demandware.servlet/webdav/Sites/Libraries/adidas-GB/default/';

$options = getopt("f:u:p:b:e:t:");

if(empty($options['f']) || empty($options['u']) || empty($options['p']) || !in_array($options['b'], array("adidas", "reebok")) || !in_array($options['e'], array("development", "staging")) || !in_array($options['t'], array("slots", "assets"))) {
		$cli->log('');
		$cli->log('Monkey needs your username, your password and a file!');
		$cli->log('Syntax: up.php -b adidas|reebok -e development|staging -u stegetho -p awesome -t slots|assets -f filename.ext');
		$cli->log('');
		exit;
} 
else {
	$cli->log('Monkey is ready for a banane!');
	
	$filename = $options['f'];
	
	$folder = ($options['t'] == 'assets' ? 'library' : 'slots');
		
	if($options['b'] == 'adidas') {				
		$url = 'https://' . $options['e'] . '.store.adidasgroup.demandware.net/on/demandware.servlet/webdav/Sites/Impex/src/upload/'. $folder .'/';
		$locales = array('DE', 'NL', 'GB', 'FR', 'IT', 'ES', 'BE', 'IE', 'AT', 'DK', 'FI', 'SE', 'PL', 'SK', 'CZ');
	}
	else {
		$url = 'https://' . $options['e'] . '.reebok.adidasgroup.demandware.net/on/demandware.servlet/webdav/Sites/Impex/src/upload/'. $folder .'/';
		$locales = array('DE', 'NL', 'GB', 'FR', 'IT', 'ES', 'BE', 'IE', 'AT', 'DK', 'FI', 'SE');
		$options['b'] = 'Reebok';
	}
}

if(!file_exists($filename)) {
	$cli->log('Monkey didn\'t find this file ');
	exit;	
}

// Prepare the file we are going to upload
$filepath = './'.$filename;
$filesize = filesize($filepath);
$content = file_get_contents($filepath);


// The URL where we will upload to, this should be the exact path where the file
// is going to be placed
$remoteUrl = $url;

// Initialize cURL and set the options required for the upload. We use the remote
// path we specified together with the filename. This will be the result of the
// upload.

// I'm setting each option individually so it's easier to debug them when
// something goes wrong. When your configuration is done and working well
// you can choose to use curl_setopt_array() instead.

// Set the authentication mode and login credentials
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);



foreach($locales as $locale):
	$ch = curl_init();

	$pos = strrpos($filename, "."); 
	$adjustedFilename = substr($filename, 0, $pos) . '-' . $options['b'] . '-' . $locale . substr($filename, $pos);  	

	curl_setopt($ch, CURLOPT_USERPWD, $options['u'] . ':' . $options['p'] );
	curl_setopt($ch, CURLOPT_URL, $remoteUrl . $adjustedFilename);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Monkey/0.1');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: ' . mime_content_type($filepath),'Content-Length: ' . $filesize));
	curl_setopt($ch, CURLOPT_VERBOSE, false);	
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	if(curl_exec($ch)) {
		$cli->log($adjustedFilename . " uploaded.");
	} else {
		$cli->log(curl_errno($ch) . " " . curl_error($ch) . " - monkey failed");
		exit;
	}
	curl_close($ch);	
endforeach;

$cli->log("Monkey is done. Files are uploaded. Give him a banana!");