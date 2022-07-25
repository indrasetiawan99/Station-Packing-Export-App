<?php

class WarningMessage_model
{
    private
        $table = 'warning_message',
        $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMessage()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->single();
    }

    public function delMessage($data)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->execute();

        $query = "ALTER TABLE " . $this->table . " AUTO_INCREMENT = 0";
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function insertVar($message)
    {
        $query = 'INSERT INTO ' . $this->table . ' (text) VALUES (:text)';
        $this->db->query($query);
        $this->db->bind('text', $message);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
