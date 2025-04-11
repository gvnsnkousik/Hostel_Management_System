<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $Room_Number = $_POST['Room_Number'] ?? '';
    $Floor = $_POST['Floor'] ?? '';
    $Block = $_POST['Block'] ?? '';
    
    $check=array("1"=>4,"2"=>4,"3"=>4,"4"=>4,"5"=>5);
    if($check[$Room_Number]>0)
    {
        $check[$Room_Number]--;
    }
    else
    {
        echo'<script>window.alert("Selected room is not available. Please choose another room")</script>';
        header('Location: HMS_room.html');
        exit();
    }

    $Hostel = new mysqli('localhost', 'root', '', 'hostel');

    if($Hostel->connect_error)
    {
        die('Connection Failed:' . $Hostel->connect_error);
    }
    else
    {
        $result = $Hostel->query("SELECT MAX(ID) as Resident_ID FROM Resident");
        $row = $result->fetch_assoc();
        $Resindet_ID = $row['Resident_ID'] ?? 0;
        $query = $Hostel->prepare("INSERT INTO room(Resident_ID,Room_Number,Floor,Block)VALUES(?,?,?,?)");
        if($query)
        {
            $query->bind_param("iiss", $Resindet_ID, $Room_Number, $Floor, $Block);
            if(!$query->execute())
            {
                echo "Error: " . $query->error;
            }
            else
            {
                header('Location: HMS_Work.html');
                exit();
            }
            $query->close();
        }
        else
        {
            echo "Prepare failed: (" . $Hostel->errno . ") " . $Hostel->error;
        }
        $Hostel->close();
    }
}
?>