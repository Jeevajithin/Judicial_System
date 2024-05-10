<?php

class CRUD {
    private $db;

    public function __construct() {
        // Connect to your database
        $this->db = new mysqli("localhost","root","","judicial_system");
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function insert($table, $data) {
        // Insert data into the specified table
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_fill(0, count($data), "?"));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->db->prepare($sql);
        $types = str_repeat("s", count($data)); // Assuming all values are strings
        $stmt->bind_param($types, ...array_values($data));
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function select($table, $primary_key_column, $primary_key_value) {
    $sql = "SELECT * FROM $table WHERE $primary_key_column = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $primary_key_value);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

	
	public function select_all($table) {
    // Retrieve all data from the specified table
    $sql = "SELECT * FROM $table";
    $result = $this->db->query($sql);
    if ($result === false) {
        die("Error executing SQL statement: " . $this->db->error);
    }
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

    public function delete($table, $primary_key_column, $primary_key_value) {
    
    $sql = "DELETE FROM $table WHERE $primary_key_column = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $primary_key_value);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

	
	public function edit($table, $primary_key_column, $primary_key_value, $data) {
        // Update data in the specified table based on primary key
        $set_values = "";
        foreach ($data as $column => $value) {
            $set_values .= "$column = ?, ";
        }
        $set_values = rtrim($set_values, ", "); // Remove trailing comma and space
        $sql = "UPDATE $table SET $set_values WHERE $primary_key_column = ?";
        $stmt = $this->db->prepare($sql);
        $types = str_repeat("s", count($data)) . "i"; // Assuming all values are strings and the last value is an integer (primary key)
        $values = array_values($data);
        $values[] = $primary_key_value; // Append the primary key value to the end of the array
        $stmt->bind_param($types, ...$values);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
	
	public function login($email, $password, $table) {
        // Check if the user exists in the specified table with the provided email and password
        $sql = "SELECT * FROM $table WHERE email = ? AND password = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
	
	public function getLastInsertedId() 
	{
    return $this->db->insert_id;
	}

    public function __destruct() {
        // Close the database connection
        $this->db->close();
    }
	
}

?>
