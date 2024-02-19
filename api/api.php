<?php

// Check if the "search" parameter is set
if(isset($_GET['search'])) {
    // Retrieve the value of the "search" parameter
    $search = $_GET['search'];
   include("../partials/_dbconnect.php");
    $sql ="SELECT * FROM rec WHERE recipeName like '%$search%'";
    
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    
    if ($num > 0){
        $response = array(); // Initialize an empty array

        while($row = mysqli_fetch_assoc($result)){
            // Add each row to the response array
            $response['recipe'][] = $row;
        }
    }
    else {
        $response = array('recipe' => null); // Empty array if no rows are
    }

    // Convert the response array to JSON
    $json_response = json_encode($response);

    // Set the content type header to application/json
    header('Content-Type: application/json');

    // Send the JSON response
    echo $json_response;
} else {
    // If the "name" parameter is not set, return an error message
    $error_response = array(
        'error' => 'Please provide a name parameter'
    );

    // Convert the error response array to JSON
    $json_error_response = json_encode($error_response);

    // Set the content type header to application/json
    header('Content-Type: application/json');

    // Send the JSON error response
    echo $json_error_response;
    
}
?>
