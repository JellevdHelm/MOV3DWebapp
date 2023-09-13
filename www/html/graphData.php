<?

$dataArray = array();
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

echo json_encode(['ResultsL' => $ResultsL, 'ResultsR' => $ResultsR], JSON_NUMERIC_CHECK);
