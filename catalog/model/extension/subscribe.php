<?php
class ModelExtensionSubscribe extends Model
{
    public function addEmail($data)
    {
        $this->db->query("INSERT INTO " . DB_PREFIX . "subscibers SET email = '" . $data['email'] . "'");
        $id = $this->db->getLastId();
        return $id;

    }
}
?>