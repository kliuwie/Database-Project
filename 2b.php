<?php

// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u17_team02","my+sql=i308u17_team02", "i308u17_team02");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$rf =  mysqli_real_escape_string($conn,$_POST['rf']);
$time =  mysqli_real_escape_string($conn,$_POST['time']);


$sql = "SELECT r.roomid, r.type, rf.feature
FROM room as r, room_feature as rf
WHERE r.roomid = rf.roomid AND
rf.feature = '$rf' AND r.roomid IN (
SELECT r.roomid
FROM room as r, schedule as s, section as st
WHERE r.roomid = s.roomid AND
s.sectionid = st.sectionid AND 
st.start_time <= '$time' AND
st.end_time >= '$time')
";


$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    echo "<table>
    		<tr>
    			<th>Room Id</th>
    			<th>Type</th>
    			<th>Room feature</th>
    		</tr>";
    		
    // output data of each row
    while($row = $result->fetch_assoc()) {

	echo "<tr>
        	<td>".$row["roomid"]."</td>
        	<td>".$row["type"]."</td>
        	<td>".$row["feature"]."</td>
        	</tr>";
       
    }

    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>