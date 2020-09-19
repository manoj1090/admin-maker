<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    function __construct(){

        parent::__construct();
        
    }

    /**
     * This Function is used to insert record into the provided table
     * @param  String  $table   Name of table in which want to insert record
     * @param  Array   $dataArray Array of data that want to insert in row
     * @return Integer Inserted id.
     */
    public function insert($table, $dataArray) {
        $result = false; 
        if(is_array($dataArray)) {
            $this->db->insert($table, $dataArray);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    /**
     * This function is used to fetch data from table
     * @param String $table   Name of the table from which want to fetch the record
     * @param Array  $where   Array for add in where condition
     * @param Array  $order   Array for ass order by statement
     * @return Object 
     */
    public function getData($table, $where, $order) {
        if(is_array($where) && !empty($where)) {
            foreach ($where as $column => $columnValue) {
                $this->db->where($column, $columnValue);
            }
        }

        if(is_array($order) && !empty($order)) {
            $key = array_keys($order);
            $this->db->order_by($key[0], $order[$key[0]]);
        }

        $qr = $this->db->get($table);
        return $qr->result();
    }

    /**
     * This function is used to update anything into databse
     * @param String $table   Name of table in which you want to update something
     * @param Array  $data    Data to be update in array formate
     * @param Array  $where   (optional) Where contion to implement in query
     */
    public function update($table, $data, $where) {
        if( is_array($where) && !empty($where) ) {
            foreach ($where as $column => $columnValue) {
                $this->db->where($column, $columnValue);
            }

            $this->db->update($table, $data);
            return $this->db->affected_rows();
        }
    }

    /**
	 * This function is used to delete single row from table
	 * @param  String  $table   Table name
	 * @param  Array   $where   Array for where condition, column_name as index of array and value as value of that index.
	 * @return Boolean          TRUE if success
	 */
	public function delete($table, $where) {
		if (is_array($where) && !empty($where)) {
			foreach ($where as $column => $value) {
				$this->db->where($column, $value);
			}
		}
		return $this->db->delete($table);
	}

    /**
     * This function is used to execute custom query into database
     * @param  String $query Executable query string
     * @return Object        Query Object
     */
    public function customQuery($query) {
        return $this->db->query($query);
    }
    
}
