<?php
 header("Access-Control-Allow-Origin: *");
//Set up connection
/**/
function initConn(){
    //initiates the connection to the database
    $servername = "localhost";
    $username = "";
    $password = "";

    //Create the connection, and then check to make sure there are no errors
    $conn = new mysqli($servername,$username,$password);
    if($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);

    return $conn;
}/**/

function insertUserData($conn){
    //keys to insert/grab the post data with
    $keys = ["trackId","showerInstanceId","inSeries"];
    $keyCount = count($keys);
    //start of the sql command
    $sql = "INSERT INTO app.users ( ";

    //keys
    //Add the , to seperate values, or the ) to end the list
    for($i=0;$i<$keyCount;$i++){
        $sql .= $keys[$i];
        if($i+1<$keyCount){
            $sql .= ", ";
        } else {
            $sql .= ") ";
        }
    }

    //values
    $sql .= "VALUES ( ";
    for($j=0;$j<$keyCount;$j++){
        // Don't forget to sanitize your data :)
        $sql .= "\"" . filter_var( $_POST[$keys[$j]],FILTER_SANITIZE_STRING) . "\"";
        //Add the , to seperate values, or the ) to end the list
        if($j+1<$keyCount){
            $sql .= ", ";
        } else {
            $sql .= ") ";
        }
    }

    // run the query
    if($conn->query($sql) == TRUE){
        echo $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$c = initConn();
insertUserData($c);

?>

