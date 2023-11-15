<?php 
//Variable types

//Integers

echo "Integers:"."<br>";

$int_var = 12345;
$another_int = 32 + 12345;

print($another_int);

echo "<br>"."<br>"."<br>";

//Doubles

echo "Doubles:"."<br>";

$many = 2.2888800;
$many_2 = 2.2111200;
$few = $many + $many_2;
print($many + $many_2 = $few);

echo "<br>"."<br>"."<br>";

//Boolean

echo "Boolean:"."<br>";

if (TRUE)
 print("This will always print<br>");
else
 print("This will never print<br>");

 echo "<br>"."<br>"."<br>";

 //Null

 echo "Null:"."<br>";
 $my_var = NULL;

 echo "<br>"."<br>"."<br>";

 //Strings
echo "Strings:"."<br>";
$string_1 = "This is a string in double quotes";
$string_2 = "This is a somewhat longer, singly quoted string";
$string_39 = "This string has thirty-nine characters";
$string_0 = ""; // a string with zero characters

$variable = "name";
$literally = 'My $variable will not print!<br>';
print($literally);
$literally = "My $variable will print!<br>";
print($literally);

echo "<br>"."<br>"."<br>";



//Local Variables
echo "Local Variables:"."<br>";

$x = 4;
function assignx () {
$x = 0;
print "\$x inside function is $x. <br>";}

assignx();
print "\$x outside of function is $x.";

echo "<br>"."<br>"."<br>";


//Function Prameters

echo "Function Parameters:<br>";

function multiply ($value) {
 $value = $value * 10;
 return $value;
}
$retval = multiply (10);
Print "Return value is $retval\n";
echo "<br>"."<br>"."<br>";

//Global Variables

echo "Global Variables:<br>";
$somevar = 15;
function addit() {
GLOBAL $somevar;
$somevar++;
print "Somevar is $somevar";
}
addit();

echo "<br>"."<br>"."<br>";

//Static Variables
echo "Static Variables:<br>";

function keep_track() {
    STATIC $count = 0;
    $count++;
    print $count;
    print "";
}
keep_track();
keep_track();
keep_track();

?>