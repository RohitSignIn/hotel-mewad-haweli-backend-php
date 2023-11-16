<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{

        $name = $_POST["name"];
        $mobile = $_POST["mobile"]; 
        $email = $_POST["email"];
        $bookedStr = $_POST["bookedStr"];
        
        $data = [
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'booked_str' => $bookedStr,
            ]
            
            $sql = "INSERT INTO users (name, surname, sex) VALUES (:name, :surname, :sex)";
            $pdo->prepare($sql)->execute($data);

            http_response_code(201);
            return header("Created Successfully");
        }catch(Exception $e){
            $pdo->rollback();
            throw $e;
        }
    }

?>