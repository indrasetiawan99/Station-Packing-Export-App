<?php

class TempDataPic_model
{
    private
        $table = 'temp_data_pic',
        $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getVar()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $this->db->query($query);
        return $this->db->single();
    }

    public function setVar()
    {
        $query = 'UPDATE ' . $this->table . " SET pic = :pic";
        $this->db->query($query);
        $this->db->bind('pic', NULL);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function setPic($data)
    {
        $query = 'UPDATE ' . $this->table . " SET pic = :pic";
        $this->db->query($query);
        $this->db->bind('pic', $data);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
