<?php
    $currentdir = "";
    if(DIRECTORY_SEPARATOR === '/') {
        // unix, linux, mac
        $currentdir = __DIR__ . "/";
    }

    if(DIRECTORY_SEPARATOR === '\\') {
        // windows
        $currentdir = addslashes(__DIR__) . "\\\\";
    }
    $configjson = json_decode(file_get_contents($currentdir . "config.json"), true);

    define('DB_SERVERNAME', 'localhost');
    define('DB_USERNAME', $configjson["db_username"]);
    define('DB_PASSWORD', $configjson["db_password"]);
    define('DB_DATABASENAME',$configjson["db_databasename"]);
    $conn = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASENAME);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $_SESSION["ctfname"] = $configjson["ctfname"];
    $_SESSION["ctfmessage"] = $configjson["ctfmessage"];
    $_SESSION["discordlink"] = $configjson["discordlink"];
    $_SESSION["flagformat"] = $configjson["flagformat"];

    function CTFCCCFormula($pts,$cnt) {
        $base = $pts * 0.2;
        $res = $base + (($pts - $base) / pow(1 + max(0,$cnt) / 100.92201,1.206069));
        return max(1,round($res));
    }

    function getTeamByUserName($conn, $username) {
        $stmt = $conn->prepare("SELECT team FROM users WHERE username=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $team = $stmt->get_result()->fetch_assoc()['team'];
        $stmt->close();
        return $team;
    }

?>
