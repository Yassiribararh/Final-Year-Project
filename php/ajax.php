<?php


//Database connection.
$con = MySQLi_connect( "localhost","root", "", "phplogin");

//Check connection
if (MySQLi_connect_errno()) {
   echo "Failed to connect to MySQL: " . MySQLi_connect_error();
};

//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {

//Search box value assigning to $Name variable.
   $Name = $_POST['search'];

// My SQL Search query.
   $Query = "SELECT name FROM productsfyp WHERE name LIKE '%$Name%' OR id LIKE '%$Name%' LIMIT 5";

//Query execution
   $ExecQuery = MySQLi_query($con, $Query);

//Creating a UL to display the result.
   echo '
<ul>
   ';

   //Fetching result from the database.
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
       ?>

   <!-- Creating unordered list items.
        Calling javascript function named as "fill" found in "script.js" file.
        By passing fetched result as a parameter. -->
   <li onclick='fill("<?php echo $Result['name']; ?>")'>
   <a>

   <!-- Assigning searched result in "Search box" in "search.php" file. -->
       <?php echo $Result['name']; ?>
   </li></a>

   <!-- Below code is just for closing parenthesis. -->
   <?php
}}
?>
</ul>
