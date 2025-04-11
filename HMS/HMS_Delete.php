<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $Resident_ID = $_POST['ID'] ?? '';

    $Hostel = new mysqli("localhost", "root", "", "Hostel");

    if ($Hostel->connect_error)
    {
        die("Connection failed: " . $Hostel->connect_error);
    }

    $Work = $Hostel->prepare("DELETE FROM work WHERE Resident_ID = ?");
    $Room = $Hostel->prepare("DELETE FROM room WHERE Resident_ID = ?");
    $Rent = $Hostel->prepare("DELETE FROM rent WHERE Resident_ID = ?");
    $Guardian = $Hostel->prepare("DELETE FROM guardian WHERE Resident_ID = ?");
    $Resident = $Hostel->prepare("DELETE FROM resident WHERE ID = ?");

    $Work->bind_param("i",$Resident_ID);
    $Room->bind_param("i", $Resident_ID);
    $Rent->bind_param("i", $Resident_ID);
    $Guardian->bind_param("i", $Resident_ID);
    $Resident->bind_param("i", $Resident_ID);
    
    $Work->execute();
    $Room->execute();
    $Rent->execute();
    $Guardian->execute();

    if($Work->affected_rows > 0 || $Room->affected_rows > 0 || $Rent->affected_rows > 0 || $Guardian->affected_rows > 0)
    {
        $Resident->execute();
        if($Resident->affected_rows>0)
        {
            header('Location: HMS_DSuccess.html');
        }
        else
        {
            echo "No records found for deletion in resident table";
        }
    }
    else
    {
        echo "No such records were found for deletion";
    }
    $Work->close();
    $Room->close();
    $Rent->close();
    $Guardian->close();
    $Resident->close();
    $Hostel->close();
}
?>