<?php
	class House
	{
		public function introduce() {
			printf("House %s of %s : \"%s\"\n", $this->getHouseName(), $this->getHouseSeat(), $this->getHouseMotto());
		}
	}
?>