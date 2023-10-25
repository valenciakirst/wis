<?php

//Constants

//Example
echo "Constant() Example:<br>";
define("MINSIZE", 50);
echo MINSIZE;
echo "<br>";
echo constant("MINSIZE"); 

echo "<br>"."<br>"."<br>";

//Constant names
echo "Constant Names: <br>";
// Valid constant names
define("ONE", "first thing");
define("TWO2", "second thing");
define("THREE_3", "third thing");
echo ONE."<br>";
echo TWO2."<br>";
echo THREE_3."<br>";
