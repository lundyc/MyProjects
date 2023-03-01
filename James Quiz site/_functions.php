<?php
function welcome()
{
    if (date("H") < 12)
    {
        echo "Good morning, ";
    }
    elseif (date("H") > 11 && date("H") < 18)
    {
        echo "Good afternoon, ";
    }
    elseif (date("H") > 17)
    {
        echo "Good evening, ";
    }
}

function teamName($teamID)
{
    global $mysqli;
    $teamNameQuery = "SELECT `teamName` FROM `teams` WHERE `teamID` = '" . $teamID . "';";
    $res = $mysqli->query($teamNameQuery);
    $tn = $res->fetch_array();
    echo $tn['teamName'];
}

function isadmin($teamID)
{
    global $mysqli;
    $teamNameQuery = "SELECT `admin` FROM `teams` WHERE `teamID` = '" . $teamID . "';";
    $res = $mysqli->query($teamNameQuery);
    $tn = $res->fetch_array();
    return ($tn['admin'] == "yes") ? true : false;
}
?>