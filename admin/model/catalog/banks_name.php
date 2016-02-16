<?php
class ModelCatalogBanksName extends Model {
	public function addBankName($data) {
      	$this->db->query("INSERT INTO " . DB_PREFIX . "banks_name SET name = '" . $this->db->escape($data['name']) . "', sort_order = '" . (int)$data['sort_order'] . "'");		
		
		$this->cache->delete('banks_name');
	}
	
	public function editBankName($bank_id, $data) {
      	$this->db->query("UPDATE " . DB_PREFIX . "banks_name SET name = '" . $this->db->escape($data['name']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE bank_id = '" . (int)$bank_id . "'");
		
		$this->cache->delete('banks_name');
	}
	
	public function deleteBankName($bank_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "banks_name WHERE bank_id = '" . (int)$bank_id . "'");
			
		$this->cache->delete('banks_name');
	}	
	
	public function getBankName($bank_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "banks_name WHERE bank_id = '" . (int)$bank_id . "'");
		
		return $query->row;
	}
	
	public function getBanksName($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "banks_name";
			
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
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banks_name ORDER BY name");
	
				$banks_data = $query->rows;
			
				$this->cache->set('banks_name', $banks_name_data);
			}
		 
			return $banks_name_data;
		}
	}

	public function getTotalBanksName() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "banks_name");
		
		return $query->row['total'];
	}	
}
?>