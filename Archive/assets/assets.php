<?php

if(count($argv) < 4) {
		fwrite(STDOUT, "\n");
		fwrite(STDOUT, "-----------------------------------------------------\n");
		fwrite(STDOUT, "Hey! I need some arguments to work :-/\n");
		fwrite(STDOUT, "\n");
		fwrite(STDOUT, "Usage: input.xml output.xml asset1 asset2 asset3\n");
		fwrite(STDOUT, "-----------------------------------------------------\n");		
		fwrite(STDOUT, "\n");
		exit;
}

$input = $argv[1];
$output = $argv[2];

$assets = array();
for ($i = 3; $i < count($argv); $i++) {
    $assets[] = $argv[$i];
}

if(!file_exists($input)) {
	fwrite(STDOUT, "\n");
	fwrite(STDOUT, "-----------------------------------------------------\n");
	fwrite(STDOUT, "Input doesn't exist :-/\n");
	fwrite(STDOUT, "-----------------------------------------------------\n");		
	fwrite(STDOUT, "\n");
	exit;	
}

//echo print_r($assets);

$xmldoc = new DOMDocument('1.0');
$xmldoc->preserveWhiteSpace = false;
$xmldoc->formatOutput = true;

$xmldoc->load($input);


$root   = $xmldoc->documentElement;
$fnode  = $root->firstChild;

// Remove folders
$nodes = $xmldoc->getElementsByTagName('folder');
$length = $nodes->length;

for ($i= $length-1; $i>=0; $i--) {
	$node = $nodes->item($i);
	$node->parentNode->removeChild($node);
}

$nodes = $xmldoc->getElementsByTagName('content');
$length = $nodes->length;

for ($i= $length-1; $i>=0; $i--) {
	$node = $nodes->item($i);
	
    if (!in_array($node->getAttribute('content-id'), $assets)) {
		$node->parentNode->removeChild($node);
    }
}


$xmldoc->save($output);