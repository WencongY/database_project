<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Wencong and Kaley's PHP-MySQL Program</title>
  </head>

  <body bgcolor="white">


  <hr>


<?php

$seg_name = $_POST['Name'];

$seg_name = mysqli_real_escape_string($conn, $seg_name);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT SegmentId, Name, AverageGrade FROM segment
	WHERE Name = ";
$query = $query."'".$seg_name."';";

?>

<p>
The query:
<p>
<?php
print $query;
?>

<hr>
<p>
Result of query:
<p>

<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    // print "$row[Name]";
    print "$row[SegmentId] $row[Name] $row[AverageGrade]"
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="findCustManu.txt" >Contents</a>
of the PHP program that created this page.

</body>
</html>
