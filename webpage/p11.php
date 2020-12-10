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

<section class="d">
  <hr>


<?php

$seg_name = $_POST['fname'];

$seg_name = mysqli_real_escape_string($conn, $seg_name);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT segCount, actId, actDist/1609 as miles FROM (
  SELECT COUNT(segment.SegmentId) AS segCount, activity.ActivityId AS actId, activity.Distance AS actDist, fname FROM athlete
  RIGHT JOIN athlete_activity_segment USING(AthleteId)
  RIGHT JOIN activity USING(ActivityId)
  RIGHT JOIN segment USING(SegmentId)
  WHERE fname='".$seg_name."' GROUP BY activity.ActivityId, activity.Distance) temp ORDER BY segCount desc limit 5;";


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
    <th>Segment Count</th>
    <th>Activity ID</th>
    <th>Activity Distance(mile)</th>
    <!-- <th>Athlete Name</th> -->
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
    print "<td> $row[segCount] </td>";
    print "<td> $row[actId] </td>";
    print "<td> $row[miles] </td></tr>";
    // print "<td> $row[fname] </td> ";
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
