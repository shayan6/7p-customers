<?php

require_once('Customer.php');

$db = new mysqli("localhost", "root", "", "customers");
$customerHandler = new CustomerHandler($db);

// ************************************************************************************************************/
// Get all customers Endpoint, required action param
// ************************************************************************************************************/
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_all_customers') {
    $pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
    $perPage = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
    $sortField = isset($_GET['sort']) ? $_GET['sort'] : 'CreatedAt';
    $sortOrder = isset($_GET['order']) ? $_GET['order'] : 'DESC';
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

    $customers = $customerHandler->getAllCustomers($pageNumber, $perPage, $sortField, $sortOrder, $filter);
    if ($customers) {
        echo json_encode($customers);
    } else {
        echo json_encode(array('message' => 'No customers found'));
    }
}


// ************************************************************************************************************/
// POST Customer Endpoint, required action param with (firstName || lastName || dateOfBirth || username || password)
// ************************************************************************************************************/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_customer') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $dateOfBirth = $_POST['date_of_birth'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $customerHandler->addCustomer($firstName, $lastName, $dateOfBirth, $username, $password);

    if ($result) {
        echo json_encode(array('message' => 'Customer added successfully'));
    } else {
        echo json_encode(array('message' => 'Error adding customer'));
    }
}

// Update Customer Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['action']) && $_GET['action'] === 'update_customer') {
    parse_str(file_get_contents("php://input"), $_PUT);

    $id = $_PUT['id'];
    $firstName = $_PUT['first_name'];
    $lastName = $_PUT['last_name'];
    $dateOfBirth = $_PUT['date_of_birth'];
    $username = $_PUT['username'];
    $password = $_PUT['password'];

    $result = $customerHandler->updateCustomer($id, $firstName, $lastName, $dateOfBirth, $username, $password);

    if ($result) {
        // Customer updated successfully
        echo json_encode(array('message' => 'Customer updated successfully'));
    } else {
        // Error updating customer
        echo json_encode(array('message' => 'Error updating customer'));
    }
}

// ************************************************************************************************************/
// Delete Customer Endpoint
// ************************************************************************************************************/
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['action']) && $_GET['action'] === 'delete_customer') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'];

    $result = $customerHandler->deleteCustomer($id);

    if ($result) {
        echo json_encode(array('message' => 'Customer deleted successfully'));
    } else {
        echo json_encode(array('message' => 'Error deleting customer'));
    }
}

?>
