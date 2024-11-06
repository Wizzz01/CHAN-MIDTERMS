<?php
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['submitBtn'])) {
    $customerData = [
        'customer_name' => $_POST['customerName'],
        'customer_email' => $_POST['customerEmail'],
        'customer_address' => $_POST['customerAddress'],
    ];

    $purchaseData = [
        'items' => $_POST['itemsPurchased'], 
        'purchase_total' => $_POST['purchaseTotal']
    ];

    $userId = $_SESSION['username'];

    $query = addCustomerAndPurchase($pdo, $customerData, $purchaseData, $userId);

    if ($query) {
        header("Location: ../salesDatabase.php");
    } else {
        echo "Query Failed";
    }
}


if (isset($_POST['editBtn'])) {
    $customer_id = $_GET['customer_id']; 
    $customer_name = $_POST['customerName'];  
    $customer_email = $_POST['customerEmail'];   
    $customer_address = $_POST['customerAddress'];
    $items = $_POST['itemsPurchased']; 
    $purchase_total = $_POST['purchaseTotal'];  

    $query = updateCustomerAndPurchase($pdo, $customer_id, $customer_name, $customer_email, $customer_address, $items, $purchase_total, $userId);

    if ($query) {
        header("Location: ../salesDatabase.php");
    } else {
        echo "Update Failed";
    }    
}


if(isset($_POST['deleteBtn'])){
    $id = $_GET['customer_id'];  
    $query = deleteHistory($pdo, $id);

    if ($query) {
        header("Location: ../salesDatabase.php");
    } else {
        echo "Delete Failed";
    }    
}

if (isset($_POST['registerUserBtn'])) {

    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $age = $_POST['age'];

    if (!empty($username) && !empty($password) && !empty($first_name) && !empty($last_name) && !empty($email) && !empty($address) && !empty($age)) {

        $insertQuery = registerUser($pdo, $username, $password, $first_name, $last_name, $email, $address, $age);

        if ($insertQuery) {
            header("Location: ../userLogin.php");
        } else {
            header("Location: ../userRegister.php");
        }
    } else {
        header("Location: ../userRegister.php");
        $_SESSION['message'] = "All fields are required for registration!";
    }
}

if (isset($_POST['loginUserBtn'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
	
		if ($loginQuery) {
			header("Location: ../index.php");
		}
		else {
			header("Location: ../userLogin.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../userLogin.php");
	}
 
}

if (isset($_GET['logoutAUser'])) {
    $_SESSION['message'] = "You have been logged out! Please log in to view the database.";
	unset($_SESSION['username']);
	header('Location: ../userLogin.php');
}

