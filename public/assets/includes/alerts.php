<?php
function error_alert()
{
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        echo "<h4 class='text-danger alert alert-danger flash'>" . $_SESSION['error'] . "</h4>";
        unset($_SESSION['error']);
    
    }
}

function success_alert()
{
    if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
        echo "<h4 class='text-success alert alert-success flash'>" . $_SESSION['message'] . "</h4>";
        unset($_SESSION['message']);
        
    }
}
