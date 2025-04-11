<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $Resident_ID = $_POST['ID'] ?? '';
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
        $check_query = $Hostel->prepare("SELECT * FROM rent WHERE Resident_ID=?");
        $check_query->bind_param("i", $Resident_ID);
        $check_query->execute();
        $result = $check_query->get_result();
        if($result->num_rows === 0)
        {
            echo "Error: Resident with ID $Resident_ID does not exist.";
            exit();
        }
        $check_query->close();

        $query = $Hostel->prepare("UPDATE rent SET Plan=?, Amount=?, Payment_Date=?, Payment_Mode=? WHERE Resident_ID=?");

        if($query)
        {
            $query->bind_param("sissi", $Plan, $Amount, $Payment_Date, $Payment_Mode, $Resident_ID);

            if(!$query->execute())
            {
                echo "Error: " . $query->error;
            }
            else
            {
                header('Location: HMS_USuccess.html');
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
