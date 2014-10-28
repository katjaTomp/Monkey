<?php
class CommandLine {
	private $log = array ();
	private $fontColors = array(
	    // regular
      'gray'         => '30',
      'red'          => '31',
      'green'        => '32',
      'yellow'       => '33',
      'blue'         => '34',
      'purple'       => '35',
      'cyan'         => '36',
      'white'        => '37',
      // light
      'light_gray'   => '90',
      'light_red'    => '91',
      'light_green'  => '92',
      'light_yellow' => '93',
      'light_blue'   => '94',
      'light_purple' => '95',
      'light_cyan'   => '96',
      'light_white'  => '97'
	);
	private $fontStyles = array(
        'regular'      => '0',
        'bold'         => '1',
        'dark'         => '2', // this + gray = black
        'underline'    => '4',
        'invert'       => '7',
        'strike'       => '9'
    );
	private $backgroundColors = array(
        // regular
        'gray'         => '40',
        'red'          => '41',
        'green'        => '42',
        'yellow'       => '43',
        'blue'         => '44',
        'purple'       => '45',
        'cyan'         => '46',
        'white'        => '47',
        // light
        'light_gray'   => '100',
        'light_red'    => '101',
        'light_green'  => '102',
        'light_yellow' => '103',
        'light_blue'   => '104',
        'light_purple' => '105',
        'light_cyan'   => '106',
        'light_white'  => '107'
    );
	
	public function __construct() {
		
	}
	
	public function log($message = '', $level = 'default') {
		// $this->log[time()] = $message;		
		echo $this->colorize(date('H:i:s', time()), 'light_white', 'bold'), ' ', $message, PHP_EOL;
	}
	
	# debug, info, notice, warning, error, critical, alert, emergency, ...
	
	private function colorize($text, $color, $style) {
		if(!array_key_exists($color, $this->fontColors)) {
			$color = 'white';
		}
		
		if(!array_key_exists($style, $this->fontStyles)) {
			$style = 'regular';
		}
		// 0; Styke
		return $text = "\033[" . $this->fontStyles[$style] . ";" . $this->fontColors[$color] . "m" . $text . "\033[0m";
	}
}
?>