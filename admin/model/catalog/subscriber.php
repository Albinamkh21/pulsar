<?php
class ModelCatalogSubscriber extends Model {

    public function getEmailsSubscribers($start, $end) {


        $query = $this->db->query("SELECT DISTINCT email FROM `" . DB_PREFIX . "subscibers`  LIMIT " . (int)$start . "," . (int)$end);

        return $query->rows;
    }

    public function getTotalEmailsSubscribers() {

        $query = $this->db->query("SELECT DISTINCT email FROM `" . DB_PREFIX . "subscibers` ");

        return $query->row['email'];
    }

}