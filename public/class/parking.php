<?php
    class Parking{

        // Connection
        private $conn;

        // Table
        private $db_table = "parking";

        // Columns
        public $id;
        public $slot;
        public $id_paint;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getParking(){
            $sqlQuery = "SELECT id, slot, id_paint FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createParking(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        slot = :slot, 
                        id_paint = :id_paint";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->slot=htmlspecialchars(strip_tags($this->slot));
            $this->id_paint=htmlspecialchars(strip_tags($this->id_paint));
        
            // bind data
            $stmt->bindParam(":slot", $this->slot);
            $stmt->bindParam(":id_paint", $this->id_paint);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleParking(){
			
            $sqlQuery1 = "SELECT id, slot, id_paint FROM " . $this->db_table . "
			WHERE 
			   slot = ?
			LIMIT 0,1";
			
            $stmt1 = $this->conn->prepare($sqlQuery1);
            $stmt1->bindParam(1, $this->slot);
            $stmt1->execute();
			
            $dataRow1 = $stmt1->fetch(PDO::FETCH_ASSOC);
			if($dataRow1['id_paint'] != 0){
				$sqlQuery = "SELECT
							a.id,
							a.slot, 
							a.id_paint,
							b.MAT_IP_CODE,
							b.CURE_TIME
						FROM
							". $this->db_table ." a
						INNER JOIN painting b ON a.id_paint = b.id
						WHERE 
						   a.slot = ?
						LIMIT 0,1";

				$stmt = $this->conn->prepare($sqlQuery);

				$stmt->bindParam(1, $this->slot);

				$stmt->execute();

				$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
				
				$this->id = $dataRow['id'];
				$this->slot = $dataRow['slot'];
				$this->MAT_IP_CODE = $dataRow['MAT_IP_CODE'];
				$dateCure = date_create_from_format("d/m/Y H.i", $dataRow['CURE_TIME'])->format("Y-m-d H:i:s");
				$dateNow =  date_create()->format('Y-m-d H:i:s');

				if($dateNow >= $dateCure){
					$this->CURE = "1";
				}else{
					$this->CURE = "0";
				}
			}else{
				$sqlQuery = "SELECT id, slot, id_paint FROM " . $this->db_table . "
				WHERE 
				   slot = ?
				LIMIT 0,1";

				$stmt = $this->conn->prepare($sqlQuery);

				$stmt->bindParam(1, $this->slot);

				$stmt->execute();

				$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
				
				$this->id = $dataRow['id'];
				$this->slot = $dataRow['slot'];
				$this->MAT_IP_CODE = "0";
				$this->CURE = "0";
				
			}
        }        

        // UPDATE
        public function updateParking(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":designation", $this->designation);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteParking(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

