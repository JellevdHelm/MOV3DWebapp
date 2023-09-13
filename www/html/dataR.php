<?php
if (isset($_POST['payLoad'])) {
    $pl = $_POST['payLoad'];

    echo "php recieved: $pl";

    $servername = "mysql";
    $username = "myuser";
    $password = "password";
    $dbname = "mydb";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($pl == "clear") {
            $sql = "DELETE FROM dataL";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $sql = "DELETE FROM dataR";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $sql = "ALTER TABLE dataL AUTO_INCREMENT = 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $sql = "ALTER TABLE dataR AUTO_INCREMENT = 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
        }  else {
            $jsonArray = json_decode($pl, true);
            echo "....";
            echo $jsonArray;
            //{"_time":"2023-04-06T22:25:15.040904Z", "low_pass_z":1.1, "steps":2, "threshold":2.2, "x":0.1, "y":0.1, "z":0.1}

            $sql = "CREATE TABLE IF NOT EXISTS dataR (
                    idR int NOT NULL AUTO_INCREMENT,
                    _time VARCHAR(30),
                    low_pass_z FLOAT,
                    steps INT,
                    threshold FLOAT,
                    x FLOAT,
                    y FLOAT,
                    z FLOAT,
                    PRIMARY KEY (idR)
                    )";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $sql = "INSERT INTO dataR (_time, low_pass_z, steps, threshold, x, y, z) VALUES (?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $jsonArray['_time'], $jsonArray['low_pass_z'], $jsonArray['steps'],
                $jsonArray['threshold'], $jsonArray['x'], $jsonArray['y'], $jsonArray['z']
            ]);
        }

        // uncomment to clear database
        // $sql = "DROP TABLE dataR";
        // $stmt = $conn->prepare($sql);
        // $stmt->execute();
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
}
