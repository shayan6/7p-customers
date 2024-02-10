<?php

require_once('Customer.php');

$db = new mysqli("localhost", "root", "", "customers");
$customerHandler = new CustomerHandler($db);

// ************************************************************************************************************/
// Get all customers Endpoint, required action param
// ************************************************************************************************************/
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_all_customers') {
    // Pagination parameters
    $pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
    $perPage = isset($_GET['per_page']) ? $_GET['per_page'] : 10;

    // Sorting parameters
    $sortField = isset($_GET['sort']) ? $_GET['sort'] : 'CreatedAt';
    $sortOrder = isset($_GET['order']) ? $_GET['order'] : 'DESC';

    // Filtering parameter
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

    // Retrieve customers based on pagination, sorting, and filtering
    $customers = $customerHandler->getAllCustomers($pageNumber, $perPage, $sortField, $sortOrder, $filter);

    // Check if any customers were found
    if ($customers) {
        // Customers found, return them as JSON
        echo json_encode($customers);
    } else {
        // No customers found
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
        // Customer added successfully
        echo json_encode(array('message' => 'Customer added successfully'));
    } else {
        // Error adding customer
        echo json_encode(array('message' => 'Error adding customer'));
    }
}

// Update Customer Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_PUT['action']) && $_PUT['action'] === 'update_customer') {
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

// Delete Customer Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_DELETE['action']) && $_DELETE['action'] === 'delete_customer') {
    parse_str(file_get_contents("php://input"), $_DELETE);

    $id = $_DELETE['id'];

    $result = $customerHandler->deleteCustomer($id);

    if ($result) {
        // Customer deleted successfully
        echo json_encode(array('message' => 'Customer deleted successfully'));
    } else {
        // Error deleting customer
        echo json_encode(array('message' => 'Error deleting customer'));
    }
}

?>
