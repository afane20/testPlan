<?php

// converts the level number to corresponding string description
function levelToString($level)
{
 switch($level)
 {
  case 1:
  $roomLevel = "beginners only";
  break;
  case 2:
  $roomLevel = "intermediate only";
  break;
  case 3:
  $roomLevel = "beginner / intermediate";
  break;
  case 4:
  $roomLevel = "pre-advanced only";
  break;
  case 8:
  $roomLevel = "advanced only";
  break;
  case 12:
  $roomLevel = "pre-advanced / advanced";
  break;
  case 63:
  $roomLevel = "All levels";        
}
return $roomLevel;
}
?>

<?php
include 'loginValid.php';

require_once("dbConnect.php");

$query = "SELECT * FROM resource ORDER BY " . $_GET['sortBy'];

$data = mysql_query( $query );

if ( !$data )
{
  print "Invalid query string: ".mysql_error();
  exit;
}

$rowCount = mysql_num_rows( $data );

?>
<!--<header class="dataHeader resourceHeader">
   <ul>
      <li onclick="resourceList('building')">Building</li>
      <li onclick="resourceList('room')">Room #</li>
      <li onclick="resourceList('level')">Level</li>
      <li onclick="resourceList('startTime')">Start Time</li>
      <li onclick="resourceList('endTime')">End Time</li>
      <li onclick="resourceList('timeIncrement')">Times Inc</li>
      <li onclick="resourceList('pianos')">Pianos</li>
      <li onclick="resourceList('available')">Available</li>
      <li onclick="resourceList('timeslotsBuilt')">Times Built</li>  
   </ul>
 </header>-->
 <table class = "tableData">
  <thead>
    <tr class="dataHeader">
      <th onclick="resourceList('building')">Building</th>
      <th onclick="resourceList('room')">Room #</th>
      <th onclick="resourceList('level')">Level</th>
      <th onclick="resourceList('startTime')">Start Time</th>
      <th onclick="resourceList('endTime')">End Time</th>
      <th onclick="resourceList('timeIncrement')">Times Inc</th>
      <th onclick="resourceList('pianos')">Pianos</th>
      <th onclick="resourceList('available')">Available</th>
      <th onclick="resourceList('timeslotsBuilt')">Times Built</th>  
  </tr>
</thead>
<tbody id="tableBody">
  <?php   
    for($row = 0; $row < $rowCount; $row++)
    {
      $currentRow = mysql_fetch_array( $data );
      $resourceId = $currentRow['resourceId'];
      $building = $currentRow['building'];
      $room = $currentRow['room'];
      $level = $currentRow['level'];
      $startTime = $currentRow['startTime'];
      $endTime = $currentRow['endTime'];
      $timeIncrement = $currentRow['timeIncrement'];
      $pianos = $currentRow['pianos'];
      $available = $currentRow['available'];
      $timeslotsBuilt = $currentRow['timeslotsBuilt'];
      $address = $currentRow['address'];
      $miscInfo = $currentRow['miscInfo'];

      $levelName = levelToString($level);
      switch($available)
      {
      case 'F':
      $displayAvailable = "Festival Day";
      break;
      case 'A':
      $displayAvailable = "Alternate";
      break;
      case 'B':
      $displayAvailable = "Both";
      break;
      case 'N':
      $displayAvailable = "No";
    }

    print "<tr "  . ($odd++ % 2 == 0 ? " class='altRow'":"") . ">";

    print "<td style = 'display:none'>$resourceId</td>";
    print "<td>$building</td>";
    print "<td>$room</td>";
    print "<td>$levelName</td>";
    print "<td>$startTime</td>";
    print "<td>$endTime</td>";
    print "<td>$timeIncrement</td>";
    print "<td>$pianos</td>";
    print "<td>$displayAvailable</td>";
    print "<td style = 'display:none'>$address</td>";
    print "<td style = 'display:none'>$miscInfo</td>";
    print "<td>$timeslotsBuilt</td>";
    print "</tr>";

}
?>
</tbody>
</table>