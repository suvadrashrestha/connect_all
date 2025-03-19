<?php

// Function to check if a number is positive
function checkPositive($num) {
    // If number is less than 0, throw an exception
    if ($num < 0) {
        throw new Exception("Number must be positive");
    } else {
        echo "The number is positive: $num<br>";
    }
}

try {
    // Trying to check a positive number
    checkPositive(10);  // This should pass without any issues

    // Trying to check a negative number
    checkPositive(-5);  // This will throw an exception

} catch (Exception $e) {
    // Catch the exception and display the error message
    echo "Caught exception: " . $e->getMessage() . "<br>";
} finally {
    // Code inside the finally block will always run
    echo "Execution completed<br>";
}

?>
