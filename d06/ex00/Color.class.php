<?php
	class Color {
		public $red;
		public $green;
		public $blue;

		public static $verbose = false;

		public function __constructor($arr)
		{
			$i = count($arr);
			if ($i == 1) {
				$this->blue = $arr['rgb'] % 16^2;
				$this->green = intval($arr['rgb'] / 16^2) % 16^2;
				$this->red = intval($arr['rgb'] / 16^4) / 16^2;
			}
			else if ($i == 3) {
				$this->red = $arr['red'];
				$this->green = $arr['green'];
				$this->blue = $arr['blue'];
			}

			if (Self::verbose) {
				printf("Color( red: %3d, green: %3d, blue: %3d) constructed.", $this->red, $this->green, $this->blue);
			}
		}

		public	function __toString()
		{
			return sprintf("Color( red: %3d, green: %3d, blue: %3d)", $this->red, $this->green, $this->blue);;
		}

		public function add(Color $clr)
		{
			$r = $this->red + $clr->red;
			$g = $this->green + $clr->green;
			$b = $this->blue + $clr->blue;
			$new = new Color(array('red' => $r, 'green' => $g, 'blue' => $b));
			return $new;
		}

		public function __destructor()
		{
			if (Self::verbose) {
				printf("Color( red: %3d, green: %3d, blue: %3d) destructed.", $this->red, $this->green, $this->blue);
			}
		}
	}

	$color = new Color(array('rgb' => 0x121314));
	$color2 = new Color(array('rgb' => 0xaaBBcc));
	$color3 = $color->add($color2);
?>