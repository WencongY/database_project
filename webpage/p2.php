<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Wencong and Kaley's PHP-MySQL Program</title>
  <link rel="stylesheet" href="project.css">
  <style>
  table {
    border: thin solid;
    padding: 0.5px;
    text-align: center;
  }

  td, th {
    border: thin solid;
    padding: 4px;
    text-align: center;
  }
  </style>
  </head>

  <body>

<section class="b">
  <hr>


<?php

$seg_name = $_POST['fname'];

$seg_name = mysqli_real_escape_string($conn, $seg_name);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = 'SELECT CONCAT(fname, " ", lname) AS Name, SUM(Distance)/1609 AS Distance, Type FROM athlete
	RIGHT JOIN activity USING(AthleteId)
WHERE fname= ';
$query = $query."'".$seg_name."'";
$query = $query."group by Type, Name";

?>


<h3 class="a">
The query:
</h3>
<p>
<?php
print $query;
?>
</p>

<hr>

<h3 class="a">
Result of query:
</h3>

<table>
  <tr>
    <th>Athlete Name</th>
    <th>Distance(mile)</th>
    <th>Activity Type</th>
  </tr>
  <tr>



<!-- <p>Athlete Name | Distance(miles) | Activity Type</p> -->
<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    // print "$row[Name]";
    // print "$row[Name] | $row[Distance] | $row[Type]";
    print "<td> $row[Name] </td>";
    print "<td> $row[Distance] </td>";
    print "<td> $row[Type] </td> </tr>";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

</table>
<br>
<hr>

<br><br>
<a href="project.html">back to homepage</a>

</section>
</body>
</html>
