<?php
// make db connection
require('../db.php');
// Check if person is logged in
require('../login_check.php');
// If ID from $_GET is available, proceed to delete customer
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // 2. Prepare query
    $query  = "DELETE FROM teacher WHERE id = $id";
    // Do the query on the database
    $result = mysqli_query($connection, $query);
    if (!$result) {
        header('Location: teacher.php?success=2');
    }else{
        header('Location: teacher.php?success=del');
    }
} else {
    echo "No ID was given in the URL";
}
mysqli_free_result($result);
// 5. close db connection
mysqli_close($connection);
?>