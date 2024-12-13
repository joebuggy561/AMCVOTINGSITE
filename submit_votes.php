<?php
// Database connection details
$servername = "Localhost";
$username = "boeidnlg_Asiwaju24";
$password = "Lordliveth190???";
$dbname = "boeidnlg_amcwards2024";

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
    exit;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => $conn->connect_error]));
}

// Prepare SQL to insert votes
$stmt = $conn->prepare("INSERT INTO votes (category, option_selected) VALUES (?, ?)");

foreach ($data as $category => $selection) {
    $stmt->bind_param("ss", $category, $selection);
    $stmt->execute();
}

// Close the connection
$stmt->close();
$conn->close();

echo json_encode(['status' => 'success', 'message' => 'Votes submitted successfully']);
?>