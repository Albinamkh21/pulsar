<?php
class ModelCatalogInformation extends Model {
	public function getInformation($information_id, $layout_id=NULL) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE i.information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1'");

		return $query->row;
	}

	public function getInformations($layout_id=NULL, $filter=NULL) {
		$query_str = "SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id)
		              LEFT JOIN " . DB_PREFIX . "information_to_layout i2l ON (i.information_id = i2l.information_id)  
		              WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' 
		              AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1' ";

        if (isset($filter['filter_year'])) {
            $query_str .= " AND  `date_added` BETWEEN '".$filter['filter_year']."-01-01' and '".$filter['filter_year']."-12-31' ";
        }

		if (!is_null($layout_id)) {
            $query_str .= " AND i2l.layout_id = '" . (int)$layout_id ."' ";
        }


        $query_str .= " ORDER BY id.date_added desc, i.sort_order, LCASE(id.title) ASC";
        if (isset($filter['start']) || isset($filter['limit'])) {
            if ($filter['start'] < 0) {
                $filter['start'] = 0;
            }

            if ($filter['limit'] < 1) {
                $filter['limit'] = 4;
            }

            $query_str .= " LIMIT " . (int)$filter['start'] . "," . (int)$filter['limit'];
        }

        $query = $this->db->query($query_str);
      	return $query->rows;
	}

	public function getInformationLayoutId($information_id,$layout_id=NULL) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}
    public function getInformationMinMaxId() {
        $query = $this->db->query("SELECT min(information_id)  as minId, max(information_id) as maxId  FROM " . DB_PREFIX . "information " );
        return $query->row;
    }
    public function getInformationYears() {
        $query = $this->db->query("SELECT distinct YEAR(date_added) as 'year' FROM  " . DB_PREFIX . "information_description order by  YEAR(date_added) " );
        return $query->rows;
    }


    public function getInformationsByLimit($layout_id,$data=NULL) {
        $query_str = "SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id)
		              LEFT JOIN " . DB_PREFIX . "information_to_layout i2l ON (i.information_id = i2l.information_id)  
		              WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' 
		              AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1' ";

        if (!is_null($layout_id)) {
            $query_str .= " AND i2l.layout_id = '" . (int)$layout_id . "' ";
        }

        $query_str .= " ORDER BY id.date_added desc, i.sort_order,  LCASE(id.title) ASC";
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

        //print $query_str;
       return $query->rows;
    }


    public function getTotalInformations($layout_id, $data = array())
    {


        $sql = "SELECT COUNT(DISTINCT i.information_id) AS total FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id)
		              LEFT JOIN " . DB_PREFIX . "information_to_layout i2l ON (i.information_id = i2l.information_id)  
		              WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' 
		              AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1' ";
        if (!is_null($layout_id)) {
            $sql .= " AND i2l.layout_id = '" . (int)$layout_id . "' ";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }
}