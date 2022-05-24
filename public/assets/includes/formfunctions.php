<?php
function input_length($string)
{
    if (strlen($string) < 2 ) {
        $_SESSION['error'] = " First Name or Last Name too short ";
        header("Location:../member/signup.php");
        die();
    }
}

function check_for_number_in_string($string)
{
    if (preg_match('~[0-9]+~', $string)){
        $_SESSION['error'] = " First Name or Last Name  might have integers ";
        header("Location: ../member/signup.php");
        die();
    }
}


function validity_of_mail()
{
    global $email;
    if (strlen($email) < 5 || (substr_count($email, '@') != 1) || (substr_count($email, '.') < 1)) {
        $_SESSION['error'] = " Something is wrong with your email ";
        header("Location: ../member/signup.php");
        die();
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>