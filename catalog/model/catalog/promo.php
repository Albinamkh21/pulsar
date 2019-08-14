<?php
class ModelCatalogPromo extends Model {
	public function getPromo($promo_id, $layout_id=NULL) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "promo i LEFT JOIN " . DB_PREFIX . "promo_description id ON (i.promo_id = id.promo_id) 
		WHERE i.promo_id = '" . (int)$promo_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1'");

		return $query->row;
	}

	public function getPromos($layout_id=NULL, $data=NULL) {
		$query_str = "SELECT * FROM " . DB_PREFIX . "promo i LEFT JOIN " . DB_PREFIX . "promo_description id ON (i.promo_id = id.promo_id) 
		              WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'  AND i.status = '1' ";

		if (!is_null($layout_id)) {
            $query_str .= " AND i2l.layout_id = '" . (int)$layout_id ."' ";
        }


        $query_str .= " ORDER BY i.sort_order, LCASE(id.title) ASC";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 4;
            }
            $query_str .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        $query = $this->db->query($query_str);
      	return $query->rows;
	}

	public function getPromoLayoutId($promo_id,$layout_id=NULL) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "promo_to_layout WHERE promo_id = '" . (int)$promo_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}


    public function getPromoMinMaxId() {
        $query = $this->db->query("SELECT min(promo_id)  as minId, max(promo_id) as maxId  FROM " . DB_PREFIX . "promo " );
        return $query->row;
    }
    public function getTotalPromos() {
        $query = $this->db->query("SELECT COUNT(*) AS total  FROM " . DB_PREFIX . "promo " );
        return $query->row['total'];
    }


}