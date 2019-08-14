<?php
class ModelCatalogPromo extends Model {
	public function addPromo($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "promo 
		                SET sort_order = '" . (int)$data['sort_order'] . "', bottom = '" . (isset($data['bottom']) ? (int)$data['bottom'] : 0) . "', 
		                status = '" . (int)$data['status'] . "'");

		$promo_id = $this->db->getLastId();

		foreach ($data['promo_description'] as $language_id => $value) {


			    $sql = "INSERT INTO " . DB_PREFIX . "promo_description SET promo_id = '" . (int)$promo_id . "', language_id = '" . (int)$language_id . "', 
			                    title = '" . $this->db->escape($value['title']) . "', 
			                    image = '" . $this->db->escape($value['image']) . "',
			                    date_added = '" .  $this->db->escape($value['date_added']) . "',
			                    description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'";

           $this->db->query($sql);
		}

/*		if (isset($data['promo_store'])) {
			foreach ($data['promo_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "promo_to_store SET promo_id = '" . (int)$promo_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['promo_layout'])) {
			foreach ($data['promo_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "promo_to_layout SET promo_id = '" . (int)$promo_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}
*/
		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'promo_id=" . (int)$promo_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('promo');

		return $promo_id;
	}

	public function editPromo($promo_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "promo SET sort_order = '" . (int)$data['sort_order'] . "', bottom = '" . (isset($data['bottom']) ? (int)$data['bottom'] : 0) . "', status = '" . (int)$data['status'] . "' WHERE promo_id = '" . (int)$promo_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "promo_description WHERE promo_id = '" . (int)$promo_id . "'");

		foreach ($data['promo_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "promo_description SET promo_id = '" . (int)$promo_id . "', language_id = '" . (int)$language_id . "', 
			                title = '" . $this->db->escape($value['title']) . "', image = '" . $this->db->escape($value['image']) . "',
			                date_added = '" .  $this->db->escape($value['date_added']) . "', 
			                description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		/*
		$this->db->query("DELETE FROM " . DB_PREFIX . "promo_to_store WHERE promo_id = '" . (int)$promo_id . "'");

		if (isset($data['promo_store'])) {
			foreach ($data['promo_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "promo_to_store SET promo_id = '" . (int)$promo_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "promo_to_layout WHERE promo_id = '" . (int)$promo_id . "'");

		if (isset($data['promo_layout'])) {
			foreach ($data['promo_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "promo_to_layout SET promo_id = '" . (int)$promo_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}
    */
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'promo_id=" . (int)$promo_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'promo_id=" . (int)$promo_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('promo');
	}

	public function deletePromo($promo_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "promo WHERE promo_id = '" . (int)$promo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "promo_description WHERE promo_id = '" . (int)$promo_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "promo_to_store WHERE promo_id = '" . (int)$promo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "promo_to_layout WHERE promo_id = '" . (int)$promo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'promo_id=" . (int)$promo_id . "'");

		$this->cache->delete('promo');
	}

	public function getPromo($promo_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'promo_id=" . (int)$promo_id . "' LIMIT 1) AS keyword FROM " . DB_PREFIX . "promo WHERE promo_id = '" . (int)$promo_id . "'");

		return $query->row;
	}

	public function getPromos($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "promo i LEFT JOIN " . DB_PREFIX . "promo_description id ON (i.promo_id = id.promo_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'";

			$sort_data = array(
				'id.title',
				'i.sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY id.title";
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
		} else {
			$promo_data = $this->cache->get('promo.' . (int)$this->config->get('config_language_id'));

			if (!$promo_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "promo i LEFT JOIN " . DB_PREFIX . "promo_description id ON (i.promo_id = id.promo_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY id.title");

				$promo_data = $query->rows;

				$this->cache->set('promo.' . (int)$this->config->get('config_language_id'), $promo_data);
			}

			return $promo_data;
		}
	}

	public function getPromoDescriptions($promo_id) {
		$promo_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "promo_description WHERE promo_id = '" . (int)$promo_id . "'");

		foreach ($query->rows as $result) {
			$promo_description_data[$result['language_id']] = array(
				'title'            => $result['title'],
                'image'            => $result['image'],
                'date_added'       => $result['date_added'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_h1'          => $result['meta_h1'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword']
			);
		}

		return $promo_description_data;
	}

	public function getPromoStores($promo_id) {
		$promo_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "promo_to_store WHERE promo_id = '" . (int)$promo_id . "'");

		foreach ($query->rows as $result) {
			$promo_store_data[] = $result['store_id'];
		}

		return $promo_store_data;
	}

	public function getPromoLayouts($promo_id) {
		$promo_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "promo_to_layout WHERE promo_id = '" . (int)$promo_id . "'");

		foreach ($query->rows as $result) {
			$promo_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $promo_layout_data;
	}

	public function getTotalPromos() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "promo");

		return $query->row['total'];
	}

	public function getTotalPromosByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "promo_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}