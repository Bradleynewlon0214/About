<?php 
    class Database {

        //load settings to get connection info
        //Connect to database
        //Store connection
        //Get list of tables in database
        //Store table names

        //method for creating table given array
        //individual methods for sql query type (SELECT, INSERT, UPDATE, DELETE)
        //individual method for custon sql query

        
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "cs230";
        private $connection;
        private $tableNames;

        private function connect(){
            //connects to database then stores the connection in $connection
            //if error, throws error
            //returns nothing
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
            if($this->connection->connect_errno){
                printf("Connection failed: %s\n", $connection->connect_error);
                exit();
            }
        }

        private function getTables(){
            //executes query to list tables
            //if error, throws error
            //returns array of table names
            $this->tableNames = [];
            $result = $this->query("show tables;");
            if($result){
                while($row = $result->fetch_row()){
                    array_push($this->tableNames, $row[0]);
                }
            }
            $result->free_result();
        }

        private function getSettings(){
            //gets settings from external config file
            //stores settings variables in fields in the class
            //fields are $host, $username, $password, $database, $connection
            return null;
        }

        private function tableExists($table){
            if(!in_array(strtolower($table), $this->tableNames)){
                throw new Exception("Table: " . $table . " was not found in database: " . $this->database);
            } else{
                return true;
            }
        }

        private function zip($arrOne, $arrTwo, $create){
            $countOne = count($arrOne);
            $countTwo = count($arrTwo);
            $result = [];
            if($countOne == $countTwo){
                for($x = 0; $x < $countOne; $x++){
                    if(!$create){
                        $pushValue = "`" . $arrOne[$x] . "` = '" . $arrTwo[$x] . "'";
                    } else {
                        $pushValue = $arrOne[$x] . " " . $arrTwo[$x];
                    }
                    array_push($result, $pushValue);
                }
            }
            return $result;
        }

        function __construct(){
            //get settings
            //connect to database
            //get tables
            $this->getSettings();
            $this->connect();
            $this->getTables();
        }
    
        public function createTable($tableArray){
            //get table name from $tableObject
            //get columns and datatypes from $tableObject
            // CREATE TABLE table_name ( col1 dtype1, col2 dtype2, ... , colN dtypeN)
            $array = [
                "Persons" => [
                    "PersonID" => "int",
                    "FirstName" => "varchar(255)",
                    "LastName" => "varchar(255)",
                ]
            ];

            $tableName = array_keys($tableArray)[0];
            $colNames = array_keys($tableArray[$tableName]);
            $dTypes = array_values($tableArray[$tableName]);
            $columns = "( " . implode(", ", $this->zip($colNames, $dTypes, true)) . " )";
            $sql = "CREATE TABLE {$tableName} $columns";
            $result = $this->query($sql);
            $this->getTables();
            return $result;
        }

        public function dropTable($table){
            $this->tableExists($table);
            $sql = "DROP TABLE `{$table}`";
            $result = $this->query($sql);
            return $result;
        }

        public function select($table, $fieldsToSelect, $optionalCondition){
            //check if table is in database
            //SELECT `first_name`, `last_name` FROM `users`
            //SELECT implode($fieldsToSelect) FROM $table WHERE parse($optionalCondition);
            //return result object

            $this->tableExists($table);

            $fields = implode("`,`", $fieldsToSelect);
            $sql = "SELECT `" . $fields . "` FROM `" . $table . "`";
            if($optionalCondition){
                $sql = $sql . " WHERE " . $optionalCondition;
            }
            $result = $this->query($sql);
            return $result;
        }
        
        public function insert($table, $fieldsToInsertInto, $values){
            //check if table is in database
            //INSERT INTO $table implode($fieldsToInsertInto) VALUES implode($values);
            //return true if successful, false if not
            $this->tableExists($table);
            $fields = "(`" . implode("`, `", $fieldsToInsertInto) . "`)";
            $values = "('" . implode("', '", $values) . "')";
            $sql = "INSERT INTO {$table} {$fields} VALUES {$values}";
            print($sql);
            $result = $this->query($sql);
            return $result;
        }

        public function update($table, $fieldsToUpdate, $values, $condition){
            //check if table is in database
            //UPDATE $table SET zip($fieldsToUpdate, $values) WHERE parse($condition)
            //The zip should zip the arrays like so: field1 = value1, field2 = value2, ... , fieldN = valueN.
            //return true if successful, false if not
            $this->tableExists($table);
            $fieldsValues = $this->zip($fieldsToUpdate, $values, false);
            $fieldsValues = implode(", ", $fieldsValues);
            $sql = "UPDATE `{$table}` SET {$fieldsValues} WHERE {$condition}";
            $result = $this->query($sql);
            return $result;
        }

        public function delete($table, $optionalCondition){
            //check if table is in database
            //DELETE FROM $table;
            //DELETE FROM $table WHERE $optionalCondition;
            //return true if successful, false if not
            $this->tableExists($table);
            $sql = "DELETE FROM `{$table}` ";
            if($optionalCondition){
                $sql = $sql . "WHERE {$optionalCondition}";
            }
            $result = $this->query($sql);
            return $result;

        }

        public function query($sql){
            //execute query
            //return mysqli result
            $result = $this->connection->query($sql);
            if($result){
                return $result;
            } else{
                printf("No result");
            }
        }

        public function close(){
            $this->connection->close();
        }

        
    }

?>