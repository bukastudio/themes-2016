<?php
class ModelCatalogBanks extends Model {
	public function addBank($data) {
      	$this->db->query("INSERT INTO " . DB_PREFIX . "banks SET name = '" . $this->db->escape($data['name']) . "', branch = '" . $this->db->escape($data['branch']) . "', account_number = '" . $this->db->escape($data['account_number']) . "', account_holder = '" . $this->db->escape($data['account_holder']) . "', sort_order = '" . (int)$data['sort_order'] . "'");		
		
		$this->cache->delete('banks');
	}
	
	public function editBank($bank_id, $data) {
      	$this->db->query("UPDATE " . DB_PREFIX . "banks SET name = '" . $this->db->escape($data['name']) . "', branch = '" . $this->db->escape($data['branch']) . "', account_number = '" . $this->db->escape($data['account_number']) . "', account_holder = '" . $this->db->escape($data['account_holder']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE bank_id = '" . (int)$bank_id . "'");
		
		$this->cache->delete('banks');
	}
	
	public function deleteBank($bank_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "banks WHERE bank_id = '" . (int)$bank_id . "'");
			
		$this->cache->delete('banks');
	}	
	
	public function getBank($bank_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "banks WHERE bank_id = '" . (int)$bank_id . "'");
		
		return $query->row;
	}
	
	public function getBanks($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "banks";
			
			$sort_data = array(
				'name',
				'sort_order'
			);	
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY name";	
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
			$banks_data = $this->cache->get('banks');
		
			if (!$banks_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banks ORDER BY name");
	
				$banks_data = $query->rows;
			
				$this->cache->set('banks', $banks_data);
			}
		 
			return $banks_data;
		}
	}

	public function getTotalBanks() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "banks");
		
		return $query->row['total'];
	}	
}
?>