<?php

include_once('Lannister.class.php');
include_once('Jaime.class.php');
include_once('Tyrion.class.php');

class Stark {
}

class Cersei extends Lannister {
}

class Sansa extends Stark {
}

$jamie = new Jaime();
$cersei = new Cersei();
$tyrion = new Tyrion();
$sansa = new Sansa();

$jamie->sleepWith($tyrion);
$jamie->sleepWith($sansa);
$jamie->sleepWith($cersei);

$tyrion->sleepWith($jamie);
$tyrion->sleepWith($sansa);
$tyrion->sleepWith($cersei);

?>
