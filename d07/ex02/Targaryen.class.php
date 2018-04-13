<?php
	class Targaryen
	{
		public function getBurned() {
			if ($this->resistsFire() == FALSE) {
				return "burns alive";
			}
			else {
				return "emerges naked but unharmed";
			}
		}

		public function resistsFire() {
			return FALSE;
		}
	}
?>