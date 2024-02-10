<?php

require_once('Customer.php');

$db = new mysqli("localhost", "root", "", "customers");
$customerHandler = new CustomerHandler($db);

// Get all customers Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_all_customers') {
    $customers = $customerHandler->getAllCustomers();

    // Check if any customers were found
    if ($customers) {
        // Customers found, return them as JSON
        echo json_encode($customers);
    } else {
        // No customers found
        echo json_encode(array('message' => 'No customers found'));
    }
}

// Add Customer Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_customer') {
    // Implementation for adding a customer
}

// Update Customer Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_PUT['action']) && $_PUT['action'] === 'update_customer') {
    // Implementation for updating a customer
}

// Delete Customer Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_DELETE['action']) && $_DELETE['action'] === 'delete_customer') {
    // Implementation for deleting a customer
}

?>
