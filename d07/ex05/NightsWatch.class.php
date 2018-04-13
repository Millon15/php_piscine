<?php
	Class NightsWatch
	{
		private $members = array();

		public function recruit($newMember) {
			if ($newMember instanceof IFighter) {
				$this->members[] = $newMember;
			}
		}

		public function fight() {
			foreach ($this->members as $val) {
				$val->fight();
			}
		}
	}
?>