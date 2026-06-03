<?php
    class Req_Cure{

        // Connection
        private $conn;

        // Table
        private $db_table = "req_cure";

        // Columns
        public $id;
        public $cure_MCH;
        public $IPCode;
        public $status;
        public $req_added;
        public $req_done;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getReqCure(){
            $sqlQuery = "SELECT id, cure_MCH, IPCode, status, IPCode, req_added, req_done FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createReqCure(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        cure_MCH = :cure_MCH, 
                        IPCode = :IPCode, 
                        status = :status, 
                        req_added = :req_added, 
                        req_done = :req_done";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->cure_MCH=htmlspecialchars(strip_tags($this->cure_MCH));
            $this->IPCode=htmlspecialchars(strip_tags($this->IPCode));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->req_added=htmlspecialchars(strip_tags($this->id_paint));
            $this->req_done=htmlspecialchars(strip_tags($this->req_done));
        
            // bind data
            $stmt->bindParam(":cure_MCH", $this->cure_MCH);
            $stmt->bindParam(":IPCode", $this->IPCode);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":req_added", $this->req_added);
            $stmt->bindParam(":req_done", $this->req_done);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleParking(){
			
            $sqlQuery1 = "SELECT id, cure_MCH, IPCode, status, req_added, req_done FROM " . $this->db_table . "
			WHERE 
			   id = ?
			LIMIT 0,1";
			
            $stmt1 = $this->conn->prepare($sqlQuery1);
            $stmt1->bindParam(1, $this->id);
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

