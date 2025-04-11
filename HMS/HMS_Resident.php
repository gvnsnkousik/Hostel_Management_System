<?php
    $Name=$_POST['Name'];
    $DOB=$_POST['DOB'];
    $Age=$_POST['Age'];
    $Gender=$_POST['Gender'];
    $Contact_Number=$_POST['Contact_Number'];
    $Email_ID=$_POST['Email_ID'];

    $Hostel=new mysqli('localhost','root','','Hostel');

    if($Hostel->connect_error)
    {
        die('Connection Failed:'.$Hostel->connect_error);
    }
    else
    {
        $query=$Hostel->prepare("INSERT INTO resident(Name,DOB,Age,Gender,Contact_Number,Email_ID)values(?,?,?,?,?,?)");
        if($query)
        {
            $query->bind_param("ssisis",$Name,$DOB,$Age,$Gender,$Contact_Number,$Email_ID);
            if(!$query->execute())
            {
                echo"Error: ".$query->error;
            }
            else
            {
                header('Location: HMS_Guardian.html');
                exit();
            }
            $query->close();
        }
        else
        {
            echo"Prepare failed: (".$Hostel->errno.") ".$Hostel->error;
        }
        $Hostel->close();
    }
?>