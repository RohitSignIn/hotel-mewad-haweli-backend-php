<?php 
require_once("../config/db.php");


// Fetching Booked Rooms
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try{
        // Fetch by id if pass
        $sql = isset($_GET["id"]) ? "SELECT * FROM booked_rooms where id = ".$_GET['id'] : "SELECT * FROM booked_rooms";
        
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll();
        
        header('Content-type: application/json');
            http_response_code(200);
            echo json_encode([
                'message' => "fetched successfully",
                'data' => $result
            ]);

        }catch(Exception $e){
            // Response if created successfully
            header('Content-type: application/json');
            http_response_code(500);
            echo json_encode([
                'message' => $e,
            ]);
        }
    }

// Create Room Booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
        if(isset($_POST["name"]) && isset($_POST["mobile"]) && isset($_POST["email"]) && isset($_POST["booked_str"])){

        $name = $_POST["name"];
        $mobile = $_POST["mobile"]; 
        $email = $_POST["email"];
        $booked_str = $_POST["booked_str"];
        
            $data = [
                'name' => $name,
                'mobile' => $mobile,
                'email' => $email,
                'booked_str' => $booked_str,
            ];
                
                $sql = "INSERT INTO booked_rooms (name, mobile, email, booked_str) VALUES (:name, :mobile, :email, :booked_str)";
                $pdo->prepare($sql)->execute($data);
                $id = $pdo->lastInsertId();

                // Response if created successfully
                header('Content-type: application/json');
                http_response_code(201);
                echo json_encode([
                    'message' => 'Successfully Created',
                    'data' => array('id' => $id) 
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

// Delete Booked Room - Support JSON DATA ONLY
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    try{
        // Using file_get_contents and json_decode
        $rawData = file_get_contents("php://input");
        $deleteData = json_decode($rawData, true);
        if(isset($deleteData['id'])){
            $id = $deleteData['id'];
                $sql = "DELETE FROM booked_rooms WHERE id = ".$id;
                $pdo->prepare($sql)->execute();
                
                // Response if created successfully
                header('Content-type: application/json');
                http_response_code(202);
                echo json_encode([
                    'message' => 'Successfully Deleted',
                    'data' => array('id' => $id) 
                ]);
        }else{
            throw new Exception("Invalid Data, Id not found");
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
