<?

function mysql_connect($host, $user, $dbpass)
{
    return mysqli_connect($host, $user, $dbpass);
}

function mysql_select_db($dbname, $sock)
{
    return mysqli_select_db($sock, $dbname);
}

function mysql_query($query)
{
    global $conn;
    return mysqli_query($conn, $query);
}

function mysql_num_rows($res)
{
    return mysqli_num_rows($res);
}

function mysql_fetch_array($res)
{
    return mysqli_fetch_array($res);
}

function mysql_fetch_assoc($res)
{
    return mysqli_fetch_assoc($res);
}

function mysql_insert_id()
{
    global $conn;
    return mysqli_insert_id($conn);
}

function mysql_error()
{
    global $conn;
    return mysqli_error($conn);
}

?>