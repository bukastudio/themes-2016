<?php
class ModelCatalogPOTestimonials extends Model {
	public function getTestimonials($data) {
		$sql = "SELECT t.testimonial_id , t.text, t.status, t.date_added, c.firstname , c.lastname FROM po_testimonials t LEFT JOIN " . DB_PREFIX . "customer c ON (t.customer_id = c.customer_id) LEFT JOIN po_testimonials_to_store t2s ON (t.testimonial_id = t2s.testimonial_id) WHERE t2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		
		$sort_data = array(
			'c.firstname',
			't.status',
			't.date_added'
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY t.date_added";	
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
	
	public function getTotalTestimonials($data = array()) {
		$sql = "SELECT COUNT(DISTINCT t.testimonial_id) AS total FROM po_testimonials t LEFT JOIN po_testimonials_to_store t2s ON (t.testimonial_id = t2s.testimonial_id) WHERE t2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}
	
	public function getTestimonial($testimonial_id) {
		$query = $this->db->query("SELECT t.testimonial_id , t.text, t.status, t.customer_id,  t.date_added, c.firstname , c.lastname FROM po_testimonials t LEFT JOIN " . DB_PREFIX . "customer c ON (t.customer_id = c.customer_id) WHERE t.testimonial_id = '" . (int)$testimonial_id . "'");
		
		return $query->row;
	}	
	
	public function addTestimonial($data) {
		$this->db->query("INSERT INTO po_testimonials SET customer_id = '" . (int)$data['customer_id'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
		
		$testimonial_id = $this->db->getLastId();
		
		$this->db->query("INSERT INTO po_testimonials_to_store SET testimonial_id = '" . (int)$testimonial_id . "', store_id = '" . (int)$this->config->get('config_store_id') . "'");
	
	}
	
	public function editTestimonial($testimonial_id, $data) {
		$this->db->query("UPDATE po_testimonials SET customer_id = '" . (int)$data['customer_id'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', status = '" . (int)$data['status'] . "', date_added = NOW() WHERE testimonial_id = '" . (int)$testimonial_id . "'");
	}
	
	public function deleteTestimonial($testimonial_id) {
		$this->db->query("DELETE FROM po_testimonials WHERE testimonial_id = '" . (int)$testimonial_id . "'");
	}
}
?>