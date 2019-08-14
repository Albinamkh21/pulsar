<?php
class ModelCatalogCustomFilter extends Model {
	public function addCustomFilter($data) {
		$this->event->trigger('pre.admin.customfilter.add', $data);

		$this->db->query("INSERT INTO `" . DB_PREFIX . "customfilter` SET customfilter_group_id = '" . (int)$data['customfilter_group_id'] . "', type = '" . $this->db->escape($data['type']) . "', sort_order = '" . (int)$data['sort_order'] . "'");

		$customfilter_id = $this->db->getLastId();

		foreach ($data['customfilter_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customfilter_description SET customfilter_id = '" . (int)$customfilter_id . "', language_id = '" . (int)$language_id . "',
			    name = '" . $this->db->escape($value['name']) . "',
                compare_id  = '" . $this->db->escape($data['compare_id']) . "',
                compare_method = '" . $this->db->escape($data['compare_method']) . "'
            ");
		}

		if (isset($data['customfilter_value'])) {
			foreach ($data['customfilter_value'] as $customfilter_value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "customfilter_value SET customfilter_id = '" . (int)$customfilter_id . "', image = '" . $this->db->escape(html_entity_decode($customfilter_value['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$customfilter_value['sort_order'] . "'");

				$customfilter_value_id = $this->db->getLastId();

				foreach ($customfilter_value['customfilter_value_description'] as $language_id => $customfilter_value_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "customfilter_value_description SET customfilter_value_id = '" . (int)$customfilter_value_id . "', language_id = '" . (int)$language_id . "', customfilter_id = '" . (int)$customfilter_id . "', name = '" . $this->db->escape($customfilter_value_description['name']) . "'");
				}
			}
		}

		$this->event->trigger('post.admin.customfilter.add', $customfilter_id);

		return $customfilter_id;
	}

	public function editCustomFilter($customfilter_id, $data) {

		$this->event->trigger('pre.admin.customfilter.edit', $data);

		$this->db->query("UPDATE `" . DB_PREFIX . "customfilter` SET customfilter_group_id = '" . (int)$data['customfilter_group_id'] . "', type = '" . $this->db->escape($data['type']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE customfilter_id = '" . (int)$customfilter_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "customfilter_description WHERE customfilter_id = '" . (int)$customfilter_id . "'");

		foreach ($data['customfilter_description'] as $language_id => $value) {
		    $this->db->query("INSERT INTO " . DB_PREFIX . "customfilter_description SET customfilter_id = '" . (int)$customfilter_id . "', language_id = '" . (int)$language_id . "', 
			name = '" . $this->db->escape($value['name']) . "',
			compare_id  = '" . $this->db->escape($data['compare_id']) . "',
            compare_method = '" . $this->db->escape($data['compare_method']) . "'
			");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "customfilter_value WHERE customfilter_id = '" . (int)$customfilter_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customfilter_value_description WHERE customfilter_id = '" . (int)$customfilter_id . "'");

		if (isset($data['customfilter_value'])) {
			foreach ($data['customfilter_value'] as $customfilter_value) {
				if ($customfilter_value['customfilter_value_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "customfilter_value SET customfilter_value_id = '" . (int)$customfilter_value['customfilter_value_id'] . "', customfilter_id = '" . (int)$customfilter_id . "', image = '" . $this->db->escape(html_entity_decode($customfilter_value['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$customfilter_value['sort_order'] . "'");
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "customfilter_value SET customfilter_id = '" . (int)$customfilter_id . "', image = '" . $this->db->escape(html_entity_decode($customfilter_value['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$customfilter_value['sort_order'] . "'");
				}

				$customfilter_value_id = $this->db->getLastId();

				foreach ($customfilter_value['customfilter_value_description'] as $language_id => $customfilter_value_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "customfilter_value_description 
					SET customfilter_value_id = '" . (int)$customfilter_value_id . "', language_id = '" . (int)$language_id . "', customfilter_id = '" . (int)$customfilter_id . "', 
					name = '" . $this->db->escape($customfilter_value_description['name']) . "'
					
					");
				}
			}


		}

		$this->event->trigger('post.admin.customfilter.edit', $customfilter_id);
	}

	public function deleteCustomFilter($customfilter_id) {
		$this->event->trigger('pre.admin.customfilter.delete', $customfilter_id);

		$this->db->query("DELETE FROM `" . DB_PREFIX . "customfilter` WHERE customfilter_id = '" . (int)$customfilter_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customfilter_description WHERE customfilter_id = '" . (int)$customfilter_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customfilter_value WHERE customfilter_id = '" . (int)$customfilter_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customfilter_value_description WHERE customfilter_id = '" . (int)$customfilter_id . "'");

		$this->event->trigger('post.admin.customfilter.delete', $customfilter_id);
	}

	public function getCustomFilter($customfilter_id) {
		$query = $this->db->query("SELECT *, (SELECT cgd.name FROM " . DB_PREFIX . "customfilter_group_description cgd WHERE cgd.customfilter_group_id = o.customfilter_group_id AND cgd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS customfilter_group 
                                   FROM `" . DB_PREFIX . "customfilter` o LEFT JOIN " . DB_PREFIX . "customfilter_description od ON (o.customfilter_id = od.customfilter_id) WHERE o.customfilter_id = '" . (int)$customfilter_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
    public function getCustomFilterCompares() {
       // $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customfilter_basic` o ");

        /*на основе опций*/
        /*
        $query = $this->db->query(" SELECT compare_id, name FROM `" . DB_PREFIX . "customfilter_basic` 
                                    union  
                                    select o.option_id as compare_id, od.name from `" . DB_PREFIX . "option` o 
                                    inner join `" . DB_PREFIX . "option_description` od on od.option_id = o.option_id
                                    where language_id = '" . (int)$this->config->get('config_language_id') . "' 
        ");
        */
        /*на основе аттрибутов*/
        $query = $this->db->query(" SELECT compare_id, name, 'basic' as group_name FROM `" . DB_PREFIX . "customfilter_basic` 
                                    union  
                                    select a.attribute_id as compare_id, ad.name, agd.name as group_name  from `" . DB_PREFIX . "attribute` a 
                                    inner join `" . DB_PREFIX . "attribute_description` ad on ad.attribute_id = a.attribute_id
                                    inner join `" . DB_PREFIX . "attribute_group_description` agd on agd.attribute_group_id = a.attribute_group_id
                                    where ad.language_id = '" . (int)$this->config->get('config_language_id') . "' 
                                    and agd.language_id = '" . (int)$this->config->get('config_language_id') . "'  
                                   ");

        return $query->rows;
    }
	public function getCustomFilters($data = array()) {
		$sql = "SELECT *, (SELECT cgd.name FROM " . DB_PREFIX . "customfilter_group_description cgd WHERE cgd.customfilter_group_id = o.customfilter_group_id AND cgd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS customfilter_group
		        FROM `" . DB_PREFIX . "customfilter` o LEFT JOIN " . DB_PREFIX . "customfilter_description od ON (o.customfilter_id = od.customfilter_id) WHERE od.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND od.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'od.name',
            'customfilter_group',
			'o.type',
			'o.sort_order'

		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY od.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getCustomFilterDescriptions($customfilter_id) {
		$customfilter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customfilter_description WHERE customfilter_id = '" . (int)$customfilter_id . "'");

		foreach ($query->rows as $result) {
			$customfilter_data[$result['language_id']] = array('name' => $result['name'], 'compare_id' => $result['compare_id'], 'compare_method' => $result['compare_method']);
		}

		return $customfilter_data;
	}

	public function getCustomFilterValue($customfilter_value_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customfilter_value ov LEFT JOIN " . DB_PREFIX . "customfilter_value_description ovd ON (ov.customfilter_value_id = ovd.customfilter_value_id) WHERE ov.customfilter_value_id = '" . (int)$customfilter_value_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getCustomFilterValues($customfilter_id) {
		$customfilter_value_data = array();

		$customfilter_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customfilter_value ov LEFT JOIN " . DB_PREFIX . "customfilter_value_description ovd ON (ov.customfilter_value_id = ovd.customfilter_value_id) WHERE ov.customfilter_id = '" . (int)$customfilter_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order, ovd.name");

		foreach ($customfilter_value_query->rows as $customfilter_value) {
			$customfilter_value_data[] = array(
				'customfilter_value_id' => $customfilter_value['customfilter_value_id'],
				'name'            => $customfilter_value['name'],
				'image'           => $customfilter_value['image'],
				'sort_order'      => $customfilter_value['sort_order']
			);
		}

		return $customfilter_value_data;
	}

	public function getCustomFilterValueDescriptions($customfilter_id) {
		$customfilter_value_data = array();

		$customfilter_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customfilter_value WHERE customfilter_id = '" . (int)$customfilter_id . "' ORDER BY sort_order");

		foreach ($customfilter_value_query->rows as $customfilter_value) {
			$customfilter_value_description_data = array();

			$customfilter_value_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customfilter_value_description WHERE customfilter_value_id = '" . (int)$customfilter_value['customfilter_value_id'] . "'");

			foreach ($customfilter_value_description_query->rows as $customfilter_value_description) {
				$customfilter_value_description_data[$customfilter_value_description['language_id']] = array('name' => $customfilter_value_description['name']);
			}

			$customfilter_value_data[] = array(
				'customfilter_value_id'          => $customfilter_value['customfilter_value_id'],
				'customfilter_value_description' => $customfilter_value_description_data,
				'image'                    => $customfilter_value['image'],
				'sort_order'               => $customfilter_value['sort_order']
			);
		}

		return $customfilter_value_data;
	}

	public function getTotalCustomFilters() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customfilter`");

		return $query->row['total'];
	}
}