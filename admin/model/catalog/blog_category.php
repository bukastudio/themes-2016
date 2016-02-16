<?php
/*------------------------------------------------------------------------
# Advanced Blog Extension - Module for OpenCart 1.5.1.x
# ------------------------------------------------------------------------
# Copyright (C) 2011 OpenCartSoft.com. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: www.OpenCartSoft.com
# Websites:  http://www.opencartsoft.com -  Email: admin@opencartsoft.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/

class ModelCatalogBlogCategory extends Model {
	public function addBlogCategory($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category SET parent_id = '" . (int)$data['parent_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$blog_category_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog_category SET image = '" . $this->db->escape($data['image']) . "' WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		}

		foreach ($data['blog_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category_description SET blog_category_id = '" . (int)$blog_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		if (isset($data['blog_category_store'])) {
			foreach ($data['blog_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category_to_store SET blog_category_id = '" . (int)$blog_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'blog_category_id=" . (int)$blog_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('blog_category');
	}

	public function editBlogCategory($blog_category_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "blog_category SET parent_id = '" . (int)$data['parent_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE blog_category_id = '" . (int)$blog_category_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog_category SET image = '" . $this->db->escape($data['image']) . "' WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category_description WHERE blog_category_id = '" . (int)$blog_category_id . "'");

		foreach ($data['blog_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category_description SET blog_category_id = '" . (int)$blog_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category_to_store WHERE blog_category_id = '" . (int)$blog_category_id . "'");

		if (isset($data['blog_category_store'])) {
			foreach ($data['blog_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category_to_store SET blog_category_id = '" . (int)$blog_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_category_id=" . (int)$blog_category_id. "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'blog_category_id=" . (int)$blog_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('blog_category');
	}

	public function deleteBlogCategory($blog_category_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category_description WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category_to_store WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_category_id=" . (int)$blog_category_id . "'");

		$query = $this->db->query("SELECT blog_category_id FROM " . DB_PREFIX . "blog_category WHERE parent_id = '" . (int)$blog_category_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteBlogCategory($result['blog_category_id']);
		}

		$this->cache->delete('blog_category');
	}

	public function getBlogCategory($blog_category_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_category_id=" . (int)$blog_category_id . "') AS keyword FROM " . DB_PREFIX . "blog_category WHERE blog_category_id = '" . (int)$blog_category_id . "'");

		return $query->row;
	}

	public function getBlogCategories($parent_id) {
		$blog_category_data = $this->cache->get('blog_category.' . $this->config->get('config_language_id') . '.' . $parent_id);

		if (!$blog_category_data) {
			$blog_category_data = array();

			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_category c LEFT JOIN " . DB_PREFIX . "blog_category_description cd ON (c.blog_category_id = cd.blog_category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");

			foreach ($query->rows as $result) {
				$blog_category_data[] = array(
					'blog_category_id' => $result['blog_category_id'],
					'name'        => $this->getPath($result['blog_category_id'], $this->config->get('config_language_id')),
					'status'  	  => $result['status'],
					'sort_order'  => $result['sort_order']
				);

				$blog_category_data = array_merge($blog_category_data, $this->getBlogCategories($result['blog_category_id']));
			}

			$this->cache->set('blog_category.' . $this->config->get('config_language_id') . '.' . $parent_id, $blog_category_data);
		}

		return $blog_category_data;
	}

	public function getPath($blog_category_id) {
		$query = $this->db->query("SELECT name, parent_id FROM " . DB_PREFIX . "blog_category c LEFT JOIN " . DB_PREFIX . "blog_category_description cd ON (c.blog_category_id = cd.blog_category_id) WHERE c.blog_category_id = '" . (int)$blog_category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");

		$blog_category_info = $query->row;

		if ($blog_category_info['parent_id']) {
			return $this->getPath($blog_category_info['parent_id'], $this->config->get('config_language_id')) . $this->language->get('text_separator') . $blog_category_info['name'];
		} else {
			return $blog_category_info['name'];
		}
	}

	public function getBlogCategoryDescriptions($blog_category_id) {
		$blog_category_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_category_description WHERE blog_category_id = '" . (int)$blog_category_id . "'");

		foreach ($query->rows as $result) {
			$blog_category_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'description'      => $result['description']
			);
		}

		return $blog_category_description_data;
	}

	public function getBlogCategoryStores($blog_category_id) {
		$blog_category_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_category_to_store WHERE blog_category_id = '" . (int)$blog_category_id . "'");

		foreach ($query->rows as $result) {
			$blog_category_store_data[] = $result['store_id'];
		}

		return $blog_category_store_data;
	}

	public function getTotalBlogCategories() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_category");

		return $query->row['total'];
	}

	public function getTotalBlogCategoriesByImageId($image_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_category WHERE image_id = '" . (int)$image_id . "'");

		return $query->row['total'];
	}

}
?>