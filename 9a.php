<?php

// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u17_team02","my+sql=i308u17_team02", "i308u17_team02");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




$sql = "SELECT m.title, d.name, m.credits_req, m.overall
FROM major as m, department as d
WHERE m.departmentid = d.departmentid;
";


$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    echo "<table>
    		<tr>
    			<th>Title</th>
    			<th>Name</th>
    			<th>Credits Requirement</th>
    			<th>Overall</th>
    			
    		</tr>";
    		
    // output data of each row
    while($row = $result->fetch_assoc()) {

	echo "<tr>
        	<td>".$row["title"]."</td>
        	<td>".$row["name"]."</td>
        	<td>".$row["credits_req"]."</td>
        	<td>".$row["overall"]."</td>
    
        	</tr>";
       
    }

    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>