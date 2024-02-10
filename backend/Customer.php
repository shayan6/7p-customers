<?php

class CustomerHandler {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addCustomer($firstName, $lastName, $dateOfBirth, $username, $password) {
        // Basic validation
        if(empty($firstName) || empty($lastName) || empty($dateOfBirth) || empty($username) || empty($password)) {
            return false;
        }

        // Insert into database
        $stmt = $this->db->prepare("INSERT INTO Customers (FirstName, LastName, DateOfBirth, Username, Password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $dateOfBirth, $username, $password);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function updateCustomer($id, $firstName, $lastName, $dateOfBirth, $username, $password) {
        // Basic validation
        if(empty($firstName) || empty($lastName) || empty($dateOfBirth) || empty($username) || empty($password)) {
            return false;
        }

        // Update database
        $stmt = $this->db->prepare("UPDATE Customers SET FirstName=?, LastName=?, DateOfBirth=?, Username=?, Password=? WHERE ID=?");
        $stmt->bind_param("sssssi", $firstName, $lastName, $dateOfBirth, $username, $password, $id);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function getAllCustomers() {
        // Retrieve all customers from database
        $result = $this->db->query("SELECT * FROM Customers");
        $customers = [];
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
        return $customers;
    }

    public function deleteCustomer($id) {
        // Delete customer from database
        $stmt = $this->db->prepare("DELETE FROM Customers WHERE ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Example usage:
// $db = new mysqli("localhost", "username", "password", "database_name");
// $handler = new CustomerHandler($db);
// $handler->addCustomer("John", "Doe", "1990-01-01", "johndoe", "password123");
// $handler->updateCustomer(1, "John", "Doe", "1990-01-01", "johndoe", "newpassword");
// $customers = $handler->getAllCustomers();
// $handler->deleteCustomer(1);

?>
