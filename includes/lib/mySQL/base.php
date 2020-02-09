<?php

/** DB Connect and disconnect object */
class cyz_db{
    // Database Connection Details
    private $db_host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_charset = DB_CHARSET;

    // Database Credentials
    private $db_username = DB_USERNAME;
    private $db_password = DB_PASSWORD;

    // PDO options
    private $pdo_options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    // Connection object
    private $connection_obj;

    // Connection flag
    private $is_connected;

    // Construct Class Function
    function  __construct(){
        // PDO Data Source Name
        $pdo_dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=$this->db_charset";

        try {
            $this->connection_obj = new PDO(
                $pdo_dsn,
                $this->db_username,
                $this->db_password,
                $this->pdo_options
            );
            $this->is_connected = true;
        } catch (PDOException $e) {
            $this->is_connected = false;
        }
    }

    function get_db_name(){
        return $this->db_name;
    }

    // Execute SQL Command
    function execute($statement, $command = null, $return_type = null){
        try { $q = $this->connection_obj->prepare($statement); } catch (Exception $e) { return false; }

        if(false === $q) return false;

        try { $e = $q->execute($command); } catch (Exception $e) { return false; }

        if(false === $e) return false;

        if('fetch_all' == $return_type || 'fetch_assoc' == $return_type){
            try{ $r = $q->fetchAll(PDO::FETCH_ASSOC); } catch(Exception $e) {}
        } else {
            try{ $r = $q->fetchAll(PDO::FETCH_COLUMN); } catch(Exception $e) {}
        }

        /* The following call to closeCursor() may be required by some drivers */
        $q->closeCursor();

        // Execute SQL Query
        return $r ? $r : true;
    }

    // Check if Db is connected
    function is_connected(){
        // Check db is connected
        if($this->is_connected) return true;

        // Return false if it is not connected
        else return false;
    }

    // Destruct Class Function
    function __destruct(){
        $this->connection_obj = null;
        $this->is_connected = false;
    }

    function create_table($table_name, $table_columns = null){
        if(false === $this->is_connected && empty($table_columns) && !is_array($table_columns[0])) return false;

        $statement = "CREATE TABLE IF NOT EXISTS $table_name (";

        $total_column = count($table_columns);

        for($i = 0; $i < $total_column; $i++){
            $statement = $statement."\r\n".$table_columns[$i]['name']." ".$table_columns[$i]['var_type']." ".$table_columns[$i]['var_val'];
            
            if(($i + 1) < $total_column){
                $statement = $statement.",";
            } 
            else {
                $statement = $statement.$new_line.");";
            }
        }

        // Execute SQL Query
        return $this->execute($statement);
    }

    function list_tables(){
        if(false === $this->is_connected) return false;

        // Execute SQL Query
        return $this->execute('SHOW TABLES');
    }

    function list_columns($table_name = null){
        if(false === $this->is_connected && empty($table_name)) return false;

        // Execute SQL Query
        return $this->execute('SHOW COLUMNS FROM '.$table_name);
    }

    function insert_row($table_name, $data = null){
        if(false === $this->is_connected && empty($table_name)) return false;

        if(empty($data) && !is_array($data)) return false;

        $statement      = "INSERT INTO $table_name (";
        $statement_val  = "VALUES (";

        $command = array();

        $count = count($data);

        $index = 0;

        foreach($data as $key => $value){
            $index++;

            $command[":$key"] = $value;

            if($index < $count) $statement  = $statement."\r\n $key,";
            else $statement                 = $statement."\r\n $key)";

            if($index < $count) $statement_val  = $statement_val."\r\n :$key,";
            else $statement_val                 = $statement_val."\r\n :$key);";
        }

        $statement = $statement."\r\n".$statement_val;

        // Execute SQL Query
        return $this->execute($statement, $command);
    }

    function get_rows($table_name, $offset = null, $count = null){
        if(false === $this->is_connected && empty($table_name)) return false;

        if(empty($offset)) $offset = 0;

        if(empty($count)) $count = 10;

        // Execute SQL Query
        return $this->execute(" SELECT * FROM $table_name LIMIT $offset, $count;", null, 'fetch_all');
    }
    
    function search_table($data = null){
        if(empty($data['prefix']) && empty($data['suffix'])) return array();

        $parameters[] = $data['prefix'].'%'.$data['suffix'];
    
        $parameters[] = $this->db_name;
      
        $sql_stm = 'SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE ? AND TABLE_SCHEMA=?';

        // Execute SQL Query
        $tables = $this->execute($sql_stm, $parameters);

        if(is_string($tables[0])) return $tables;
        else return [];
    }

    function table_name_exists($table_name = null){
        if(empty($table_name)) return FALSE;

        $parameters[] = $table_name;
      
        $sql_stm = 'SELECT 1 FROM ? LIMIT 1';

        try {
            // Execute SQL Query
            $result = $this->execute($sql_stm, $parameters);
        } catch (Exception $e) {
            // We got an exception == table not found
            return FALSE;
        }

        if($result) return TRUE;
    }
}
