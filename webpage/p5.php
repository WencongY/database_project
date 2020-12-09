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

$seg_name = $_POST['button1'];

$seg_name = mysqli_real_escape_string($conn, $seg_name);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = 'SELECT sum(MovingTime)/3600 as total_active_time, Type
FROM activity
group by Type
order by total_active_time DESC';

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
    <th>Total Active Time(hr)</th>
    <th>Activity Type</th>
  </tr>
  <tr>


<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    // print "$row[Name]";
    print "<td> $row[total_active_time] </td>";
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
