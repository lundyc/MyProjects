<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection file
include("_mysqli.php");

// Prevent caching of the response
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2005 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Pragma: no-cache");

// Function to make URLs clickable
function clickable($url) {
    $in = array(
        '`((?:https?|ftp)://\S+[[:alnum:]]/?)`si',
        '`((?<!//)(www\.\S+[[:alnum:]]/?))`si'
    );
    $out = array(
        '<a href="$1" rel="nofollow" target="_blank">(LINK)</a> ',
        '<a href="http://$1" rel="nofollow" target="_blank">(LINK)</a>'
    );
    return preg_replace($in, $out, $url);
}

$testData = array();

// Prepare and execute SQL statement to retrieve shoutbox messages
$stmt = $mysqli->prepare("SELECT `shoutbox`.`id`, `shoutbox`.`message`, `shoutbox`.`date`, `shoutbox`.`UserID`, (SELECT `nickname` FROM `profile` WHERE `mid` = `shoutbox`.`UserID`) AS `nick_name` FROM `shoutbox` WHERE date > ? ORDER BY `shoutbox`.`date` DESC LIMIT 50");
$stmt->bind_param("i", $_GET['time']);
$stmt->execute();
$result = $stmt->get_result();

// Fetch rows and format date, message and nickname
while ($row = $result->fetch_assoc()) {
    $date = date("d-m-y", $row['date']);
    if ($date == date("d-m-y")) {
        $date_posted = date("g:i a", $row['date']); 
    } else if ($date == date("d-m-y", strtotime("-1 day"))) {
        $date_posted = "Yesterday, " . date("g:i a", $row['date']); 
    } else {
        $date_posted = date("M j Y, g:i A", $row['date']);
    }

    $row['date_posted'] = $date_posted;
    $row['nick_color'] = ($row['UserID'] == $_SESSION['userID']) ? "color: #06C; " : '';
    $row['message'] = clickable(nl2br($row['message']));
    $row['nick_name'] = $row['nick_name'];

    $testData[] = $row;
}

// Send JSON response
echo json_encode($testData);

// Close database connection and statement
$result->free();
$stmt->close();
$mysqli->close();
?>