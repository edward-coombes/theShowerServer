<?php
 header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Origin: https://umassdartmouthsustainability.online");
//header("Access-Control-Allow-Credentials: true");
//Set up connection
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

function insertTimerData($conn){
    /* This function inserts the timer data as
     * a new record in the isntance table
     */
    //keys to insert/grab the post data with
    $keys = ["userId","elapsedTime","goalTime"];
    //start of the sql command
    $sql = "INSERT INTO app.showerInstance ( ";
    //keys
    for($i=0;$i<count($keys);$i++){
        $sql .= $keys[$i];
        //Add the , to seperate values, or the ) to end the list
        if($i+1<count($keys)){
            $sql .= ", ";
        } else {
            $sql .= ") ";
        }
    }

    //values
    $sql .= "VALUES ( ";
    for($i=0;$i<count($keys);$i++){
        // Don't forget to sanitize your data :)
        $sql .= "\"" . filter_var( $_POST[$keys[$i]],FILTER_SANITIZE_STRING) . "\"";
        //Add the , to seperate values, or the ) to end the list
        if($i+1<count($keys)){
            $sql .= ", ";
        } else {
            $sql .= ") ";
        }
    }

    // run the query, and set the id cookie
    if($conn->query($sql) == TRUE){
        echo "New session record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$c = initConn();
insertTimerData($c);
?>

