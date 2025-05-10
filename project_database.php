<html>

<head>
    <title>Bre's online shirt store</title>
</head>

<body>
    <form method='POST'>
        <h3>Enter your name: <input type="text" name="fname"</h3>
        <h3>Enter your address: <input type="text" name="addy"</h3>
        <h3>Enter your phone number: <input type="text" name="pnum"</h3>
        <input type="submit" value="Submit Values">
    </form>
    <?php
        //declare and clear variables for display
        $full_name = '';
        $address = '';
        $phone = '';

        //retrieve values from query string and store in local variable 
        //as long as the query string exists
        if (isset($_POST['fname']))
            $full_name = $_POST['fname'];
        if (isset($_POST['addy']))
            $address = $_POST['addy'];
        if (isset($_POST['pnum']))
            $phone = $_POST['pnum'];

        //display values entered as long as a value is there
        if (strlen($full_name) > 0)
            echo "<h3> The name you entered is: $full_name </h3>";
        if (strlen($address) > 0)
            echo "<h3> The address you entered is: $address </h3>";
        if (strlen($phone) > 0)
            echo "<h3> The phone number you entered is: $phone </h3>";
    ?>
</body>

</html>
