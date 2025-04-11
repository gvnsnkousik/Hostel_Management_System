<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1.0">
    <title>Hostel Management System</title>
    <link rel="stylesheet" href="HMS_Success.css">
</head>
<style>
    table,td,th,tr{
        border-collapse:collapse;
        border:solID 1px black;
        padding:10px;
    }
    tr:nth-child(even) {
        background-color: #D6EEEE;
    }
    </style>
<body>
    <h2>Display of the Hostel Database</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th style="padding-left:30px;padding-right:30px">DOB</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Contact_Number</th>
            <th>Email_ID</th>
            <th>Guardian_Name</th>
            <th>Relation</th>
            <th>Guardian_Number</th>
            <th>Guardian_Email</th>
            <th>Guardian_Address</th>
            <th>Plan</th>
            <th>Amount</th>
            <th>Payment_Date</th>
            <th>Payment_Mode</th>
            <th>Room_Number</th>
            <th>Floor</th>
            <th>Block</th>
            <th>Company_Name</th>
            <th>Company_Address</th>
            <th>Company_Number</th>
            <th>Designation</th>
        </tr>
        <?php
        $Hostel= mysqli_connect("localhost","root","","Hostel");
        if($Hostel->connect_error)
        {
            die("Connection failed:" . $Hostel->connect_error);
        }
        $query="SELECT t1.*, t2.*, t3.*, t4.*, t5.*
                FROM resident_view t1
                JOIN guardian_view t2 ON t1.ID = t2.ID
                JOIN rent_view t3 ON t1.ID = t3.ID
                JOIN room_view t4 ON t1.ID = t4.ID
                JOIN work_view t5 ON t1.ID = t5.ID;";
        $res=$Hostel->query($query);
        if($res->num_rows > 0)
        {
            while($row = $res->fetch_assoc())
            {
                echo "<tr>";
                echo "<td>". $row["ID"] ."</td>";
                echo "<td>". $row["Name"] ."</td>";
                echo "<td>". $row["DOB"] ."</td>";
                echo "<td>". $row["Age"] ."</td>";
                echo "<td>". $row["Gender"] ."</td>";
                echo "<td>". $row["Contact_Number"] ."</td>";
                echo "<td>". $row["Email_ID"] ."</td>";
                echo "<td>". $row["Guardian_Name"] ."</td>";
                echo "<td>". $row["Relation"] ."</td>";
                echo "<td>". $row["Guardian_Number"] ."</td>";
                echo "<td>". $row["Guardian_Email"] ."</td>";
                echo "<td>". $row["Guardian_Address"]."</td>";
                echo "<td>". $row["Plan"] ."</td>";
                echo "<td>". $row["Amount"] ."</td>";
                echo "<td>". $row["Payment_Date"] ."</td>";
                echo "<td>". $row["Payment_Mode"] ."</td>";
                echo "<td>". $row["Room_Number"] ."</td>";
                echo "<td>". $row["Floor"] ."</td>";
                echo "<td>". $row["Block"] ."</td>";
                echo "<td>". $row["Company_Name"] ."</td>";
                echo "<td>". $row["Company_Address"] ."</td>";
                echo "<td>". $row["Company_Number"] ."</td>";
                echo "<td>". $row["Designation"] ."</td>";
                echo "</tr>";
            }
        }
        else
        {
            echo "<tr><td colspan='23'>0 result</td></tr>";
        }
        $Hostel->close();
        ?>
    </table>
    <button type="button" onclick="window.open('HMS_Main.html', '_self');" style="display:block;margin-top:40px; text-align:center;">Exit</button>
</body>
</html>
