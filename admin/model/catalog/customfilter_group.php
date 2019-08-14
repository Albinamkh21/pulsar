<?php
class ModelCatalogCustomfilterGroup extends Model {
	public function addCustomfilterGroup($data) {
		$this->event->trigger('pre.admin.customfilter_group.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "customfilter_group SET sort_order = '" . (int)$data['sort_order'] . "'");

		$customfilter_group_id = $this->db->getLastId();

		foreach ($data['customfilter_group_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customfilter_group_description SET customfilter_group_id = '" . (int)$customfilter_group_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->event->trigger('post.admin.customfilter_group.add', $customfilter_group_id);

		return $customfilter_group_id;
	}

	public function editCustomfilterGroup($customfilter_group_id, $data) {
		$this->event->trigger('pre.admin.customfilter_group.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "customfilter_group SET sort_order = '" . (int)$data['sort_order'] . "' WHERE customfilter_group_id = '" . (int)$customfilter_group_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "customfilter_group_description WHERE customfilter_group_id = '" . (int)$customfilter_group_id . "'");

		foreach ($data['customfilter_group_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customfilter_group_description SET customfilter_group_id = '" . (int)$customfilter_group_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->event->trigger('post.admin.customfilter_group.edit', $customfilter_group_id);
	}

	public function deleteCustomfilterGroup($customfilter_group_id) {
		$this->event->trigger('pre.admin.customfilter_group.delete', $customfilter_group_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "customfilter_group WHERE customfilter_group_id = '" . (int)$customfilter_group_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customfilter_group_description WHERE customfilter_group_id = '" . (int)$customfilter_group_id . "'");

		$this->event->trigger('post.admin.customfilter_group.delete', $customfilter_group_id);
	}

	public function getCustomfilterGroup($customfilter_group_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customfilter_group WHERE customfilter_group_id = '" . (int)$customfilter_group_id . "'");

		return $query->row;
	}

	public function getCustomfilterGroups($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "customfilter_group ag LEFT JOIN " . DB_PREFIX . "customfilter_group_description agd ON (ag.customfilter_group_id = agd.customfilter_group_id) WHERE agd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$sort_data = array(
			'agd.name',
			'ag.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY agd.name";
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

	public function getCustomfilterGroupDescriptions($customfilter_group_id) {
		$customfilter_group_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customfilter_group_description WHERE customfilter_group_id = '" . (int)$customfilter_group_id . "'");

		foreach ($query->rows as $result) {
			$customfilter_group_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $customfilter_group_data;
	}

	public function getTotalCustomfilterGroups() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customfilter_group");

		return $query->row['total'];
	}
}