<?php
class ModelCatalogPOTestimonials extends Model {
	public function getTestimonials($data) {
		$sql = "SELECT t.testimonial_id , t.text, c.firstname , c.lastname FROM po_testimonials t LEFT JOIN " . DB_PREFIX . "customer c ON (t.customer_id = c.customer_id) LEFT JOIN po_testimonials_to_store t2s ON (t.testimonial_id = t2s.testimonial_id) WHERE t2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND t.status = '1'";

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
		$sql = "SELECT COUNT(DISTINCT t.testimonial_id) AS total FROM po_testimonials t LEFT JOIN po_testimonials_to_store t2s ON (t.testimonial_id = t2s.testimonial_id) WHERE t2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND t.status = '1'";

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	public function addTestimonial($data) {
		$this->db->query("INSERT INTO  po_testimonials SET customer_id = '" . (int)$this->customer->getId() . "' , text = '" . $this->db->escape($data['testimonial']) . "' , date_added = NOW() ");

		$testimonial_id = $this->db->getLastId();

		$this->db->query("INSERT INTO po_testimonials_to_store SET testimonial_id = '" . (int)$testimonial_id . "', store_id = '" . (int)$this->config->get('config_store_id') . "'");

	}
	public function getTestimonialsbyID($testimonial_string) {
		$query = $this->db->query("SELECT t.testimonial_id , t.text, c.firstname , c.lastname FROM po_testimonials t LEFT JOIN " . DB_PREFIX . "customer c ON (t.customer_id = c.customer_id) LEFT JOIN po_testimonials_to_store t2s ON (t.testimonial_id = t2s.testimonial_id) WHERE t.testimonial_id IN (" . $testimonial_string . ") AND t2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND t.status = '1' ORDER BY RAND() LIMIT 3");

		return $query->rows;
	}
}
?>