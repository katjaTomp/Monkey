<?php

include('cli.php');

$cli = new Commandline();

$options = getopt("a:b:");

if(empty($options['a']) || empty($options['b']) || !in_array($options['b'], array("adidas", "reebok"))) {
		$cli->log('');
		$cli->log('Monkey needs your asset and a brand!');
		$cli->log('Syntax: downandin.php -b adidas -a assetname');
		$cli->log('');
		exit;
} 
else {
	$cli->log('Monkey is ready for a banane!');
	
	$asset = $options['a'];
	$brand = $options['b'];
}

$locales = array(
	'cs-CZ' => 'cz',
	'da-DK' => 'dk',
	'nl-NL' => 'nl',
	'en-IE' => 'ie',
	'en-GB' => 'co.uk',
	'fi-FI' => 'fi',
	'fr-BE' => 'be',
	'fr-FR' => 'fr',
	'de-DE' => 'de',
	'de-AT' => 'at',
	'it-IT' => 'it',
	'pl-PL' => 'pl',
	'sk-SK' => 'sk',	
	'es-ES' => 'es',
	'sv-SE' => 'se',
);

$domain = array(
	'adidas' => 'http://storefront:vost0k@development.adidas.',
	'reebok' => 'http://www.reebok.',
);


// Check if we require proxy
$proxy = false;
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, "http://www.adidas.de");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_VERBOSE, 0);

if(!curl_exec($ch)) {
	$cli->log('Seems we need a proxy .. logic should also improved to check for adinetwork.');
	$proxy = true;
} 
else {
	$cli->log('No proxy needed');
}

function get_inner_html( $node ) 
{
    $innerHTML= '';
    $children = $node->childNodes;
     
    foreach ($children as $child)
    {
        $innerHTML .= $child->ownerDocument->saveXML( $child );
    }
     
    return $innerHTML;
}

$output = '<?xml version="1.0" encoding="UTF-8"?>
		<library xmlns="http://www.demandware.com/xml/impex/library/2006-10-31">
		  <content content-id="' . $asset . '">
		    <online-flag>true</online-flag>
		    <searchable-flag>false</searchable-flag>
		    <page-attributes/>
		    <custom-attributes>';

foreach($locales as $locale => $topleveldomain):
	$request = $domain[$brand] . $topleveldomain . "/" . $asset . ".html?view=ajax";
	
	$cli->log($request);
	
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $request);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_VERBOSE, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	if($proxy) {
			curl_setopt($ch, CURLOPT_PROXY, '10.129.10.50:8080');  
	}
    
	$html = curl_exec($ch);

	if($html) {
		$cli->log('Downloaded');
		
		$dom = new DomDocument();
		$dom->loadHtml( $html );
		$dom->preserveWhiteSpace = false;
		
		$nodes = $dom->getElementsByTagName('div');
		
		
		$output .= '<custom-attribute attribute-id="body" xml:lang="'. $locale .'">'. htmlentities(get_inner_html($nodes->item(0)), ENT_XML1, 'UTF-8') .'</custom-attribute>';
				
		
	} else {
		$cli->log(curl_errno($ch) . " " . curl_error($ch) . " - monkey failed");
		exit;
	}
	curl_close($ch);
endforeach;


$output .= '
    </custom-attributes>
  </content>
</library>';

file_put_contents($asset . ".xml", $output);
