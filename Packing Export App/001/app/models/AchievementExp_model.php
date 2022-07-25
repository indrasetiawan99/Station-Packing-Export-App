<?php

class AchievementExp_model
{
    private
        $table = 'achievement_exp',
        $db;

    public function __construct()
    {
        $this->db = new Database_result;
    }

    public function insertVar($data)
    {
        $query = 'INSERT INTO ' . $this->table . ' (station_num, part_name, pn_cust, name, date_time, qr_code) VALUES (:station_num, :part_name, :pn_cust, :name, :date_time, :qr_code)';
        $this->db->query($query);
        $this->db->bind('station_num', $data['station_num']);
        $this->db->bind('part_name', $data['part_name']);
        $this->db->bind('pn_cust', $data['pn_cust']);
        $this->db->bind('name', $data['name']);
        $this->db->bind('date_time', $data['date_time']);
        $this->db->bind('qr_code', $data['qr_code']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delTrash()
    {
        $query = 'DELETE FROM ' . $this->table . " WHERE status IS NULL OR status != 'complete'";
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function setScanKanban($code)
    {
        $query = 'UPDATE ' . $this->table . " SET scan_data_part = :scan_data_part, op_shop = :op_shop, dt_shop = now() WHERE scan_data_part IS NULL AND data_part = :data_part AND status = :status";
        $this->db->query($query);
        $this->db->bind('scan_data_part', $code);
        $this->db->bind('data_part', $code);
        $this->db->bind('op_shop', $_SESSION['login-shop']['npk']);
        $this->db->bind('status', 'complete');
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getVar()
    {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id DESC';

        $this->db->query($query);
        return $this->db->resultSet();
    }
}
