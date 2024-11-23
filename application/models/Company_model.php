<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model {

    private $file_path;

    public function __construct() {
        parent::__construct();
        
        $this->file_path = APPPATH . 'data/data.json';

     
        if (!file_exists($this->file_path)) {
            file_put_contents($this->file_path, json_encode([]));
        }
    }

      public function get_data() {
        $json_data = file_get_contents($this->file_path);
        return json_decode($json_data, true);
    }

    public function get_data_by_id($id) {
        $currentData = $this->get_data();
        foreach ($currentData as $item) {
            if ($item['id'] == $id) {
                return $item; 
            }
        }
        return null; 
    }


    
    public function save_data($data) {
        file_put_contents($this->file_path, json_encode($data, JSON_PRETTY_PRINT));
    }


    public function create($newData) {
        $currentData = $this->get_data();
        $newData['id'] = count($currentData) + 1; 
        $currentData[] = $newData;
        $this->save_data($currentData);
    }


    public function update($id, $updatedData) {
        $currentData = $this->get_data();
        $success = false;
        foreach ($currentData as $key => $item) {
            if ($item['id'] == $id) {
                $currentData[$key] = array_merge($item, $updatedData);
                $success = true;
                break;
            }
        }
        $this->save_data($currentData);

        return $success;
    }

    public function delete($id) {
        $currentData = $this->get_data();
        $success = false;
        foreach ($currentData as $key => $item) {
            if ($item['id'] == $id) {
                unset($currentData[$key]);
                $success = true;
                break;
            }
        }
        $this->save_data(array_values($currentData)); 

        return $success;
    }
}