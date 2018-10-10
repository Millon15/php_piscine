<?php
	require_once 'Matrix.class.php';

	class Camera
	{
		static $verbose = false;
		static function doc()
		{
			return file_get_contents('Camera.doc.txt');
		}


		private $_position;
		private $_translate_rotate_matrix;
		private $_translate_matrix;
		private $_project_matrix;
		private $_rotate_matrix;
		private $_matrix;
		private $_width;
		private $_height;


		function __construct( array $tab )
		{
			$this->_position = $tab["origin"];
			$this->_translate_matrix = new Matrix( array(
			"preset" => Matrix::TRANSLATION, "vtc" => (new Vector(array("dest" => $this->_position)))->opposite() ));
			$this->_rotate_matrix = $tab["orientation"];
			if ( isset($tab["ratio"]) ) {
				$ratio = $tab["ratio"];
				$this->_width = 1920;
				$this->_height = 1920 / $ratio;
			}
			else {
				$ratio = $tab["width"] / $tab["height"];
				$this->_width = $tab["width"];
				$this->_height = $tab["height"];
			}
			$fov = $tab["fov"];
			$near = $tab["near"];
			$far = $tab["far"];
			$this->_translate_rotate_matrix = $this->_rotate_matrix->mult( $this->_translate_matrix );
			$this->_project_matrix = new Matrix( array(
			"preset" => Matrix::PROJECTION, "fov" => $fov, "ratio" => $ratio, "far" => $far, "near" => $near) );

			if (Self::$verbose) {
				echo 'Camera instance constructed' . PHP_EOL;
			}
		}
		function __destruct()
		{
			if (Self::$verbose) {
				echo 'Camera instance destructed' . PHP_EOL;
			}
		}
		function __toString()
		{
			$tmp  = 'Camera(' . PHP_EOL;
			$tmp .= '+ Origine: ' . $this->_position . PHP_EOL;
			$tmp .= '+ tT:' . PHP_EOL;
			$tmp .= $this->_translate_matrix . PHP_EOL;
			$tmp .= '+ tR:' . PHP_EOL;
			$tmp .= $this->_rotate_matrix . PHP_EOL;
			$tmp .= '+ tR->mult( tT ):' . PHP_EOL;
			$tmp .= $this->_translate_rotate_matrix . PHP_EOL;
			$tmp .= '+ Proj:' . PHP_EOL;
			$tmp .= $this->_project_matrix . PHP_EOL;
			$tmp .= ')';
			return ($tmp);
		}


		function watchVertex( Vertex $vertex ) {
			$vertex = $this->_project_matrix->transformVertex( $this->_translate_rotate_matrix->transformVertex($vertex) );
			$vertex->__set('x', ($vertex->__get('x') / ($this->_width / 2)) - 1);
			$vertex->__set('y', ($vertex->__get('y') / ($this->_height / 2)) - 1);
			return $vertex;
		}
		function watchTriangle( Triangle $triangle ) {
			$v1 = $this->watchVertex( $triangle->__get('v1') );
			$v2 = $this->watchVertex( $triangle->__get('v2') );
			$v3 = $this->watchVertex( $triangle->__get('v3') );
			return new Triangle( array('A' => $v1, 'B' => $v2, 'C' => $v3) );
		}
		function watchMesh( array $mesh ) {
			$new = array();
			foreach ($mesh as $triangle) {
				array_push($new, $this->watchTriangle($triangle));
			}
			return $new;
		}
	}
?>
