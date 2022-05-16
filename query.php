<?php
class Query
{
	public $conn;

	function __construct(){
		$this->conn = mysqli_connect('localhost','root','ets@123!','crudoop');
		if($this->conn){
			//echo "connection successfull";
			return $this->conn;
		}
	}
	public function insertData($post){
		if(isset($_POST['submit'])){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$sql = "INSERT INTO `users`(`name`,`email`)VALUES('$name','$email')";
			$query = $this->conn->query($sql);
			if($query){
				echo 'Record inserted successfully';
			}
			else
			{
				echo "failed to insert";
			}
		}
	}
	public function select_data(){
		$sql = "SELECT * FROM `users`";
		
		$result = $this->conn->query($sql);
		
		if($result->num_rows>0){
			
			while($row = $result->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}
	public function delete_data($deleteid){
		if(isset($_GET['deleteid'])){
			$del = $_GET['deleteid'];
			$sql = "DELETE FROM `users` WHERE id=$del";
			$query = $this->conn->query($sql);
			if($query){
				echo "delete successfully";		
			}
			else
			{
				echo "failed to delete";
			}

		}
	}
	public function displayRecordbyId($editid){
		$edit = $_GET['editid'];		
		$sql = "SELECT * FROM users WHERE id = $edit";
		$result = $this->conn->query($sql);
		if($result->num_rows == 1){
			$row = $result->fetch_assoc();				
			return $row;
		}
	}
	public function update_data($post){
		if(isset($_POST['update'])){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$editid = $_POST['hid'];
			$sql = "UPDATE users set name='$name',email = '$email' WHERE id='$editid' ";
			$query = $this->conn->query($sql);
			if($query){
				echo 'Record updated successfully';
			}
			else
			{
				echo "failed to insert";
			}
		}
	}
}
$obj = new Query();
?>