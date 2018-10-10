<?php
	require_once 'Vertex.class.php';

	class Vector {
		public static $verbose = false;
		public static function doc()
		{
			return file_get_contents('Vector.doc.txt');
		}


		private $_x;
		private $_y;
		private $_z;
		private $_w = 0.0;


		public function __construct( $arr )
		{
			if (isset($arr['dest']) && $arr['dest'] instanceof Vertex) {
				if (isset($arr['orig']) && $arr['orig'] instanceof Vertex) {
					$orig = $arr['orig'];
				}
				else {
					$orig = new Vertex( array('x' => 0, 'y' => 0, 'z' => 0, 'w' => 1) );
				}
				$this->_x = $arr['dest']->getX() - $orig->getX();
				$this->_y = $arr['dest']->getY() - $orig->getY();
				$this->_z = $arr['dest']->getZ() - $orig->getZ();
			}

			if (Self::$verbose) {
				echo $this . ' constructed' . PHP_EOL;
			}
		}
		public function __destruct()
		{
			if (Self::$verbose) {
				echo $this . ' destructed' . PHP_EOL;
			}
		}
		public function __toString()
		{
			return sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )", $this->_x, $this->_y, $this->_z, $this->_w);
		}


		public function magnitude()
		{
			return (float)sqrt($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z);
		}
		public function normalize()
		{
			$magn = $this->magnitude();
			if ($magn == 1) {
				return clone $this;
			}
			return new Vector(array( 'dest' => new Vertex(array(
				'x' => $this->_x / $magn, 'y' => $this->_y / $magn, 'z' => $this->_z / $magn
			))));
		}
		public function add( Vector $v )
		{
			return new Vector(array( 'dest' => new Vertex(array(
				'x' => $this->_x + $v->getX(), 'y' => $this->_y + $v->getY(), 'z' => $this->_z + $v->getZ()
			))));
		}
		public function sub( Vector $v )
		{
			return new Vector(array( 'dest' => new Vertex(array(
				'x' => $this->_x - $v->getX(), 'y' => $this->_y - $v->getY(), 'z' => $this->_z - $v->getZ()
			))));
		}
		public function opposite()
		{
			return new Vector(array( 'dest' => new Vertex(array(
				'x' => $this->_x * -1, 'y' => $this->_y * -1, 'z' => $this->_z * -1
			))));
		}
		public function scalarProduct($k)
		{
			return new Vector(array( 'dest' => new Vertex(array(
				'x' => $this->_x * $k, 'y' => $this->_y * $k, 'z' => $this->_z * $k
			))));
		}
		public function dotProduct( Vector $v )
		{
			return (float)($this->_x * $v->getX() + $this->_y * $v->getY() + $this->_z * $v->getZ());
		}
		public function cos( Vector $v )
		{
			$a = $this->_x * $v->getX() + $this->_y * $v->getY() + $this->_z * $v->getZ();
			$b = $this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z;
			$c = $v->getX() * $v->getX() + $v->getY() * $v->getY() + $v->getZ() * $v->getZ();
			return ($a / sqrt($b * $c));
		}
		public function crossProduct( Vector $v )
		{
			return new Vector(array('dest' => new Vertex(array(
				'x' => $this->_y * $v->getZ() - $this->_z * $v->getY(),
				'y' => $this->_z * $v->getX() - $this->_x * $v->getZ(),
				'z' => $this->_x * $v->getY() - $this->_y * $v->getX()
			))));
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
	}
?>
