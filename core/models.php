<?php

require_once 'dbConfig.php';

function addCustomerAndPurchase($pdo, $customerData, $purchaseData, $userId) {
    $userId = getUserIdByUsername($pdo, $_SESSION['username']);
    $checkCustomer = "SELECT customer_id FROM Customers WHERE customer_email = ?";
    $stmt = $pdo->prepare($checkCustomer);
    $stmt->execute([$customerData['customer_email']]);
    $customerId = $stmt->fetchColumn();
    
    if (!$customerId) {
        $insertCustomer = "INSERT INTO Customers (customer_name, customer_email, customer_address, added_by, added_at) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($insertCustomer);
        $stmt->execute([$customerData['customer_name'], $customerData['customer_email'], $customerData['customer_address'], $userId]);
        $customerId = $pdo->lastInsertId(); 
    }
    
    $insertPurchase = "INSERT INTO Purchase_history (customer_id, items, purchase_total, purchase_date, added_by, added_at) VALUES (?, ?, ?, NOW(), ?, NOW())";
    $stmt = $pdo->prepare($insertPurchase);
    $stmt->execute([$customerId, $purchaseData['items'], $purchaseData['purchase_total'], $userId]);
    
    return $pdo->lastInsertId(); 
}



function seeAllRecords($pdo){
    $sql = "SELECT 
                c.customer_id, 
                c.customer_name, 
                p.items, 
                p.purchase_total, 
                p.purchase_date, 
                u.username AS added_by, 
                c.added_at, 
                u2.username AS last_updated_by, 
                c.last_updated AS last_updated_at
            FROM 
                Customers c
            JOIN 
                Purchase_history p ON c.customer_id = p.customer_id
            LEFT JOIN 
                users u ON c.added_by = u.user_id
            LEFT JOIN 
                users u2 ON c.last_updated_by = u2.user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}



function getById($pdo, $customer_id){
    $sql = "SELECT c.customer_name, c.customer_email, c.customer_address, p.items, p.purchase_total 
            FROM Customers c 
            JOIN Purchase_history p ON c.customer_id = p.customer_id 
            WHERE c.customer_id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$customer_id])){
        return $stmt->fetch();
    }
}

function updateCustomerAndPurchase($pdo, $customer_id, $customer_name, $customer_email, $customer_address, $items, $purchase_total, $userId) {
    $userId = getUserIdByUsername($pdo, $_SESSION['username']);

    $sql = "UPDATE Customers 
            SET customer_name = ?, customer_email = ?, customer_address = ?, last_updated_by = ?, last_updated = NOW()
            WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_name, $customer_email, $customer_address, $userId, $customer_id]);

    $sqlPurchase = "UPDATE Purchase_history 
                    SET items = ?, purchase_total = ?, last_updated_by = ?, last_updated = NOW()
                    WHERE customer_id = ?";
    $stmtPurchase = $pdo->prepare($sqlPurchase);
    $executeQueryPurchase = $stmtPurchase->execute([$items, $purchase_total, $userId, $customer_id]);

    return $executeQuery && $executeQueryPurchase;
}


function deleteHistory($pdo, $customer_id){
    $sqlPurchase = "DELETE FROM Purchase_history WHERE customer_id = ?";
    $stmtPurchase = $pdo->prepare($sqlPurchase);
    $deletePurchase = $stmtPurchase->execute([$customer_id]);

    $sqlCustomer = "DELETE FROM Customers WHERE customer_id = ?";
    $stmtCustomer = $pdo->prepare($sqlCustomer);
    $deleteCustomer = $stmtCustomer->execute([$customer_id]);

    return $deletePurchase && $deleteCustomer;
}

function registerUser($pdo, $username, $password, $first_name, $last_name, $email, $address, $age) {

    $checkUserSql = "SELECT * FROM users WHERE username = ?";
    $checkUserSqlStmt = $pdo->prepare($checkUserSql);
    $checkUserSqlStmt->execute([$username]);

    if ($checkUserSqlStmt->rowCount() == 0) {

        $sql = "INSERT INTO users (username, password, first_name, last_name, email, address, age) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$username, $password, $first_name, $last_name, $email,  $address, $age]);

        if ($executeQuery) {
            $_SESSION['message'] = "User successfully registered!";
            return true;
        } else {
            $_SESSION['message'] = "An error occurred during registration.";
        }

    } else {
        $_SESSION['message'] = "Username already exists.";
    }
}


function loginUser($pdo, $username, $password) {
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() == 1) {
        
        $userInfo = $stmt->fetch();
        $usernameFromDB = $userInfo['username']; 
		$passwordFromDB = $userInfo['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}

	
	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM users WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getUserIdByUsername($pdo, $username) {
    $sql = "SELECT user_id FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    return $stmt->fetchColumn();
}


?>