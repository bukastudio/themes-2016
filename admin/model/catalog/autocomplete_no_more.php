<?php
class ModelCatalogAutocompleteNoMore extends Model {
	public function getCategory($category_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int)$category_id . "') AS keyword FROM " . DB_PREFIX . "category WHERE category_id = '" . (int)$category_id . "'");
		
		return $query->row;
	} 
	
	public function getCategories($parent_id = 0) {
		$category_data = $this->cache->get('category.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id);
	
		if (!$category_data) {
			$category_data = array();
		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");
		
			foreach ($query->rows as $result) {
				$category_data[] = array(
					'category_id' => $result['category_id'],
					'name'        => $this->getPath($result['category_id'], $this->config->get('config_language_id')),
					'status'  	  => $result['status'],
					'sort_order'  => $result['sort_order']
				);
			
				$category_data = array_merge($category_data, $this->getCategories($result['category_id']));
			}	
	
			$this->cache->set('category.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id, $category_data);
		}
		
		return $category_data;
	}

	public function getFilters() {
	
		$query = $this->db->query("SELECT language_id FROM " . DB_PREFIX . "language WHERE `code` = '" . $this->config->get('config_admin_language') . "'");
		$language_id = $query->row['language_id'];
		
		$filter_groups =  array();
		$filters = array();
		
		$query = $this->db->query("SELECT fd.name, fd.filter_id, fgd.name AS filter_group
										FROM " . DB_PREFIX . "filter_description fd 
										LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON fd.filter_group_id = fgd.filter_group_id
										WHERE fd.language_id = '" . (int)$language_id . "' AND fgd.language_id = '" . (int)$language_id . "' ORDER BY fgd.name, fd.name ASC");
		
		if($query->num_rows) {
			foreach($query->rows as $result) {
				$filters[] = array(
					'name' 			=> $result['filter_group'] . $this->language->get('text_separator') . $result['name'],
					'filter_id'		=> $result['filter_id']
				);
			}
		} 
		
		
		return $filters;
	}
				
	public function getAttributes() {
	
		$query = $this->db->query("SELECT language_id FROM " . DB_PREFIX . "language WHERE `code` = '" . $this->config->get('config_admin_language') . "'");
		$language_id = $query->row['language_id'];
		
		$attribute_groups =  array();
		$attributes = array();
		
		$query = $this->db->query("SELECT ad.name, a.attribute_id, agd.name AS attribute_group
										FROM " . DB_PREFIX . "attribute a 
										LEFT JOIN " . DB_PREFIX . "attribute_description ad ON ad.attribute_id = a.attribute_id
										LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON agd.attribute_group_id = a.attribute_group_id
										WHERE ad.language_id = '" . (int)$language_id . "' AND agd.language_id = '" . (int)$language_id . "' ORDER BY agd.name, ad.name ASC");
		
		if($query->num_rows) {
			foreach($query->rows as $result) {
				$attributes[] = array(
					'name' 			=> $result['attribute_group'] . $this->language->get('text_separator') . $result['name'],
					'attribute_id'		=> $result['attribute_id']
				);
			}
		} 
		
		return $attributes;
	}
				
	public function getDownloads() {
	
		$query = $this->db->query("SELECT language_id FROM " . DB_PREFIX . "language WHERE `code` = '" . $this->config->get('config_admin_language') . "'");
		$language_id = $query->row['language_id'];
		
		$downloads = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "download_description WHERE language_id = '" . (int)$language_id . "' ORDER BY name ASC");
		
		if($query->num_rows) {
			foreach($query->rows as $result) {
				$downloads[] = array(
					'name' 				=> $result['name'],
					'download_id'		=> $result['download_id']
				);
			}
		} 
		
		return $downloads;
	}
				
	public function getOptions() {
	
		$query = $this->db->query("SELECT language_id FROM " . DB_PREFIX . "language WHERE `code` = '" . $this->config->get('config_admin_language') . "'");
		$language_id = $query->row['language_id'];
		
		$options = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_description WHERE language_id = '" . (int)$language_id . "' ORDER BY name ASC");
		
		if($query->num_rows) {
			foreach($query->rows as $result) {
				$options[] = array(
					'name' 			=> $result['name'],
					'option_id'		=> $result['option_id']
				);
			}
		} 
		
		return $options;
	}
				
	public function getOptionData($option_id) {
	
		$query = $this->db->query("SELECT language_id FROM " . DB_PREFIX . "language WHERE `code` = '" . $this->config->get('config_admin_language') . "'");
		$language_id = $query->row['language_id'];
		
		$option_data = array();
		
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "option` o LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE o.option_id = '" . (int)$option_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		if($query->num_rows) {
			foreach($query->rows as $result) {
				$option_data = array(
					'name' 			=> $result['name'],
					'option_id'		=> $result['option_id'],
					'type'			=> $result['type']
				);
			}
		}
		
		$option_value_data = array();
		
		$option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value ov LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE ov.option_id = '" . (int)$option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order, ovd.name ASC");
				
		foreach ($option_value_query->rows as $option_value) {
			$option_value_data[] = array(
				'option_value_id' => $option_value['option_value_id'],
				'name'            => $option_value['name'],
				'image'           => $option_value['image'],
				'sort_order'      => $option_value['sort_order']
			);
		}
		
		$option_data['option_value_data'] = $option_value_data;
		
		$type = '';
		
		if ($option_data['type'] == 'select' || $option_data['type'] == 'radio' || $option_data['type'] == 'checkbox' || $option_data['type'] == 'image') {
			$type = $this->language->get('text_choose');
		}
		
		if ($option_data['type'] == 'text' || $option_data['type'] == 'textarea') {
			$type = $this->language->get('text_input');
		}
		
		if ($option_data['type'] == 'file') {
			$type = $this->language->get('text_file');
		}
		
		if ($option_data['type'] == 'date' || $option_data['type'] == 'datetime' || $option_data['type'] == 'time') {
			$type = $this->language->get('text_date');
		}

		$option_data['category'] = $type;
		
		return $option_data;
	}
				
	public function getProductFilters($product_id) {
	
		$product_filters = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . $product_id . "'");
		
		if($query->num_rows) {
			foreach($query->rows as $result) {
				$product_filters[] = $result['filter_id'];
			}
		}

		return $product_filters;
	}
				
	public function getCategoryFilters($category_id) {
	
		$category_filters = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_filter WHERE category_id = '" . $category_id . "'");
		
		if($query->num_rows) {
			foreach($query->rows as $result) {
				$category_filters[] = $result['filter_id'];
			}
		}

		return $category_filters;
	}
				
	public function excludeCategories($category_id) {
	
		$exclude = array();
		$exclude[] = $category_id;
		$flag = true;
		
		while($flag == true) {
		
			foreach($exclude as $cat_id) {
				$flag = false;
				$children = $this->getChildCategories($cat_id);
				
				if ($children) {
					foreach ($children as $result) {
						if(!in_array($result, $exclude)) {
							$exclude[] = $result;
							$flag = true;
						}
					}
				}
			}
		}
		
		return $exclude;
	}
				
	public function getChildCategories($category_id) {
	
		$children = array();
		$query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "category WHERE parent_id = '" . $category_id . "'");
		if($query->num_rows) {
			foreach ($query->rows as $result) {
				$children[] = $result['category_id'];
				$this->getChildCategories($result['category_id']);
			}
		}
		return $children;
	}
				
	public function getPath($category_id) {
		$query = $this->db->query("SELECT name, parent_id FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");
		
		if ($query->row['parent_id']) {
			return $this->getPath($query->row['parent_id'], $this->config->get('config_language_id')) . $this->language->get('text_separator') . $query->row['name'];
		} else {
			return $query->row['name'];
		}
	}
		
	
}
?>