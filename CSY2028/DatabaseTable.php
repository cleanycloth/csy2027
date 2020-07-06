<?php
namespace CSY2028;
class DatabaseTable { 
    private $pdo;
    private $table;
    private $primaryKey;
    private $className;
    private $classArguments;

    public function __construct($pdo, $table, $primaryKey, $className = 'stdclass', $classArguments = []) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->className = $className;
        $this->classArguments = $classArguments;
    }

    // Function to retrieve the last insert ID.
    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    // Function to retrieve a single record from the specified database table.
    public function retrieveRecord($field, $value, $order = '') {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value';

        if ($order != '')
            $query .= ' ORDER BY ' . $order; 

        $stmt = $this->pdo->prepare($query);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->className, $this->classArguments);

        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);
    
        return $stmt->fetchAll();
    }

    public function retrieveBlob($id) {
        $stmt = $this->pdo->prepare('SELECT mime, data FROM ' . $this->table . ' WHERE image_id = :id;');

        $stmt->execute(array(":id" => $id));
        $stmt->bindColumn(1, $mime);
        $stmt->bindColumn(2, $data, \PDO::PARAM_LOB);

        $stmt->fetch(\PDO::FETCH_BOUND);

        return array("mime" => $mime, "data" => $data);
    }

    // Function to retrieve all records from the specified database table.
    public function retrieveAllRecords($orderBy = '', $order = '') {
        $query = 'SELECT * FROM ' . $this->table;

        if ($orderBy != '' && $order != '')
            $query .= ' ORDER BY ' . $orderBy . ' ' . $order; 

        $stmt = $this->pdo->prepare($query);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->className, $this->classArguments);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Function to insert a new record into the specified database table.
    public function insertRecord($record) {
        $keys = array_keys($record);

        $values = implode(', ', $keys);
        $placeholderValues = implode(', :', $keys);
    
        $stmt = $this->pdo->prepare('INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $placeholderValues . ');');

        $stmt->execute($record);
    }

    // Function to insert a new blob into the specified database table.
    public function insertBlob($filePath, $mime) {
        $blob = fopen($filePath, 'rb');

        $stmt = $this->pdo->prepare('INSERT INTO ' . $this->table . ' (mime, data) VALUES (:mime, :data);');

        $stmt->bindParam(':mime', $mime);
        $stmt->bindParam(':data', $blob, \PDO::PARAM_LOB);

        $stmt->execute();

        /*
        $values = [
            'mime' => $mime,
            'data' => $blob
        ];

        $this->insertRecord($values); 
        */
    }

    // Function to update an existing record in the specified database table.
    public function updateRecord($record) {
        $query = 'UPDATE ' . $this->table . ' SET ';

        $parameters = [];
        foreach ($record as $key => $value) {
               $parameters[] = $key . ' = :' .$key;
        }

        $query .= implode(', ', $parameters);
        $query .= ' WHERE ' . $this->primaryKey . ' = :primaryKey';

        $record['primaryKey'] = $record[$this->primaryKey];

        $stmt = $this->pdo->prepare($query);

        $stmt->execute($record);
    }

    // Function to update an existing blob in the specified database table.
    public function updateBlob($id, $filePath, $mime) {
        $blob = fopen($filePath, 'rb');

        $stmt = $this->pdo->prepare('UPDATE ' . $this->table . ' SET mime = :mime, data = :data WHERE image_id = :id;');

        $stmt->bindParam(':mime', $mime);
        $stmt->bindParam(':data', $blob, \PDO::PARAM_LOB);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        /*
        $values = [
            'image_id' => $id,
            'mime' => $mime,
            'data' => $blob
        ];

        $this->updateRecord($values);
        */
    }

    // Function to delete a record from the specified database table by providing the name of the field and a value.
    public function deleteRecord($field, $value) {
        $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $field . ' = :value');

        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);
    }

    // Function to delete a record from the specified database table by providing an id.
    public function deleteRecordById($id) {
        $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = :id');

        $criteria = [
            'id' => $id
        ];
        $stmt->execute($criteria);
    }

    // Function to save a record to the specified database table.
    public function save($record) {
        try {
            $this->insertRecord($record); // Insert new record.
        }
        catch (\PDOException $e) {
            $this->updateRecord($record); // Update existing record.
        }
    }

    public function saveBlob($id, $filePath, $mime) {
        try {
            $this->insertBlob($filePath, $mime);
        }
        catch (\PDOException $e) {
            $this->updateBlob($id, $filePath, $mime);
        }
    }
}
?>