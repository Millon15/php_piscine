<?php
	require_once 'Vector.class.php';

	class Matrix {
		static $verbose = false;
		static function doc()
		{
			return file_get_contents('Matrix.doc.txt');
		}


		const IDENTITY = 'IDENTITY';
		const SCALE = 'SCALE';
		const TRANSLATION = 'TRANSLATION';
		const PROJECTION = 'PROJECTION';
		const RX = 'Ox ROTATION';
		const RY = 'Oy ROTATION';
		const RZ = 'Oz ROTATION';

		protected $matrix = array();
		private $_a;

		function __construct( $arr = null )
		{
			if ( $this->checker($arr) ) {
				$this->_a = $arr;
				$this->check_preset($arr);
				
				if (Self::$verbose) {
					if ($arr['preset'] == Self::IDENTITY) {
						echo 'Matrix ' . $arr['preset'] . ' instance constructed' . PHP_EOL;
					}
					else {
						echo 'Matrix ' . $arr['preset'] . ' preset instance constructed' . PHP_EOL;
					}
				}
			}
		}
		function __destruct()
		{
			if (Self::$verbose) {
				echo 'Matrix instance destructed' . PHP_EOL;
			}
		}
		function __toString()
		{
			$tmp  = "M | vtcX | vtcY | vtcZ | vtxO\n";
			$tmp .= "-----------------------------\n";
			$tmp .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
			$tmp .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
			$tmp .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
			$tmp .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
			return ( vsprintf($tmp, array(
				$this->matrix[0], $this->matrix[1], $this->matrix[2], $this->matrix[3], $this->matrix[4], $this->matrix[5],
				$this->matrix[6], $this->matrix[7], $this->matrix[8], $this->matrix[9], $this->matrix[10], $this->matrix[11],
				$this->matrix[12], $this->matrix[13], $this->matrix[14], $this->matrix[15]
			)));
		}


		private function checker( $arr )
		{
			if (
				!isset($arr) || !isset($arr['preset']) || empty($arr['preset'])
				|| ($arr['preset'] == Self::SCALE && !isset($arr['scale']))
				|| (($arr['preset'] == Self::RX || $arr['preset'] == Self::RY || $arr['preset'] == Self::RZ)
					&& !isset($arr['angle']))
				|| ($arr['preset'] == Self::TRANSLATION && !isset($arr['vtc']))
				|| ($arr['preset'] == Self::PROJECTION
					&& (!isset($arr['fov']) || !isset($arr['ratio']) || !isset($arr['near']) || !isset($arr['far'])))
			) {
				return false;
			}
			return true;
		}
		private function check_preset( $arr )
		{
			switch ($arr['preset']) {
				case (self::IDENTITY) :
					$this->identity(1);
					break;
				case (self::TRANSLATION) :
					$this->translation();
					break;
				case (self::SCALE) :
					$this->identity($this->_a['scale']);
					break;
				case (self::RX) :
					$this->rotation_x();
					break;
				case (self::RY) :
					$this->rotation_y();
					break;
				case (self::RZ) :
					$this->rotation_z();
					break;
				case (self::PROJECTION) :
					$this->projection();
					break;
			}
		}
		private function identity( $scale )
		{
			$this->matrix[0] = $scale;
			$this->matrix[5] = $scale;
			$this->matrix[10] = $scale;
			$this->matrix[15] = 1;
		}
		private function translation()
		{
			$this->identity(1);
			$this->matrix[3] = $this->_a['vtc']->getX();
			$this->matrix[7] = $this->_a['vtc']->getY();
			$this->matrix[11] = $this->_a['vtc']->getZ();
		}
		private function rotation_x()
		{
			$this->identity(1);
			$this->matrix[0] = 1;
			$this->matrix[5] = cos($this->_a['angle']);
			$this->matrix[6] = -sin($this->_a['angle']);
			$this->matrix[9] = sin($this->_a['angle']);
			$this->matrix[10] = cos($this->_a['angle']);
		}
		private function rotation_y()
		{
			$this->identity(1);
			$this->matrix[0] = cos($this->_a['angle']);
			$this->matrix[2] = sin($this->_a['angle']);
			$this->matrix[5] = 1;
			$this->matrix[8] = -sin($this->_a['angle']);
			$this->matrix[10] = cos($this->_a['angle']);
		}
		private function rotation_z()
		{
			$this->identity(1);
			$this->matrix[0] = cos($this->_a['angle']);
			$this->matrix[1] = -sin($this->_a['angle']);
			$this->matrix[4] = sin($this->_a['angle']);
			$this->matrix[5] = cos($this->_a['angle']);
			$this->matrix[10] = 1;
		}
		private function projection()
		{
			$this->identity(1);
			$this->matrix[5] = 1 / tan(0.5 * deg2rad($this->_a['fov']));
			$this->matrix[0] = $this->matrix[5] / $this->_a['ratio'];
			$this->matrix[10] = -1 * (-$this->_a['near'] - $this->_a['far']) / ($this->_a['near'] - $this->_a['far']);
			$this->matrix[14] = -1;
			$this->matrix[11] = (2 * $this->_a['near'] * $this->_a['far']) / ($this->_a['near'] - $this->_a['far']);
			$this->matrix[15] = 0;
		}


		function transformVertex( Vertex $vtx )
		{
			$tmp = array();
			$tmp['x'] = $vtx->getX() * $this->matrix[0] + $vtx->getY() * $this->matrix[1]
						+ $vtx->getZ() * $this->matrix[2] + $vtx->getW() * $this->matrix[3];
			$tmp['y'] = $vtx->getX() * $this->matrix[4] + $vtx->getY() * $this->matrix[5]
						+ $vtx->getZ() * $this->matrix[6] + $vtx->getW() * $this->matrix[7];
			$tmp['z'] = $vtx->getX() * $this->matrix[8] + $vtx->getY() * $this->matrix[9]
						+ $vtx->getZ() * $this->matrix[10] + $vtx->getW() * $this->matrix[11];
			$tmp['w'] = $vtx->getX() * $this->matrix[11] + $vtx->getY() * $this->matrix[13]
						+ $vtx->getZ() * $this->matrix[14] + $vtx->getW() * $this->matrix[15];
			$tmp['color'] = $vtx->getColor();
			return new Vertex($tmp);
		}
		function mult( Matrix $rhs )
		{
			$tmp = array();
			for ($i = 0; $i < 16; $i += 4) {
				for ($j = 0; $j < 4; $j++) {
					$tmp[$i + $j] = 0;
					$tmp[$i + $j] += $this->matrix[$i + 0] * $rhs->matrix[$j + 0];
					$tmp[$i + $j] += $this->matrix[$i + 1] * $rhs->matrix[$j + 4];
					$tmp[$i + $j] += $this->matrix[$i + 2] * $rhs->matrix[$j + 8];
					$tmp[$i + $j] += $this->matrix[$i + 3] * $rhs->matrix[$j + 12];
				}
			}
			$matrice = new Matrix();
			$matrice->matrix = $tmp;
			return $matrice;
		}
	}
?>
