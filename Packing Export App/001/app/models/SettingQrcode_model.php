<?php

class SettingQrcode_model
{
    private
        $table = 'setting_qrcode',
        $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMarginValue()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $this->db->query($query);

        return $this->db->single();
    }

    public function setMarginValue($data)
    {
        $query = 'UPDATE ' . $this->table . " SET left_qrcode = :left_qrcode, up_qrcode = :up_qrcode, left_label = :left_label, up_label = :up_label, darkness = :darkness";
        $this->db->query($query);
        $this->db->bind('left_qrcode', $data['left-qrcode']);
        $this->db->bind('up_qrcode', $data['up-qrcode']);
        $this->db->bind('left_label', $data['left-label']);
        $this->db->bind('up_label', $data['up-label']);
        $this->db->bind('darkness', $data['darkness']);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
