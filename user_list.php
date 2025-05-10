<?php
    //Connect to Database
    $hostname = "localhost";
    $username = "ecpi_user";
    $password = "Password1";
    $dbname = "sdc310_wk3gp";
    $conn = mysqli_connect($hostname, $username, $password, $dbname);

    //Establish variables to support add/edit/delete
    $userNo = -1;
    $full_name = '';
    $address = '';
    $phone = '';

    //Variables to determine the type of operation
    $add = false;
    $edit = false;
    $update = false;
    $delete = false;

    if (isset($_POST['user_no'])) {
        $userNo = $_POST['user_no'];
        $add = isset($_POST['add']);
        $update = isset($_POST['update']);
        $edit = isset($_POST['edit']);
        $delete = isset($_POST['delete']);
    }

    if ($add) {
        //Need to add a new user
        $full_name = $_POST['fname'];
        $address = $_POST['addy'];
        $phone = $_POST['pnum'];

        $addQuery = "INSERT INTO 
            userinfo (fname, addy, pnum)
            VALUES ('$full_name', '$address', '$phone')";
        mysqli_query($conn, $addQuery);

        //Clear the fields
        $userNo = -1;
        $full_name = '';
        $address = '';
        $phone = '';
    }
    else if ($edit) {
        //Get the user information
        $selQuery = "SELECT * FROM userinfo WHERE UserNo = $userNo";
        $result = mysqli_query($conn, $selQuery);
        $userInfo = mysqli_fetch_assoc($result);

        //Fill in the values to allow for edit
        $full_name = $userInfo['fname'];
        $address = $userInfo['addy'];
        $phone = $userInfo['pnum'];
    }
    else if ($update) {
        //Updated values submitted
        $full_name = $_POST['fname'];
        $address = $_POST['addy'];
        $phone = $_POST['pnum'];

        $updQuery = "UPDATE userinfo SET
            fname = '$full_name', addy = '$address',
            pnum = '$phone'
            WHERE UserNo = $userNo";
        mysqli_query($conn, $updQuery);
        
        //Clear the fields
        $userNo = -1;
        $full_name = '';
        $address = '';
        $phone = '';
    }
    else if ($delete) {
        //Need to delete the selected user
        $delQuery = "DELETE FROM userinfo WHERE UserNo = $userNo";
        mysqli_query($conn, $delQuery);
        $userNo = -1;
    }

    //Query for all users
    $query = "SELECT * FROM userinfo";
    $result = mysqli_query($conn, $query);
?>

<style>
    table {
        border-spacing: 5px;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 15px;
        text-align: center;
    }
    th {
        background-color:lightbluesky;
    }
    tr:nth-child(even) {
        background-color: whitesmoke;
    }
    tr:nth-child(odd) {
        background-color:lightgray;
    }
</style>
<html>
    <head>
        <title>Bre's Online Shirt Store</title>
    </head>

    <body>
        <h2>Current Users:</h2>
        <table>
            <tr style="font-size:large;">
                <th>User #</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th></th>
                <th></th>
            </tr>
            <?php while($row = mysqli_fetch_array($result)):;?>
                <tr>
                <td><?php echo $row["UserNo"];?></td>
                    <td><?php echo $row["fname"];?></td>
                    <td><?php echo $row["addy"];?></td>
                    <td><?php echo $row["pnum"];?></td>
                    <td>
                        <form method='POST'>
                            <input type="submit" value="Edit" name="edit">
                            <input type="hidden"
                                value="<?php echo $row["UserNo"]; ?>"
                                name="user_no">
                        </form>
                    </td>
                </tr>
            <?php endwhile;?>
        </table>
        <form method='POST'>
            <input type="hidden" value="<?php echo $userNo; ?>" name="user_no">
            <h3>Enter your full name: <input type="text" name="fname"
                value="<?php echo $full_name; ?>"></h3>
            <h3>Enter your address: <input type="text" name="addy"
                value="<?php echo $address; ?>"></h3>
            <h3>Enter your phone number: <input type="number" name="pnum"
                value="<?php echo $phone; ?>"></h3>
            <?php if(!$edit): ?>
                <input type="submit" value="Add User" name="add">
            <?php else: ?>
                <input type="submit" value="Update User" name="update">
            <?php endif;?>
        </form>
    </body>
</html>
