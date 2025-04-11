<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $Plan = $_POST['Plan'] ?? '';
    $Amount = $_POST['Amount'] ?? '';
    $Payment_Date = $_POST['Payment_Date'] ?? '';
    $Payment_Mode = $_POST['Payment_Mode'] ?? '';

    $Hostel = new mysqli('localhost', 'root', '', 'Hostel');

    if($Hostel->connect_error)
    {
        die('Connection Failed:' . $Hostel->connect_error);
    }
    else
    {
        $result = $Hostel->query("SELECT MAX(ID) as Resident_ID FROM Resident");
        $row = $result->fetch_assoc();
        $Resident_ID = $row['Resident_ID'] ?? 0;
        $query = $Hostel->prepare("INSERT INTO rent (Resident_ID,Plan,Amount,Payment_Date,Payment_Mode)VALUES(?, ?, ?, ?, ?)");

        if($query)
        {
            $query->bind_param("isiss", $Resident_ID, $Plan, $Amount, $Payment_Date, $Payment_Mode);

            if(!$query->execute())
            {
                echo "Error: " . $query->error;
            }
            else
            {
                header('Location: HMS_Room.html');
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