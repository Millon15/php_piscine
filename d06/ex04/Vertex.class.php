<?php
	require_once 'Color.class.php';

	class Vertex {
		public static $verbose = false;
		public static function doc()
		{
			return file_get_contents('Vertex.doc.txt');
		}


		private $_x;
		private $_y;
		private $_z;
		private $_w;
		private $_color;


		public function __construct( $arr )
		{
			$this->_x = $arr['x'];
			$this->_y = $arr['y'];
			$this->_z = $arr['z'];
			$this->_w = isset($arr['w']) ? $arr['w'] : 1.0;
			$this->_color = isset($arr['color']) ? $arr['color'] : new Color( array( 'rgb' => 0xffffff ) );

			if (Self::$verbose) {
				echo $this->__toString() . ' constructed' . PHP_EOL;
			}
		}
		public function __destruct()
		{
			if (Self::$verbose) {
				echo $this->__toString() . ' destructed' . PHP_EOL;
			}
		}
		public function __toString()
		{
			if (Self::$verbose) {
				return sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s )", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
			}
			else {
				return sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )", $this->_x, $this->_y, $this->_z, $this->_w);
			}
		}


		public function getX()
		{
			return $this->_x;
		}
		public function getY()
		{
			return $this->_y;
		}
		public function getZ()
		{
			return $this->_z;
		}
		public function getW()
		{
			return $this->_w;
		}
		public function getColor()
		{
			return $this->_color;
		}
	}
?>
