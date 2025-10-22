<?php
include "incl/connection.php";
include "config/config.php";

// Secret
if (!isset($_POST["secret"]) || $_POST["secret"] != "Wmfd2893gb7") {
    exit("-1");
}
if (!isset($_POST["type"])) {
    exit("-1");
}

// POST paramaters
$page = (!isset($_POST["page"])) ? 0 : $_POST["page"];
$type = $_POST["type"];
$str = $_POST["str"];
$diff = (!isset($_POST["diff"])) ? null : $_POST["diff"];

$where = null;
$order = null;

// Search types
switch ($type) {
case 0:
    // Search query
    if (is_numeric($str)) {
        // Is a level ID
        $where = "WHERE levelID = '{$str}'";
    } else {
        $where = "WHERE levelName LIKE '{$str}%'";
    }
case 1:
    // Most Downloaded
    $order = "ORDER BY downloads DESC";
    break;
case 2:
    // Most Liked
    $order = "ORDER BY likes DESC";
    break;
case 4:
    // Most Recent
    $order = "ORDER BY levelID DESC";
    break;
case 5:
    // Viewing user's levels
    if (is_numeric($str)) {
        $where = "WHERE userID = '{$str}'";
        $order = "ORDER BY levelID DESC";
    } else {
        exit("-1");
    }
    break;
default:
    exit;
}

// SQL code for the difficulty filters
$diffSql = null;
if (isset($diffSql)) {
    $diffs = explode(",", $diff);

    if (isset($where)) {
        $diffSql = "AND ";
    } else {
        $diffSql = "WHERE ";
    }

    $diffSql .= "(";
    foreach ($diffs as $difficulty) {
        if ($difficulty != -1) {
            $diffNum = "{$difficulty}0";
        } else {
            $diffNum = 0;
        }
        if ($difficulty == $diffs[array_key_last($diffs)]) {
            $diffSql .= "difficultyNumerator = $diffNum";
        } else {
            $diffSql .= "difficultyNumerator = $diffNum OR ";
        }
    }
    $diffSql .= ")";
}


$query = $conn->prepare("SELECT * FROM gjLevels $where $diffSql $order LIMIT 10 OFFSET {$page}0");
$query->execute();
$levelResult = $query->fetchAll();

// Check if no levels were found
if (empty($levelResult)) {
    exit("-1");
}

// Amount of levels
if ($realLevelCount) {
    $query = $conn->prepare("SELECT COUNT(*) FROM gjLevels $where $diffSql");
    $query->execute();
    $amountOfLevels = $query->fetchColumn();
}

/**
 * Creating the response
 */
$response = "";

// Level Object
$levelObject = null;
$creatorObject = null;
foreach ($levelResult as $row) {
    if ($row["difficultyNumerator"] == 0) {
        $difficultyDenominator = 0;
    } else {
        $difficultyDenominator = 10;
    }

    $levelObject .= "1:{$row["levelID"]}:2:{$row["levelName"]}:3:{$row["description"]}:5:{$row["levelVersion"]}:6:{$row["userID"]}:8:{$difficultyDenominator}:9:{$row["difficultyNumerator"]}:10:{$row["downloads"]}:11:0:12:{$row["officialSong"]}:13:{$row["gameVersion"]}:14:{$row["likes"]}:15:{$row["length"]}|";
    $creatorObject .= "{$row["userID"]}:{$row["userName"]}|";
}
$levelObject = substr($levelObject, 0, -1);
$creatorObject = substr($creatorObject, 0, -1);

$response = "{$levelObject}#{$creatorObject}#";

// Page Object
if ($realLevelCount) {
    $response .= $amountOfLevels;
} else {
    $response .= '9999';
}
$response .= ":{$page}0:".count($levelResult);

echo $response;
?>
