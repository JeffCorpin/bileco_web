<?php
include 'function.php';
include_once 'session.php';
Session::init();

$function = new Functions();

//---ADDING SECTION---//

	//Add User
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['btn-add-user'])){
		
		$flag = $function->addUser($_POST);
			if($flag==1){
			    Session::set("msg", "<div style='background-color: #9fdf9f; color:black; border: solid #9fdf9f 1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-check'></i> A new admin has been added! </center> </div><br><script>
                setTimeout(function() {
                    window.location.href = 'adminuser.php';
                }, 2000); // 1000 milliseconds = 1 second
            </script>");
			}
			else{
			    Session::set("msg", "<div style='background-color: #ED4337; color:white; border: solid #ED4337  color:white;1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-warning'></i> Something went wrong! </center> </div><br><script>
                setTimeout(function() {
                    window.location.href = 'adminuser.php';
                }, 2000); // 1000 milliseconds = 1 second
            </script>");
			}

		header("Location: adminuser.php");
	}

	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['btn-add-consumer'])){
		
		$flag = $function->addConsumer($_POST);
			if($flag==1){
			    Session::set("msg", "<div style='background-color: #9fdf9f; color:black; border: solid #9fdf9f 1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-check'></i> A new consumer has been added! </center> </div><br><script>
                setTimeout(function() {
                    window.location.href = 'consumeruser.php';
                }, 2000); // 1000 milliseconds = 1 second
            </script>");
			}
			else{
			    Session::set("msg", "<div style='background-color: #ED4337; color:white; border: solid #ED4337  color:white;1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-warning'></i> Something went wrong! </center> </div><br><script>
                setTimeout(function() {
                    window.location.href = 'consumeradd.php';
                }, 2000); // 1000 milliseconds = 1 second
            </script>");
			}

		header("Location: consumeruser.php");
	}


	//Edit User
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['btn-edit-user'])){		
		$id = $_GET['id'];
		
			$flag = $function->UpdateUser($_POST, $id);
			if($flag==1){
			    Session::set("msg", "<div style='background-color: #9fdf9f; color:black; border: solid #9fdf9f 1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-check'></i> Admin has been edited! </center> </div><br><script>
                setTimeout(function() {
                    window.location.href = 'adminuser.php';
                }, 2000); // 1000 milliseconds = 1 second
            </script>");
			}
			else{
			    Session::set("msg", "<div style='background-color: #ED4337; color:white; border: solid #ED4337  color:white;1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-warning'></i> Something went wrong! </center> </div><br>");
			}
        header("Location: adminuser.php");
	}

	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['btn-edit-consumer'])){		
		$id = $_GET['id'];
		
			$flag = $function->UpdateConsumer($_POST, $id);
			if($flag==1){
			    Session::set("msg", "<div style='background-color: #9fdf9f; color:black; border: solid #9fdf9f 1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-check'></i> Consumer has been edited! </center> </div><br><script>
                setTimeout(function() {
                    window.location.href = 'consumeruser.php';
                }, 2000); // 1000 milliseconds = 1 second
            </script>");
			}
			else{
			    Session::set("msg", "<div style='background-color: #ED4337; color:white; border: solid #ED4337  color:white;1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-warning'></i> Something went wrong! </center> </div><br><script>
                setTimeout(function() {
                    window.location.href = 'consumeredit.php';
                }, 2000); // 1000 milliseconds = 1 second
            </script>");
			}
        header("Location: consumeruser.php");
	}

	//Delete User
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['btn-delete-user'])){		
	
		if (isset($_POST['id'])) {
	        $id = $_POST['id'];
	        $flag = $function->DeleteUser($id);
	        if ($flag == 1) {
	            $_SESSION["msg"] = "<div style='background-color: #9fdf9f; color:black; border: solid #9fdf9f 1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-check'></i> Admin has been deleted! </center> </div><br><script>
                setTimeout(function() {
                    window.location.href = 'adminuser.php';
                }, 2000); // 1000 milliseconds = 1 second
            </script>";
	        } else {
	            $_SESSION["msg"] = "<div style='background-color: #ED4337; color:white; border: solid #ED4337 1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-warning'></i> Something went wrong! </center> </div><br>";
	        }
		    } else {
		        $_SESSION["msg"] = "<div style='background-color: #ED4337; color:white; border: solid #ED4337 1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-warning'></i> Invalid request! </center> </div><br>";
		    }
		header("Location: adminuser.php");
	}

	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['btn-delete-consumer'])){		
	
		if (isset($_POST['id'])) {
	        $id = $_POST['id'];
	        $flag = $function->DeleteConsumer($id);
	        if ($flag == 1) {
	            $_SESSION["msg"] = "<div style='background-color: #9fdf9f; color:black; border: solid #9fdf9f 1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-check'></i> Consumer has been deleted! </center> </div><br><script>
                setTimeout(function() {
                    window.location.href = 'consumeruser.php';
                }, 2000); // 1000 milliseconds = 1 second
            </script>";
	        } else {
	            $_SESSION["msg"] = "<div style='background-color: #ED4337; color:white; border: solid #ED4337 1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-warning'></i> Something went wrong! </center> </div><br>";
	        }
		    } else {
		        $_SESSION["msg"] = "<div style='background-color: #ED4337; color:white; border: solid #ED4337 1px; border-radius: 5px; padding: 10px;'><center><i class='fa fa-warning'></i> Invalid request! </center> </div><br>";
		    }
		header("Location: consumeruser.php");
	}

?>
