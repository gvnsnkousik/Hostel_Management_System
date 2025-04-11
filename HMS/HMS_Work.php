<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $Company_Name = $_POST['Company_Name'] ?? '';
    $Company_Address = $_POST['Company_Address'] ?? '';
    $Company_Number = $_POST['Company_Number'] ?? '';
    $Designation = $_POST['Designation'] ?? '';

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
        $query = $Hostel->prepare("INSERT INTO work(Resident_ID,Company_Name,Company_Address,Company_Number,Designation)VALUES(?,?,?,?,?)");
        if($query)
        {        
            $query->bind_param("issss", $Resident_ID, $Company_Name, $Company_Address, $Company_Number, $Designation);
            if(!$query->execute())
            {
                echo "Error: " . $query->error;
            }
            else
            {
                header('Location: HMS_JSuccess.html');
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
