<?php
include 'conn.php';

Class Functions
{
	private $db;
	public function __construct(){
		$this->db = new conn(); 
}


//Create User
public function addUser($data){		

    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

	$sql ="INSERT INTO admins (accountnum, firstname, middlename, lastname, suffix, address, email, contactnumber, hashedpassword) VALUES (:firstname, :middlename, :lastname, :suffix, :address, :email, :contactnumber, :hashedpassword)";
		$stmt = $this->db->conn->prepare($sql);
		$r = $stmt->execute([ ':accountnum' => $data['accountnum'],
							':firstname' => $data['firstname'],
							  ':middlename' => $data['middlename'],
                              ':lastname' => $data['lastname'],
                              ':suffix' => $data['suffix'],
                              ':address' => $data['address'],
                              ':email' => $data['email'],
                              ':contactnumber' => $data['contactnumber'],
							  ':hashedpassword' => $hashedPassword
                            ]);
														
		if($r){
			// success!!!
			return 1;
			
		}else{
			// somthing wrong with queries
			return 0;
		}
							
	}

		public function addConsumer($data){		

			$hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
		
			$sql ="INSERT INTO consumer (accountnum, firstname, middlename, lastname, suffix, address, email, contactnumber, hashedpassword) VALUES (:firstname, :middlename, :lastname, :suffix, :address, :email, :contactnumber, :hashedpassword)";
				$stmt = $this->db->conn->prepare($sql);
				$r = $stmt->execute([ ':accountnum' => $data['accountnum'],
									':firstname' => $data['firstname'],
									  ':middlename' => $data['middlename'],
									  ':lastname' => $data['lastname'],
									  ':suffix' => $data['suffix'],
									  ':address' => $data['address'],
									  ':email' => $data['email'],
									  ':contactnumber' => $data['contactnumber'],
									  ':hashedpassword' => $hashedPassword
									]);
																
				if($r){
					// success!!!
					return 1;
					
				}else{
					// somthing wrong with queries
					return 0;
				}
									
			}

//Read All Users
	public function GetAllUsers(){
		$sql = 'SELECT * FROM admins ORDER BY id ASC';
		$stmt = $this->db->conn->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}

	public function GetAllConsumer(){
		$sql = 'SELECT * FROM consumer ORDER BY id ASC';
		$stmt = $this->db->conn->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}

//Read Only User
	public function GetUserInfo($id){
		$sql = 'SELECT * FROM admins WHERE id=:id';
		$stmt = $this->db->conn->prepare($sql);
		$stmt->execute([':id' => $id]);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		return $data;
	}

	public function GetUserConsumer($id){
		$sql = 'SELECT * FROM consumer WHERE id=:id';
		$stmt = $this->db->conn->prepare($sql);
		$stmt->execute([':id' => $id]);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		return $data;
	}

	//Update User
	public function UpdateUser($data, $id){

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

		$sql = 'UPDATE admins SET accountnum=:accountnum, firstname=:firstname, middlename=:middlename, lastname=:lastname, suffix=:suffix, address=:address, email=:email, contactnumber=:contactnumber, hashedpassword=:hashedpassword WHERE id = :id';
		$stmt = $this->db->conn->prepare($sql);
		$r = $stmt->execute([ ':accountnum' => $data['accountnum'],
							':firstname' => $data['firstname'],
                            ':middlename' => $data['middlename'],
                            ':lastname' => $data['lastname'],
                            ':suffix' => $data['suffix'],
                            ':address' => $data['address'],
                            ':email' => $data['email'],
                            ':contactnumber' => $data['contactnumber'],
                            ':hashedpassword' => $hashedPassword,
							  ':id' => $id]);
		if($r){
			return 1;
		}else{
			return 0;
		}
	}


	public function UpdateConsumer($data, $id){

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

		$sql = 'UPDATE consumer SET accountnum=:accountnum, firstname=:firstname, middlename=:middlename, lastname=:lastname, suffix=:suffix, address=:address, email=:email, contactnumber=:contactnumber, hashedpassword=:hashedpassword WHERE id = :id';
		$stmt = $this->db->conn->prepare($sql);
		$r = $stmt->execute([ ':accountnum' => $data['accountnum'],
							':firstname' => $data['firstname'],
                            ':middlename' => $data['middlename'],
                            ':lastname' => $data['lastname'],
                            ':suffix' => $data['suffix'],
                            ':address' => $data['address'],
                            ':email' => $data['email'],
                            ':contactnumber' => $data['contactnumber'],
                            ':hashedpassword' => $hashedPassword,
							  ':id' => $id]);
		if($r){
			return 1;
		}else{
			return 0;
		}
	}

	//Delete User
	public function DeleteUser($id){
		$sql = 'DELETE FROM admins WHERE id=:id';
		$stmt = $this->db->conn->prepare($sql);
		$r = $stmt->execute([':id' => $id]);
		if($r){
			return 1;
		}else{
			return 0;
		}
	}

	public function DeleteConsumer($id){
		$sql = 'DELETE FROM consumer WHERE id=:id';
		$stmt = $this->db->conn->prepare($sql);
		$r = $stmt->execute([':id' => $id]);
		if($r){
			return 1;
		}else{
			return 0;
		}
	}
}

?>