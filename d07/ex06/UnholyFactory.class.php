<?php
	class UnholyFactory {
		private $fighters = Array();

		public function absorb($newFighter) {
			if ($newFighter instanceof Fighter) {
				$newFighterName = $newFighter->fighterType;

				if (in_array($newFighter, $this->fighters))
					print("(Factory already absorbed a fighter of type " . $newFighterName . ")" . PHP_EOL);
				else {
					print("(Factory absorbed a fighter of type " . $newFighterName . ")" . PHP_EOL);
					$this->fighters["$newFighterName"] = $newFighter;
				}
			}
			else {
				print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
			}
		}

		public function fabricate($fighterToFabricate) {
			$to_fabricate = false;
			foreach ($this->fighters as $key => $val) {
				if ($fighterToFabricate == $key) {
					$to_fabricate = true;
					break ;
				}
			}

			if ($to_fabricate) {
				print("(Factory fabricates a fighter of type " . $fighterToFabricate . ")" . PHP_EOL);
				return (new $this->fighters["$fighterToFabricate"]);
			}
			else
				print("(Factory hasn't absorbed any fighter of type " . $fighterToFabricate . ")" . PHP_EOL);
		}
	}
?>