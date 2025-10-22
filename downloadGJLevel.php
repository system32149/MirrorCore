<?php
include "incl/connection.php";
include "incl/gdpsLib.php";

// Secret
if (!isset($_POST["secret"]) || $_POST["secret"] != "Wmfd2893gb7") {
    exit("-1");
}

// Level ID
if (!isset($_POST["levelID"])) {
    exit("-1");
}

$levelID = $_POST["levelID"];

// Xan was here.
$query = $conn->prepare("SELECT * FROM gjLevels WHERE levelID = :levelID");
$query->execute([":levelID" => $levelID]);
$level = $query->fetchAll();

// Getting the levelString
$path = "levels/$levelID";
if (file_exists($path)) {
    $levelstring = file_get_contents($path);
} else {
    exit("-1");
}

// Level Object
$response = "1:{$level[0]["levelID"]}:2:{$level[0]["levelName"]}:3:".GDPS::base64url_decode($level[0]["description"]).":4:$levelstring:5:{$level[0]["levelVersion"]}:6:{$level[0]["userID"]}";

echo $response;
?>
