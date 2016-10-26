<?php

/**
 *
 * DB class
 *
 * Version 0.1
 */ 

require_once 'Config.php'; 


$site_path = $database[$ARRAY_INDEX]['site_path'];
$user_site_path = $database[$ARRAY_INDEX]['user_site_path'];
define('SITE_PATH', $site_path);

define('USER_SITE_PATH', $user_site_path);
 
  
define('PER_PAGE', 25);
define('DATE_FORMAT', 'd. F Y H:i');
 define('FIRST_PAGE', 'index.php?page=dashboard');
define('HOME_SITE_LINK', 'index.php?page=dashboard');
define('SIGN_IN', 'index.php?page=signin');
define('USER_ADDED', ' User Added Success');
define('USER_UPDATED', ' User Updated Success');
define('USER_DELETED', ' User Deleted Success');
define('COMMON_SAVED', ' Details Saved Success');
define('COMMON_DELETED', 'Details Deleted Success');

global $queries;

class database {

    private $db_host;
    private $db_database;
    private $db_user;
    private $db_pass;
    private $db_link;
    //public $db_link;
    private $_last_num_rows; // number of rows returned from the last query
    private $_last_insert_id; // id number from last insert statement
    private $database_open = false;
    public $prefix = '';

    public function __construct($p_db) {
        $this->set_db_params($p_db);
    }

    public function __destruct() {
        $this->close();
    }

    public function set_db_params($p_db) {
        $this->db_host = $p_db['host'];
        $this->db_database = $p_db['database'];
        $this->db_user = $p_db['user'];
        $this->db_pass = $p_db['pass'];
        $this->close();
        $this->connect();
    }

    private function connect() {


        $this->db_link = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_database);
        if (!$this->db_link) {

            // could not connect to the database
            if (DEBUG) {
                echo "<p>Could not connect to the database</p>";
            }
            return false;
        }
        $this->database_open = true;
        return true;
    }

    private function close() {
        if ($this->database_open) {
            mysqli_close($this->db_link);
            unset($this->db_link);
            $this->database_open = false;
        }
    }

    private function run_query($p_query) {


        if ($this->database_open) {
            global $queries;
            $msc = microtime(true);

            $query_result = $this->db_link->query($p_query);

          
            if ($query_result) {
                $db_query['query'] = $p_query;
                $db_query['exetime'] = $msc;
                $queries[] = $db_query;
             }
            return $query_result;
        } else {
            return false;
        }
    }

    public function run_sql($p_query) {
        //$this->connect();
        //echo "<p>$p_query</p>";

        global $queries;
        $msc = microtime(true);
        
        $query_result = $this->db_link->query($p_query);
       
        $msc = microtime(true) - $msc;
        if ($query_result) {
            $db_query['query'] = $p_query;
            $db_query['exetime'] = $msc;
            $queries[] = $db_query;
             return( $query_result );
        }
          return false;
      
    }

    public function get_array($p_query) {
        $ret_arr = array();

        $query_result = $this->run_query($p_query);

        if ($query_result) {
            $this->_last_num_rows = $query_result->num_rows;

            if ($query_result) {
                while ($row = $query_result->fetch_object()) {
                    $ret_arr[] = $row;
                }
            }

            return( $ret_arr );
        }
    }

    public function get_results($p_query) {
        $ret_arr = array();

        $query_result = $this->run_query($p_query);

        if ($query_result) {
            $this->_last_num_rows = $query_result->num_rows;

            if ($query_result) {
                while ($row = $query_result->fetch_object()) {
                    $ret_arr[] = $row;
                }
            }

            return( $ret_arr );
        }
    }

    public function getValuesPair($table, $fields = array(), $where = '', $limit = '', $order_by = '') {
        if (count($fields) < 2)
            return false;

        $where_query .= 'where 1 ' . $where;

        $query = "select $fields[0],$fields[1] from $table " . $where_query . ' ' . $order_by . '' . $limit;

        $query_result = $this->run_query($query);

        if ($query_result) {


            if ($query_result) {
                while ($row = $query_result->fetch_object()) {
                    $ret_arr[$row->$fields[0]] = $row->$fields[1];
                }
            }

            return( $ret_arr );
        }
    }

    public function get_id_array($p_query, $getid = 'id') {
        $ret_arr = array();

        $query_result = $this->run_query($p_query);

        if ($query_result) {
            $this->_last_num_rows = $query_result->num_rows;

            if ($query_result) {
                while ($row = $query_result->fetch_object()) {
                    $ret_arr[$row->$getid] = $row;
                }
            }
            //$query_result->close();
            return( $ret_arr );
        }
    }

    public function get_count($table, $where = '1') {
        $ret_arr = array();
        $sql = 'select count(*) as tot_count from `' . $table . '` where ' . $where;

        $query_result = $this->run_query($sql);

        if ($query_result) {
            //  $this->_last_num_rows = $query_result->num_rows;

            while ($row = $query_result->fetch_object()) {
                return $row->tot_count;
            }
        }
        return false;
    }

    public function get_item($p_query) {
        $ret_arr = array();
        $query_result = $this->run_query($p_query . " LIMIT 1");
        if ($query_result) {
            $this->_last_num_rows = $query_result->num_rows;

            if ($this->_last_num_rows > 0) {
                while ($row = $query_result->fetch_object()) {
                    $ret_arr[] = $row;
                }
                // $query_result->close();
                return( $ret_arr[0] );
            }
        }
        return false;
    }

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    public function get_SQL_FOUND_ROWS() {
        $query_result = $this->run_query("SELECT FOUND_ROWS() as count");
        $ret_arr['count'] = 0;
        while ($row = $query_result->fetch_object()) {
            $ret_arr['count'] = $row;
        }
        return $ret_arr['count'];
    }

    public function insert($p_table, $p_insert_array) {
        // check for 'created_on' field
        $field_names = $this->get_field_names($p_table);


        if (in_array('created_on', $field_names)) {
            // add creaded_on date
            $p_insert_array['created_on'] = date("Y-m-d H:i:s");
        }
        if (in_array('updated_on', $field_names)) {
            // add creaded_on date
            $p_insert_array['updated_on'] = date("Y-m-d H:i:s");
        }


        if (in_array('ip_address', $field_names)) {
            // add creaded_on date
            $p_insert_array['ip_address'] = $_SERVER["REMOTE_ADDR"];
        }
        if (in_array('client_ip_address', $field_names)) {
            // add creaded_on date

            $p_insert_array['client_ip_address'] = $this->get_client_ip();
        }



        $cols = $values = '';
        if (is_array($p_insert_array)) {
            foreach ($p_insert_array as $name => $value) {

                if (in_array($name, $field_names)) {
                    $cols .= "`$name`, ";
                    $values .= "'" . $this->escape_string($value) . "', ";
                }
            }
            $cols = trim($cols, ', ');
            //$cols = substr( $cols, 0, strlen( $cols ) - 2 );
            $values = substr($values, 0, strlen($values) - 2);
            // echo "<p>INSERT INTO `$p_table` ($cols) VALUES($values)</p>";
            $sql = "INSERT INTO `$p_table` ($cols) VALUES($values)";
           
            $result = $this->run_query($sql);

            return $result;
        } else {
            return false;
        }
    }

    public function update($p_table, $p_update_array, $p_where, $p_limit = 1) {
        // check for 'updated_on' field
        $field_names = $this->get_field_names($p_table);
        if (in_array('updated_on', $field_names)) {
            // add creaded_on date
            $p_update_array['updated_on'] = date("Y-m-d H:i:s");
        }

        $update_values = '';
        foreach ($p_update_array as $name => $value) {
            if (in_array($name, $field_names)) {
                $update_values .= "`$name`='" . $this->escape_string($value) . "', ";
            }
        }
        $update_values = substr($update_values, 0, strlen($update_values) - 2);

        if ($p_limit > 0) {
            $limit = " LIMIT $p_limit";
        }
        $query = "UPDATE `$p_table` SET $update_values WHERE $p_where$limit";

        return( $this->run_query($query));
    }

    public function delete($p_table, $p_where, $p_limit = '') {
        $limit = '';
        if ($p_limit != '') {
            $limit = " LIMIT $p_limit";
        }
        $query = "DELETE FROM `$p_table` WHERE $p_where$limit";
        
        return( $this->run_query($query) );
    }
    public function truncate($p_table) {
        
        $query = "TRUNCATE  ".$p_table;
        return( $this->run_query($query) );
    }

    public function get_num_rows() {
        return $this->_last_num_rows;
    }

    public function get_last_insert_id() {
        return $this->_last_insert_id;
    }

    private function get_field_names($p_table) {
        $field_array = array();

        $query = "SHOW COLUMNS FROM $p_table";
        
        $query_result = $this->run_query($query);
        if($query_result)
        while ($row = $query_result->fetch_assoc()) {
            $field_array[] = $row['Field'];
        }
        // $query_result->close();
        return $field_array;
    }

    public function get_column_names($p_table) {
        $field_array = array();

        $query = "SHOW COLUMNS FROM $p_table";
        $query_result = $this->run_query($query);

        while ($row = $query_result->fetch_assoc()) {
            $field_array->$row['Field'] = '';
        }
        // $query_result->close();
        return $field_array;
    }

    public function escape_string($p_string) {
        return( $this->db_link->real_escape_string($p_string) );
    }

    /**
     * Include legacy functinos that point
     * to the new functins for old style names
     * */
    private function db_connect() {
        return $this->connect();
    }

    private function db_close() {
        return $this->close();
    }

    private function db_run_query($p_query) {
        return $this->run_query($p_query);
    }

    public function db_get_array($p_query) {
        return $this->get_array($p_query);
    }

    public function get_affected_rows() {
        return $this->db_link->affected_rows;
    }
    public function db_get_item($p_query) {
        return $this->get_item($p_query);
    }

    public function db_insert($p_table, $p_insert_array) {
        return $this->insert($p_table, $p_insert_array);
    }

    public function db_update($p_table, $p_update_array, $p_where, $p_limit = 1) {
        return $this->update($p_table, $p_update_array, $p_where, $p_limit);
    }

    public function db_delete($p_table, $p_where, $p_limit = 1) {
        return $this->delete($p_table, $p_where, $p_limit);
    }

    public function db_get_num_rows() {
        return $this->get_num_rows();
    }

    public function db_get_last_insert_id() {
        return $this->get_last_insert_id();
    }

    private function db_get_field_names($p_table) {
        return $this->get_field_names($p_table);
    }

    public function escape_string_tags($p_string) {
        return( htmlspecialchars($this->db_link->real_escape_string($p_string)) );
    }

}

global $db;
$db = new database($database[$ARRAY_INDEX]);


$db->run_sql('SET character_set_results=utf8');
$db->run_sql('SET names=utf8');
$db->run_sql('SET character_set_client=utf8');
$db->run_sql('SET character_set_connection=utf8');
$db->run_sql('SET character_set_results=utf8');

$db->run_sql('SET collation_connection=utf8_general_ci');




global $allowedExts;
$allowedExts = array("gif", "jpeg", "jpg", "png");


