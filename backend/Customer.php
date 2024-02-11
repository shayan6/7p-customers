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
            return false;
        }

        $statement = $this->db->prepare("INSERT INTO Customers (FirstName, LastName, DateOfBirth, Username, Password) VALUES (?, ?, ?, ?, ?)");
        $statement->bind_param("sssss", $firstName, $lastName, $dateOfBirth, $username, $password);
        $statement->execute();
        $statement->close();

        return true;
    }

    public function updateCustomer($id, $data)
    {

        if (empty($id) || empty($data)) {
            return false;
        }

        // Construct the SQL query
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
        $types = str_repeat('s', count($params) - 1) . 'i'; // All parameters are strings except the last one (ID)
        $statement->bind_param($types, ...$params);
        $success = $statement->execute();
        $statement->close();
        return $success;
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

        if ($result) {
            $customers = array();
            while ($row = $result->fetch_assoc()) {
                $customers[] = $row;
            }
            return $customers;
        } else {
            return false;
        }
    }

    public function deleteCustomer($id)
    {
        $statement = $this->db->prepare("DELETE FROM Customers WHERE ID=?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $statement->close();
        return true;
    }
}
