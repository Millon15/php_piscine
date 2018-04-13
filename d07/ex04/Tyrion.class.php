<?php
	class Tyrion extends Lannister
	{
		public function sleepWith($person) {
			if (is_subclass_of($person, Lannister)) {
				print("Not even if I'm drunk !" . PHP_EOL);
			}
			else {
				print("Let's do this." . PHP_EOL);
			}
		}
	}
?>