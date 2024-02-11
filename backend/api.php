<?php

require_once('Customer.php');

$db = new mysqli("localhost", "root", "", "customers");
$customerHandler = new CustomerHandler($db);

// ************************************************************************************************************/
// Get all customers Endpoint, required action param
// ************************************************************************************************************/
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_all_customers') {
    try {
        $pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $sortField = isset($_GET['sort']) ? $_GET['sort'] : 'CreatedAt';
        $sortOrder = isset($_GET['order']) ? $_GET['order'] : 'DESC';
        $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

        $customers = $customerHandler->getAllCustomers($pageNumber, $perPage, $sortField, $sortOrder, $filter);
        echo json_encode($customers);
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}


// ************************************************************************************************************/
// POST Customer Endpoint, required action param with (firstName, lastName, dateOfBirth, username, password)
// ************************************************************************************************************/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'add_customer') {
    try {
        $firstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : '';
        $lastName = isset($_POST['LastName']) ? $_POST['LastName'] : '';
        $dateOfBirth = isset($_POST['DateOfBirth']) ? date('Y-m-d', strtotime($_POST['DateOfBirth'])) : '';
        $username = isset($_POST['Username']) ? $_POST['Username'] : '';
        $password = isset($_POST['Password']) ? md5($_POST['Password']) : '';

        $result = $customerHandler->addCustomer($firstName, $lastName, $dateOfBirth, $username, $password);
        echo json_encode(array('message' => $result));
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}

// ************************************************************************************************************/
// Update Customer Endpoint, required action param with (firstName, lastName, dateOfBirth, username, password)
// ************************************************************************************************************/
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['action']) && $_GET['action'] === 'update_customer') {
    try {
        parse_str(file_get_contents("php://input"), $_PUT);

        $id = isset($_PUT['ID']) ? $_PUT['ID'] : '';

        if (!$id) {
            echo json_encode(array('message' => 'Id not found'));
        }

        $updateData = array();
        if (isset($_PUT['FirstName'])) {
            $updateData['FirstName'] = $_PUT['FirstName'];
        }
        if (isset($_PUT['LastName'])) {
            $updateData['LastName'] = $_PUT['LastName'];
        }
        if (isset($_PUT['DateOfBirth'])) {
            $updateData['DateOfBirth'] = date('Y-m-d', strtotime($_PUT['DateOfBirth']));
        }
        if (isset($_PUT['Username'])) {
            $updateData['Username'] = $_PUT['Username'];
        }
        if (isset($_PUT['Password'])) {
            $updateData['Password'] = md5($_PUT['Password']);
        }

        $result = $customerHandler->updateCustomer($id, $updateData);
        echo json_encode(array('message' => $result));
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}


// ************************************************************************************************************/
// Delete Customer Endpoint
// ************************************************************************************************************/
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['action']) && $_GET['action'] === 'delete_customer') {
    try {
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = $_DELETE['id'];
        $result = $customerHandler->deleteCustomer($id);
        echo json_encode(array('message' => $result));
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}
