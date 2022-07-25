<?php

class AppStatus_model
{
    private
        $table = 'app_status',
        $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function setVar($shop)
    {
        $query = 'UPDATE ' . $this->table . " SET shop = :shop";
        $this->db->query($query);
        $this->db->bind('shop', $shop);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
