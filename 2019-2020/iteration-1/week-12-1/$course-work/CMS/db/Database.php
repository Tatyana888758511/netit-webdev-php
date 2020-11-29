<?php
namespace db {

    class Database {

        private $dbConnection;
        private $lastExecutedQuery = null;
        private $executeError      = null;
        private $resultCollection  = null;

        private static $instance   = null;

        // Singleton : Designe pattern 
        // * check online for more information 
        
        /**
         * 
         * @return \db\Database
         */
        public static function getInstance() {

            if(!Database::$instance) {
                Database::$instance =  new Database();
            }

            return Database::$instance;
        }


        private function __construct() {

            $dbHandler    = NULL;
            $dbHost       = \config\Config::db($dbHandler)['db_host'];
            $dbName       = \config\Config::db($dbHandler)['db_name'];
            $dbUser       = \config\Config::db($dbHandler)['db_user'];
            $dbPass       = \config\Config::db($dbHandler)['db_pass'];

            $this->dbConnection = new \mysqli($dbHost, $dbUser, $dbPass, $dbName);
        }
        
        // TODO : consider checking the value of result collection 
        public function query($query) {

            $this->lastExecutedQuery = $query;
            $this->resultCollection  = $this->dbConnection->query($query);
            
            if($this->dbConnection->error) {
                
                echo '<br>';
                echo '<strong>SQL Error</strong>';
                echo '<hr>';
                var_dump($this->dbConnection->error);
                echo '<hr>';
                echo '<br>';
            }
            
            return $this->resultCollection;
        }

        public function fetch() {
            return $this->resultCollection->fetch_assoc();
        }
        
        
        public function fetchCollection() {
            
            $collection = array();
            
            while($element = $this->resultCollection->fetch_assoc()) {
                array_push($collection, $element);
            }
            
            return $collection;
        }        

        public function lastExecutedQuery() {
            return $this->lastExecutedQuery;
        }

        public function showError() {

            if(empty($this->executeError)) {
                $this->executeError = $this->dbConnection->error;
            }

            return $this->executeError;
        }
        
        /**
         * Return the last inserted id
         * @author Mihail Petrov
         * @return number
         */
        public function lastInsertedId() {
            return $this->dbConnection->insert_id;
        }
        
        /**
         * Return the number of affected from query db rows
         * @author Mihail Petrov
         * @return number
         */        
        public function affectedRows() {
            return $this->dbConnection->affected_rows;
        }
    
    }
}