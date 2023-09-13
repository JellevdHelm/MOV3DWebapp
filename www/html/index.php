<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MOV3D app</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.2/mqttws31.min.js" type="text/javascript"></script>
    <script src="scripts.js" type="text/javascript"></script>

</head>

<header>
    <div class="header-wrap">
        <a href="index.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
    </div>
</header>

<body>
    <div class="field-wrapper">
        <div class="wrapper">
            <h1 id="Main_heading"> <b>MOV3D app</b></h1><br><br>
            <form id="connection-information-form">
                <b>Hostname or IP Address and Port Number:</b>
                <input id="hostL" type="text" name="host" value="localhost" placeholder="broker address">

                <input id="portL" type="text" name="port" value="1884"><br>
                <b>Username and Password:</b>
                <input id="usernameL" type="text" name="Username" value="jelle" placeholder="Username"><br>

                <input id="passwordL" type="password" name="password" placeholder="password"><br>
                <b>Subscription topic:</b>
                <input id="topic_sL" type="text" name="topic_s" value="arduino1/outgoing"><br><br>
                <input type="button" onclick="startConnectL()" value="Connect">
                <input type="button" onclick="startDisconnectL()" value="Disconnect">
                <input type="button" onclick="clearDatabase()" value="Clear"> <br>
                <br><b>Publish Topic and Message:</b>
                <input id="topic_pL" type="text" name="topic_p" value="arduino1/outgoing" placeholder="Publish topic">

                <input id="MessageL" type="text" name="message" placehilder="Message">
                <input type="button" onclick="publishMessageL()" value="Publish">
            </form>
            <div id="messagesL"></div>
        </div>
        <div class="wrapper">
            <h1 id="Main_heading"> <b>Second sensor</b></h1><br><br>
            <form id="connection-information-form">
                <b>Hostname or IP Address and Port Number:</b>
                <input id="host" type="text" name="host" value="localhost" placeholder="broker address">

                <input id="port" type="text" name="port" value="1884"><br>
                <b>Username and Password:</b>
                <input id="username" type="text" name="Username" value="jelle" placeholder="Username"><br>

                <input id="password" type="password" name="password" placeholder="password"><br>
                <b>Subscription topic:</b>
                <input id="topic_s" type="text" name="topic_s" value="arduino2/outgoing"><br><br>
                <input type="button" onclick="startConnectR()" value="Connect">
                <input type="button" onclick="startDisconnectR()" value="Disconnect">
                <input type="button" onclick="clearDatabaseR()" value="Clear"> <br>
                <br><b>Publish Topic and Message:</b>
                <input id="topic_p" type="text" name="topic_p" value="arduino2/outgoing" placeholder="Publish topic">

                <input id="Message" type="text" name="message" placehilder="Message">
                <input type="button" onclick="publishMessageR()" value="Publish">
            </form>
            <div id="messages"></div>
        </div>
    </div>
    <!-- <?
    $database = "mydb";
    $user = "myuser";
    $password = "password";
    $host = "mysql";

    $connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
    $query = "SELECT * FROM dataR";
    //{"_time":"2023-04-06T22:25:15.040904Z", "low_pass_z":1.1, "steps":2, "threshold":2.2, "x":0.1, "y":0.1, "z":0.1}

    echo "<p>Table 'dataL' has the following data:</p>";
    echo "<ul>";
    foreach ($connection->query($query) as $row) {
        print "_time: " . $row['_timeL'] . "\t";
        print "low_pass_z: " . $row['low_pass_zL'] . "\t";
        print "steps: " . $row['stepsL'] . "\t";
        print "threshold: " . $row['thresholdL'] . "\t";
        print "x: " . $row['xL'] . "\t";
        print "y: " . $row['yL'] . "\t";
        print "z: " . $row['zL'] . "\n" . "<br>";
    }
    echo "</ul>";
    ?>
    <?
    $database = "mydb";
    $user = "myuser";
    $password = "password";
    $host = "mysql";

    $conn = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
    $ResultsLstmt = $conn->prepare("SELECT * FROM dataL");
    $ResultsRstmt = $conn->prepare("SELECT * FROM dataR");

    $ResultsLstmt->execute();
    $ResultsRstmt->execute();

    $ResultsL = [];
    $ResultsR = [];



    while ($resultL = $ResultsLstmt->fetch(PDO::FETCH_ASSOC)) {
        $ResultsL[] = $resultL;
    }
    while ($resultR = $ResultsRstmt->fetch(PDO::FETCH_ASSOC)) {
        $ResultsR[] = $resultR;
    }

    //{"_time":"2023-04-06T22:25:15.040904Z", "low_pass_z":1.1, "steps":2, "threshold":2.2, "x":0.1, "y":0.1, "z":0.1}






    $result = $ResultsLstmt->fetchAll(PDO::FETCH_ASSOC);
    echo print_r($result);
    echo '<pre>';
    echo json_encode(['ResultsL' => $ResultsL, 'ResultsR' => $ResultsR]);
    echo '</pre>';
    ?> -->
</body>

</html>