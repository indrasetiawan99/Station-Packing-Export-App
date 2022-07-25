<?php

class ShoppingExp_model
{
    private
        $table = 'shopping_exp',
        $db;

    public function __construct()
    {
        $this->db = new Database_result;
    }

    public function getVar()
    {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id DESC';

        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function insertVar($data)
    {
        $query = 'INSERT INTO ' . $this->table . ' (kanban_api, kanban_cust, hasil) VALUES (:kanban_api, :kanban_cust, :hasil)';
        $this->db->query($query);
        $this->db->bind('kanban_api', $data['kanban_api']);
        $this->db->bind('kanban_cust', $data['kanban_cust']);
        $this->db->bind('hasil', $data['hasil']);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
