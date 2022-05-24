<?php
include "dbconnection.php";

function countProvest()
{

    global $conn;
    $news_number = '';
    $sql = "SELECT SUM(amount) as amount FROM provest";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $amount = $row['amount'];
            return $amount;
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}
       

            function countNews(){
                
                global $conn;
                $news_number = '';
                $sql= (" SELECT COUNT(id) AS nonews FROM newsletter ;");
                if($result = mysqli_query($conn,$sql)){ 
                        if (mysqli_num_rows($result)>0){
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $news_number = $row['nonews'];
                                echo $news_number; 
                                return $news_number;    
                        }
                    }else { 
                        echo "ERROR: Could not able to execute $sql. ".mysqli_error($conn); 
                    }
            
                }
            
            function countRefs(){
        
                global $conn;
        
                $refer_number = '';
                $sql= (" SELECT COUNT(id) AS norefs FROM refer;");
                if($result = mysqli_query($conn,$sql)){ 
                        if (mysqli_num_rows($result)>0){
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $refer_number = $row['norefs'];
                                echo $refer_number;
                                return $refer_number;     
                        }
                    }else { 
                        echo "ERROR: Could not able to execute $sql. ".mysqli_error($conn); 
                    }
            
                }


                function countCustomers(){
                    $rmm=$_SESSION['name'];
                    global $conn;
            
                    $customer_number = '';
                    $sql= (" SELECT COUNT(customer_id) AS nocustomer FROM customer WHERE customer_rmm ='$rmm' ;");
                    if($result = mysqli_query($conn,$sql)){ 
                            if (mysqli_num_rows($result)>0){
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    $customer_number = $row['nocustomer'];
                                    echo $customer_number;
                                    return $customer_number;     
                            }
                        }else { 
                            echo "ERROR: Could not able to execute $sql. ".mysqli_error($conn); 
                        }
                
                    }

                function countUsers(){
                    global $conn;
            
                    $user_number = '';
                    $sql= (" SELECT COUNT(user_id) AS nousers FROM users WHERE deleted =0 ;");
                    if($result = mysqli_query($conn,$sql)){ 
                            if (mysqli_num_rows($result)>0){
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    $user_number = $row['nousers'];
                                    echo $user_number; 
                                    return $user_number;    
                            }
                        }else { 
                            echo "ERROR: Could not able to execute $sql. ".mysqli_error($conn); 
                        }
                
                    }
                
                        