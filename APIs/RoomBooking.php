<?php 
include("../config/db.php");


// Create Room Booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{

        $name = $_POST["name"];
        $mobile = $_POST["mobile"]; 
        $email = $_POST["email"];
        $booked_str = $_POST["booked_str"];
        
        if($name && $mobile && $email && $booked_str){
            $data = [
                'name' => $name,
                'mobile' => $mobile,
                'email' => $email,
                'booked_str' => $booked_str,
            ];
                
                $sql = "INSERT INTO booked_rooms (name, mobile, email, booked_str) VALUES (:name, :mobile, :email, :booked_str)";
                $pdo->prepare($sql)->execute($data);
                
                // Response if created successfully
                header('Content-type: application/json');
                http_response_code(201);
                echo json_encode([
                    'message' => 'Successfully Created',
                ]);
        }else{
            throw new Exception("Invalid Data, All fields are required");
        }
        }catch(Exception $e){
            // Response if created successfully
            header('Content-type: application/json');
            http_response_code(500);
            echo json_encode([
                'message' => $e,
            ]);
        }
    }

?>
