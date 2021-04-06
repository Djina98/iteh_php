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


			$query = "INSERT INTO $table (naziv,zanr,godina,uloga,idglumac) VALUES ('$data[naziv]','$data[zanr]','$data[godina]','$data[uloga]','$data[idglumac]')";
			
			if ($sql = $this->conn->query($query)) {
				return true;
			}else{
				return false;
			}

		}           

		public function fetch(){
			$data = null;

			$query = "SELECT * , g.ime_prezime FROM film f LEFT JOIN glumac g on (f.idglumac=g.idglumac)";
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
    

		public function update($table, $id, $naziv, $zanr, $godina, $uloga, $idglumac){

			$query = "UPDATE $table SET naziv='$naziv', zanr='$zanr', godina='$godina', uloga='$uloga', idglumac='$idglumac' WHERE id='$id'";

			if ($sql = $this->conn->query($query)) {
				return true;
			}else{
				return false;
			}
		}
	}

 ?>