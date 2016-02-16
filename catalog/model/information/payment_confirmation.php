<?php
class ModelInformationPaymentConfirmation extends Model {
	function getBanks() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banks ORDER BY name ASC");

		return $query->rows;
	}
	
	function getBanksName() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banks_name ORDER BY name ASC");

		return $query->rows;
	}

}
?>