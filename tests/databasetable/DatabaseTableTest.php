<?php
class DatabaseTableTest extends \PHPUnit\Framework\TestCase {
    private $pdo;
    private $categoriesTable;

    public function setUp() {
        //require 'dbConnection.php';
        require 'dbConnection.vagrant.php';

        $this->pdo = $pdo;
        $this->categoriesTable = new \CSY2028\DatabaseTable($this->pdo, 'categories', 'category_id');
    }

    /* DatabaseTable Tests */
    // insertRecord() Test
    public function testInsertRecord() {        
        $stmt = $this->pdo->prepare('DELETE FROM categories WHERE name = "Test Insertion";');
        $stmt->execute();

        // Prepare SQL statment for checking whether a record exists in the database.
        $stmt = $this->pdo->prepare('SELECT name FROM categories WHERE name = "Test Insertion";');
        
        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertEmpty($results);

        // Define values to be inserted.
        $values = [
            'category_id' => 100,
            'name' => 'Test Insertion'
        ];

        // Insert record into database.
        $this->categoriesTable->insertRecord($values);

        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertNotEmpty($results);
    }

    // updateRecord() Test
    public function testUpdateRecord() {
        // Prepare SQL statment for checking whether a record exists in the database.
        $stmt = $this->pdo->prepare('SELECT name FROM categories WHERE name = "Test Insertion";');
        
        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertNotEmpty($results);

        // Define values to update record with.
        $values = [
            'category_id' => 100,
            'name' => 'Testing Category'
        ];

        // Update record in the database.
        $this->categoriesTable->updateRecord($values);

        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertEmpty($results);
    }

    // save() Tests
    public function testSaveInsert() {
        // Prepare SQL statment for checking whether a record exists in the database.
        $stmt = $this->pdo->prepare('SELECT name FROM categories WHERE name = "Test Insertion 2";');

        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertEmpty($results);

        $values = [
            'category_id' => 101,
            'name' => 'Test Insertion 2'
        ];

        // Insert record in the database.
        $this->categoriesTable->save($values);

        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertNotEmpty($results);
    }

    public function testSaveUpdate() {
        // Prepare SQL statment for checking whether a record exists in the database.
        $stmt = $this->pdo->prepare('SELECT name FROM categories WHERE name = "Testing Category 2";');

        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertEmpty($results);

        $values = [
            'category_id' => 101,
            'name' => 'Testing Category 2'
        ];

        // Update record in the database.
        $this->categoriesTable->save($values);

        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertNotEmpty($results);        
    }


    // retrieveRecord() Test
    public function testRetrieveRecord() {
        $results = $this->categoriesTable->retrieveRecord('category_id', 100);

        $this->assertNotEmpty($results);
    }

    // retrieveAllRecords() Test
    public function testRetrieveAllRecords() {
        $results = $this->categoriesTable->retrieveAllRecords();

        $this->assertNotEmpty($results); 
    }

    // deleteRecord() Test
    public function testDeleteRecord() {
        // Prepare SQL statment for checking whether a record exists in the database.
        $stmt = $this->pdo->prepare('SELECT category_id FROM categories WHERE category_id = 101;');
        
        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertNotEmpty($results);

        // Delete record that was just inserted from database.
        $this->categoriesTable->deleteRecord('category_id', 101);

        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertEmpty($results);
    }

    // deleteRecordById() Test
    public function testDeleteRecordById() {
        // Prepare SQL statment for checking whether a record exists in the database.
        $stmt = $this->pdo->prepare('SELECT category_id FROM categories WHERE category_id = 100;');

        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertNotEmpty($results);

        // Delete record with ID 100 from database.
        $this->categoriesTable->deleteRecordById(100);

        // Execute the SQL statement and fetch results from execution.
        $stmt->execute();
        $results = $stmt->fetchAll();

        // Check if any results were returned.
        $this->assertEmpty($results);

        $this->pdo->query('ALTER TABLE categories AUTO_INCREMENT = 24;');
    }
}
?>