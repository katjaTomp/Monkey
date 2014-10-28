<?php

if(count($argv) < 3) {
		fwrite(STDOUT, "\n");
		fwrite(STDOUT, "-----------------------------------------------------\n");
		fwrite(STDOUT, "Hey! I need some arguments to work :-/\n");
		fwrite(STDOUT, "\n");
		fwrite(STDOUT, "Usage: input.xml output.xml\n");
		fwrite(STDOUT, "-----------------------------------------------------\n");		
		fwrite(STDOUT, "\n");
		exit;
}

$input = $argv[1];
$output = $argv[2];

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

$nodes = $xmldoc->getElementsByTagName('slot-configuration');
$length = $nodes->length;

for ($i= $length-1; $i>=0; $i--) {
	$node = $nodes->item($i);
	
    if (!(strpos($node->getAttribute('configuration-id'),'-default') !== false)) {
		$node->parentNode->removeChild($node);
    }
}


$xmldoc->save($output);