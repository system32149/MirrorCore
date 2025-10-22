<?php
include "config/config.php";

if ($rateGJLevel) {
    include "incl/connection.php";
    include "incl/gdpsLib.php";

    // Secret
    if (!isset($_POST["secret"]) || $_POST["secret"] != "Wmfd2893gb7") {
        exit("-1");
    }

    $levelID = $_POST["levelID"];
    $rating = $_POST["rating"]."0";

    $query = $conn->prepare("UPDATE gjLevels SET difficultyNumerator = :diff WHERE levelID = :levelID");
    $query->execute(["diff" => $rating, "levelID" => $levelID]);
    echo 1;
}
?>
