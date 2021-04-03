<?php 

	Class Database{


		private $server = "localhost";
		private $username = "root";
		private $password="";
		private $db;
		private $conn;

		public function __construct($database){
			
			try {
				$this->db=$database;
				$this->conn = new mysqli($this->server,$this->username,$this->password,$this->db);
			} catch (Exception $e) {
				echo "connection failed" . $e->getMessage();
			}
		}

		public function insert($table, $data){


			$query = "INSERT INTO $table (ime_prezime,godine,mesto_rodjenja) VALUES ('$data[ime_prezime]','$data[godine]','$data[mesto_rodjenja]')";
			
			if ($sql = $this->conn->query($query)) {
				echo "<script>alert('Glumac je uspesno dodat!');</script>";
				echo "<script>window.location.href = 'glumac.php';</script>";
			}else{
				echo "<script>alert('failed');</script>";
				echo "<script>window.location.href = 'glumac.php';</script>";
			}

		}           

		public function fetch(){
			$data = null;

			$query = "SELECT * FROM glumac";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function delete($table, $id, $id_value){

			$query="DELETE FROM $table WHERE $table.$id=$id_value";
			if ($sql = $this->conn->query($query)) {
				return true;
			}else{
				return false;
            }
            
        }
    

		public function update($table, $id, $ime_prezime, $godine, $mesto_rodjenja){

			$query = "UPDATE $table SET ime_prezime='$ime_prezime', godine='$godine', mesto_rodjenja='$mesto_rodjenja'  WHERE idglumac='$id'";

			if ($sql = $this->conn->query($query)) {
				return true;
			}else{
				return false;
			}
		}
	}

 ?>