<?php
/*------------------------------------------------------------------------
# Advanced Blog System for OpenCart 1.5.x
# ------------------------------------------------------------------------
# Copyright (C) 2011 OpenCartSoft.com. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: www.OpenCartSoft.com
# Websites:  http://www.opencartsoft.com -  Email: admin@opencartsoft.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/

class ModelCatalogBlog extends Model {
	public function updateViewed($blog_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "blog SET viewed = (viewed + 1) WHERE blog_id = '" . (int)$blog_id . "'");
	}

	public function getNew($blog_id) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$query = $this->db->query("SELECT DISTINCT *, nd.name AS name, n.image FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_description nd ON (n.blog_id = nd.blog_id) LEFT JOIN " . DB_PREFIX . "blog_to_store n2s ON (n.blog_id = n2s.blog_id) WHERE n.blog_id = '" . (int)$blog_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return array(
				'blog_id'       => $query->row['blog_id'],
				'name'             => $query->row['name'],
				'short_description'      => $query->row['short_description'],
				'description'      => $query->row['description'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'image'            => $query->row['image'],
				'date_available'   => $query->row['date_available'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed']
			);
		} else {
			return false;
		}
	}

	public function getBlog($data = array()) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$sql = "SELECT n.blog_id FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_description nd ON (n.blog_id = nd.blog_id) LEFT JOIN " . DB_PREFIX . "blog_to_store n2s ON (n.blog_id = n2s.blog_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (isset($data['filter_name_blog']) && $data['filter_name_blog']) {
			if (isset($data['filter_description']) && $data['filter_description']) {
				$sql .= " AND (LCASE(nd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%' OR n.blog_id IN (SELECT nt.blog_id FROM " . DB_PREFIX . "blog_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND LCASE(nt.tag) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%') OR LCASE(nd.short_description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%' OR LCASE(nd.description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%')";
			} else {
				$sql .= " AND (LCASE(nd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%' OR n.blog_id IN (SELECT nt.blog_id FROM " . DB_PREFIX . "blog_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND LCASE(nt.tag) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%'))";
			}
		}

		if (isset($data['filter_tag']) && $data['filter_tag']) {
			$sql .= " AND n.blog_id IN (SELECT nt.blog_id FROM " . DB_PREFIX . "blog_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND LCASE(nt.tag) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_tag'], 'UTF-8')) . "%')";
		}

		if (isset($data['filter_blog_category_id']) && $data['filter_blog_category_id']) {
			if (isset($data['filter_sub_blog_category']) && $data['filter_sub_blog_category']) {
				$implode_data = array();

				$this->load->model('catalog/blog_category');

				$categories = $this->model_catalog_blog_category->getCategoriesByParentId($data['filter_blog_category_id']);

				foreach ($categories as $blog_category_id) {
					$implode_data[] = "n2c.blog_category_id = '" . (int)$blog_category_id . "'";
				}

				$sql .= " AND n.blog_id IN (SELECT n2c.blog_id FROM " . DB_PREFIX . "blog_to_category n2c WHERE " . implode(' OR ', $implode_data) . ")";
			} else {
				$sql .= " AND n.blog_id IN (SELECT n2c.blog_id FROM " . DB_PREFIX . "blog_to_category n2c WHERE n2c.blog_category_id = '" . (int)$data['filter_blog_category_id'] . "')";
			}
		}

		//$sql .= " ORDER BY n.sort_order ASC, n.date_added DESC";

		$sort_data = array(
			'nd.name',
			'n.viewed',
			'n.sort_order',
			'n.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'nd.name') {
				$sql .= " ORDER BY n.sort_order, LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY n.sort_order, " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY n.sort_order";
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

		$blog_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$blog_data[$result['blog_id']] = $this->getNew($result['blog_id']);
		}

		return $blog_data;
	}

	public function getLatestBlog($limit) {
		$blog_data = $this->cache->get('blog.latest.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit);

		if (!$blog_data) {
			$query = $this->db->query("SELECT n.blog_id FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_to_store n2s ON (n.blog_id = n2s.blog_id) WHERE n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY n.date_added DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$blog_data[$result['blog_id']] = $this->getNew($result['blog_id']);
			}

			$this->cache->set('blog.latest.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit, $blog_data);
		}

		return $blog_data;
	}

	public function getPopularBlog($limit) {
		$blog_data = array();

		$query = $this->db->query("SELECT n.blog_id FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_to_store n2s ON (n.blog_id = n2s.blog_id) WHERE n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY n.viewed DESC, n.date_added DESC LIMIT " . (int)$limit);

		foreach ($query->rows as $result) {
			$blog_data[$result['blog_id']] = $this->getNew($result['blog_id']);
		}

		return $blog_data;
	}

	public function getBlogRelated($blog_id) {
		$blog_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_related nr LEFT JOIN " . DB_PREFIX . "blog n ON (nr.related_id = n.blog_id) LEFT JOIN " . DB_PREFIX . "blog_to_store n2s ON (n.blog_id = n2s.blog_id) WHERE nr.blog_id = '" . (int)$blog_id . "' AND n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY n.sort_order ASC, n.date_added DESC");

		foreach ($query->rows as $result) {
			$blog_data[$result['related_id']] = $this->getNew($result['related_id']);
		}

		return $blog_data;
	}

	public function getOtherBlog($blog_category_id, $blog_id, $limit) {
		$blog_data = array();
		if(empty($blog_category_id)){
			$query = $this->db->query("SELECT n.blog_id FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_to_store n2s ON (n.blog_id = n2s.blog_id) WHERE n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.blog_id != ".$blog_id." AND n.blog_id < ".$blog_id." ORDER BY n.sort_order ASC, n.date_added DESC  LIMIT " . (int)$limit);
		}else{
			$query = $this->db->query("SELECT n.blog_id FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_to_store n2s ON (n.blog_id = n2s.blog_id) LEFT JOIN " . DB_PREFIX . "blog_to_category n2c ON (n.blog_id = n2c.blog_id) WHERE n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n2c.blog_category_id = '" . (int)$blog_category_id . "' AND n.blog_id != ".$blog_id." AND n.blog_id < ".$blog_id." ORDER BY n.sort_order ASC, n.date_added DESC  LIMIT " . (int)$limit);
		}

		foreach ($query->rows as $result) {
			$blog_data[$result['blog_id']] = $this->getNew($result['blog_id']);
		}

		return $blog_data;
	}

	public function getBlogTags($blog_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_tag WHERE blog_id = '" . (int)$blog_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->rows;
	}

	public function getBlogCategories($blog_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_to_category WHERE blog_id = '" . (int)$blog_id . "'");

		return $query->rows;
	}

	public function getTotalBlog($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_description nd ON (n.blog_id = nd.blog_id) LEFT JOIN " . DB_PREFIX . "blog_to_store n2s ON (n.blog_id = n2s.blog_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (isset($data['filter_name_blog'])) {
			if (isset($data['filter_description']) && $data['filter_description']) {
				$sql .= " AND (LCASE(nd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%' OR n.blog_id IN (SELECT nt.blog_id FROM " . DB_PREFIX . "blog_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND LCASE(nt.tag) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%') OR LCASE(nd.short_description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%' OR LCASE(nd.description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%')";
			} else {
				$sql .= " AND (LCASE(nd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%' OR n.blog_id IN (SELECT nt.blog_id FROM " . DB_PREFIX . "blog_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND LCASE(nt.tag) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name_blog'], 'UTF-8')) . "%'))";
			}
		}

		if (isset($data['filter_tag']) && $data['filter_tag']) {
			$sql .= " AND n.blog_id IN (SELECT nt.blog_id FROM " . DB_PREFIX . "blog_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND LCASE(nt.tag) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_tag'], 'UTF-8')) . "%')";
		}

		if (isset($data['filter_blog_category_id']) && $data['filter_blog_category_id']) {
			if (isset($data['filter_sub_blog_category']) && $data['filter_sub_blog_category']) {
				$implode_data = array();

				$this->load->model('catalog/blog_category');

				$categories = $this->model_catalog_blog_category->getBlogCategoriesByParentId($data['filter_blog_category_id']);

				foreach ($categories as $blog_category_id) {
					$implode_data[] = "n2c.blog_category_id = '" . (int)$blog_category_id . "'";
				}

				$sql .= " AND n.blog_id IN (SELECT n2c.blog_id FROM " . DB_PREFIX . "blog_to_category n2c WHERE " . implode(' OR ', $implode_data) . ")";
			} else {
				$sql .= " AND n.blog_id IN (SELECT n2c.blog_id FROM " . DB_PREFIX . "blog_to_category n2c WHERE n2c.blog_category_id = '" . (int)$data['filter_blog_category_id'] . "')";
			}
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

}
?>