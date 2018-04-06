<?php

class Lannister {
	public function __construct() {
		print("A Lannister is born ! Woah" . PHP_EOL); 
	}
	public function getSize() {
		return "Average yo";
	}
	public function houseMotto() {
		return "I like to roar!";
	}
}

include('Tyrion.class.php');

$tyrion = new Tyrion();

print($tyrion->getSize() . PHP_EOL);
print($tyrion->houseMotto() . PHP_EOL);

?>