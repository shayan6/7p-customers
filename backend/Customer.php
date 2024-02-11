<?php

class CustomerHandler
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addCustomer($firstName, $lastName, $dateOfBirth, $username, $password)
    {
        if (empty($firstName) || empty($lastName) || empty($dateOfBirth) || empty($username) || empty($password)) {
            throw new Exception("All fields are required.");
        }

        $statement = $this->db->prepare("INSERT INTO Customers (FirstName, LastName, DateOfBirth, Username, Password) VALUES (?, ?, ?, ?, ?)");
        $statement->bind_param("sssss", $firstName, $lastName, $dateOfBirth, $username, $password);
        $success = $statement->execute();
        $statement->close();

        if (!$success) {
            throw new Exception("Failed to add customer.");
        }

        return "Customer added successfully";
    }

    public function updateCustomer($id, $data)
    {
        if (empty($id) || empty($data)) {
            throw new Exception("ID and data are required.");
        }

        $sql = "UPDATE Customers SET ";
        $params = array();

        foreach ($data as $field => $value) {
            $sql .= "$field=?, ";
            $params[] = $value;
        }

        $sql = rtrim($sql, ", ");
        $sql .= " WHERE ID=?";
        $params[] = $id;
        $statement = $this->db->prepare($sql);

        if (!$statement) {
            throw new Exception("Failed to prepare statement.");
        }

        $types = str_repeat('s', count($params) - 1) . 'i'; // All parameters are strings except the last one (ID)
        $success = $statement->bind_param($types, ...$params);

        if (!$success) {
            throw new Exception("Failed to bind parameters.");
        }

        $success = $statement->execute();
        $statement->close();

        if (!$success) {
            throw new Exception("Failed to update customer.");
        }

        return "Customer updated successfully";
    }

    public function getAllCustomers($pageNumber = 1, $perPage = 10, $sortField = 'CreatedAt', $sortOrder = 'DESC', $filter = '')
    {
        $offset = ($pageNumber - 1) * $perPage;

        $sql = "SELECT * FROM Customers";

        if (!empty($filter)) {
            $sql .= " WHERE FirstName LIKE '%$filter%' OR LastName LIKE '%$filter%' OR Username LIKE '%$filter%'";
        }

        $sql .= " ORDER BY $sortField $sortOrder";
        $sql .= " LIMIT $offset, $perPage";
        $result = $this->db->query($sql);

        if (!$result) {
            throw new Exception("Failed to fetch customers.");
        }

        $customers = array();
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }

        return $customers;
    }

    public function deleteCustomer($id)
    {
        $statement = $this->db->prepare("DELETE FROM Customers WHERE ID=?");
        if (!$statement) {
            throw new Exception("Failed to prepare statement.");
        }

        $success = $statement->bind_param("i", $id);
        if (!$success) {
            throw new Exception("Failed to bind parameter.");
        }

        $success = $statement->execute();
        $statement->close();

        if (!$success) {
            throw new Exception("Failed to delete customer.");
        }

        return "Customer deleted successfully";
    }
}

