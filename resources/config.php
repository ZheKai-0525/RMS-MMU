<?php
    session_start(); // Start a session
    
    defined("LIBRARY_PATH")
        or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
        
    defined("TEMPLATES_PATH")
        or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

    defined("PUBLIC_PATH")
        or define("PUBLIC_PATH", realpath(dirname(__FILE__) . '/../public_html'));

    function csrf_token() {
        if(empty($_SESSION['key']))
            $_SESSION['key'] = bin2hex(random_bytes(32));

        $csrf = hash_hmac('sha256', $_SERVER['PHP_SELF'], $_SESSION['key']);

        return $csrf;
    }

    function db_connection () {
        $errors = array();
	    $hostname = "localhost";
	    $username = "root";
	    $password = "";
	    $database = "rms_v2";

        $connect = new mysqli($hostname,$username,$password,$database);
	
	    if($connect->connect_error)
	    {
		    echo "Failed to connect to MYSQL: " . $connect->connect_error;
		    exit();
	    }

        return $connect;
    }

    function logout ($user) {
        unset($_SESSION["user"]);
    }

    function login ($data) {
        $user_info = array(
            "email" => $data['email'],
            "user" => $data['name'],
        );
		$_SESSION["user"] = $user_info;
    }

    function login_required ($role, $path) {
        global $db_connect;
        $count = 0;

        if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];

            $sql = "SELECT * FROM ".$role." WHERE Email='$email' LIMIT 1";
            $results = mysqli_query($db_connect, $sql);

            if (mysqli_num_rows($results) > 0)
                return true;
            else
                header("Location:".$path); // Login Page
                exit();
        }
        else {
            header("Location:".$path); // Login Page
            exit();
        }
    }

    function user_authorized ($roles=array()) {
        global $db_connect;

        $email = $_SESSION['user']['email'];
        $user_group = array();

        foreach ($roles as $value) {
            $sql = "SELECT * FROM ".$value." WHERE Email='$email' LIMIT 1";
            $results = mysqli_query($db_connect, $sql);
            //if (mysqli_num_rows($results) > 0)
                array_push($user_group,$value);
        }

        // Check if the user group is included in the roles
        if (in_array($user_group, $roles)) {
            echo 'True';
            return true;
        }
        else {
            header("Location:".''); // Unauthorized Page
            exit();
        }
    }

    function render($path, $context=array()) {
        $contentFileFullPath = TEMPLATES_PATH . "/" . $path;
        $contentFileSubPath = "./templates" . "/" . $path;

        if (count($context) > 0) {
			foreach ($context as $key => $value) {
				if (strlen($key) > 0) {
					${$key} = $value;
				}
			}
		}

		if (file_exists($contentFileFullPath) || file_exists($contentFileSubPath)) {
            if (file_exists($contentFileSubPath)) {
                require_once($contentFileSubPath);
            }
            else if (file_exists($contentFileFullPath)) {
                require_once($contentFileFullPath);
            }
		}
        else {
			/*
				If the file isn't found the error can be handled in lots of ways.
				In this case we will just include an error template.
			*/
			require_once(TEMPLATES_PATH . "/error.php");
		}
    }

    $db_connect = db_connection();
?>