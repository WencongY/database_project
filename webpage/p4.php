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

<section class="c">


  <hr>


<?php

$seg_name = $_POST['lname'];

$seg_name = mysqli_real_escape_string($conn, $seg_name);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = 'SELECT act.Type, sum(act.MovingTime)/3600 as total_active_time, sum(act.Distance)/1609 as total_distance, g.Name FROM activity act
	JOIN gear g ON act.GearId = g.GearId AND act.AthleteId = g.AthleteId
	JOIN athlete ath ON act.AthleteId = ath.AthleteId AND g.AthleteId=ath.AthleteId
where ath.lname = ';
$query = $query."'".$seg_name."'";
$query = $query." group by act.Type, g.Name";

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
    <th>Activity Type</th>
    <th>Total Active Time(hr)</th>
    <th>Total Distance(mile)</th>
    <th>Gear Name</th>
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
    print "<td> $row[Type] </td>";
    print "<td> $row[total_active_time] </td>";
    print "<td> $row[total_distance] </td>";
    print "<td> $row[Name] </td></tr>";
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
