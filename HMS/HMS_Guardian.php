<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $Name = $_POST['Name'] ?? '';
    $Relation = $_POST['Relation'] ?? '';
    $Contact_Number = $_POST['Contact_Number'] ?? '';
    $Email_ID = $_POST['Email_ID'] ?? '';
    $Address = $_POST['Address'] ?? '';

    $Hostel = new mysqli('localhost','root','','Hostel');

    if($Hostel->connect_error)
    {
        die('Connection Failed:' . $Hostel->connect_error);
    }
    else
    {
        $result = $Hostel->query("SELECT MAX(ID) as Resident_ID FROM Resident");
        $row = $result->fetch_assoc();
        $Resident_ID = $row['Resident_ID'] ?? 0;
        $query = $Hostel->prepare("INSERT INTO guardian(Resident_ID,Name,Relation,Contact_Number,Email_ID,Address)VALUES(?,?,?,?,?,?)");

        if($query)
        {
            $query->bind_param("ississ",$Resident_ID, $Name, $Relation, $Contact_Number, $Email_ID, $Address);
            if (!$query->execute()) {
                echo "Error: " . $query->error;
            }
            else
            {
                header('Location: HMS_Rent.html');
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