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
	public function addBlog($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "blog SET date_available = '" . $this->db->escape($data['date_available']) . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");

		$blog_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog SET image = '" . $this->db->escape($data['image']) . "' WHERE blog_id = '" . (int)$blog_id . "'");
		}

		foreach ($data['blog_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_description SET blog_id = '" . (int)$blog_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		if (isset($data['blog_store'])) {
			foreach ($data['blog_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_store SET blog_id = '" . (int)$blog_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['blog_category'])) {
			foreach ($data['blog_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_category SET blog_id = '" . (int)$blog_id . "', blog_category_id = '" . (int)$category_id . "'");
			}
		}

		if (isset($data['blog_related'])) {
			foreach ($data['blog_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_related WHERE blog_id = '" . (int)$blog_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_related SET blog_id = '" . (int)$blog_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_related WHERE blog_id = '" . (int)$related_id . "' AND related_id = '" . (int)$blog_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_related SET blog_id = '" . (int)$related_id . "', related_id = '" . (int)$blog_id . "'");
			}
		}

		foreach ($data['blog_tag'] as $language_id => $value) {
			if ($value) {
				$tags = explode(',', $value);

				foreach ($tags as $tag) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "blog_tag SET blog_id = '" . (int)$blog_id . "', language_id = '" . (int)$language_id . "', tag = '" . $this->db->escape(trim($tag)) . "'");
				}
			}
		}

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'blog_id=" . (int)$blog_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('blog');
	}

	public function editBlog($blog_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "blog SET date_available = '" . $this->db->escape($data['date_available']) . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE blog_id = '" . (int)$blog_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog SET image = '" . $this->db->escape($data['image']) . "' WHERE blog_id = '" . (int)$blog_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_description WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($data['blog_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_description SET blog_id = '" . (int)$blog_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_store WHERE blog_id = '" . (int)$blog_id . "'");

		if (isset($data['blog_store'])) {
			foreach ($data['blog_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_store SET blog_id = '" . (int)$blog_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_category WHERE blog_id = '" . (int)$blog_id . "'");

		if (isset($data['blog_category'])) {
			foreach ($data['blog_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_category SET blog_id = '" . (int)$blog_id . "', blog_category_id = '" . (int)$category_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_related WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_related WHERE related_id = '" . (int)$blog_id . "'");

		if (isset($data['blog_related'])) {
			foreach ($data['blog_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_related WHERE blog_id = '" . (int)$blog_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_related SET blog_id = '" . (int)$blog_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_related WHERE blog_id = '" . (int)$related_id . "' AND related_id = '" . (int)$blog_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_related SET blog_id = '" . (int)$related_id . "', related_id = '" . (int)$blog_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_tag WHERE blog_id = '" . (int)$blog_id. "'");

		foreach ($data['blog_tag'] as $language_id => $value) {
			if ($value) {
				$tags = explode(',', $value);

				foreach ($tags as $tag) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "blog_tag SET blog_id = '" . (int)$blog_id . "', language_id = '" . (int)$language_id . "', tag = '" . $this->db->escape(trim($tag)) . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_id=" . (int)$blog_id. "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'blog_id=" . (int)$blog_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('blog');
	}

	public function copyBlog($blog_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_description nd ON (n.blog_id = nd.blog_id) WHERE n.blog_id = '" . (int)$blog_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		if ($query->num_rows) {
			$data = array();

			$data = $query->row;

			$data['keyword'] = '';

			$data['status'] = '0';

			$data = array_merge($data, array('blog_description' => $this->getBlogDescriptions($blog_id)));
			$data = array_merge($data, array('blog_related' => $this->getBlogRelated($blog_id)));
			$data = array_merge($data, array('blog_tag' => $this->getBlogTags($blog_id)));
			$data = array_merge($data, array('blog_category' => $this->getBlogCategories($blog_id)));
			$data = array_merge($data, array('blog_store' => $this->getBlogStores($blog_id)));

			$this->addBlog($data);
		}
	}

	public function deleteBlog($blog_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_description WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_related WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_related WHERE related_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_tag WHERE blog_id='" . (int)$blog_id. "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_category WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_store WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_id=" . (int)$blog_id. "'");

		$this->cache->delete('blog');
	}

	public function getNew($blog_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_id=" . (int)$blog_id . "') AS keyword FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_description nd ON (n.blog_id = nd.blog_id) WHERE n.blog_id = '" . (int)$blog_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getBlog($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_description nd ON (n.blog_id = nd.blog_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

			if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
				$sql .= " AND LCASE(nd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'UTF-8')) . "%'";
			}

			if (isset($data['filter_short_description']) && !is_null($data['filter_short_description'])) {
				$sql .= " AND LCASE(nd.short_description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_short_description'], 'UTF-8')) . "%'";
			}

			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND n.status = '" . (int)$data['filter_status'] . "'";
			}

			$sort_data = array(
				'n.date_added',
				'nd.name',
				'n.status',
				'n.sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY n.date_added";
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
			$blog_data = $this->cache->get('blog.' . $this->config->get('config_language_id'));

			if (!$blog_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_description nd ON (n.blog_id = nd.blog_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY nd.name ASC");

				$blog_data = $query->rows;

				$this->cache->set('blog.' . $this->config->get('config_language_id'), $blog_data);
			}

			return $blog_data;
		}
	}

	public function getBlogByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_description nd ON (n.blog_id = nd.blog_id) LEFT JOIN " . DB_PREFIX . "blog_to_category n2c ON (n.blog_id = n2c.blog_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2c.category_id = '" . (int)$category_id . "' ORDER BY nd.name ASC");

		return $query->rows;
	}

	public function getBlogDescriptions($blog_id) {
		$blog_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_description WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_description_data[$result['language_id']] = array(
				'name'             				=> $result['name'],
				'short_description'      	=> $result['short_description'],
				'description'      				=> $result['description'],
				'meta_keyword'     				=> $result['meta_keyword'],
				'meta_description' 				=> $result['meta_description']
			);
		}

		return $blog_description_data;
	}

	public function getBlogStores($blog_id) {
		$blog_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_to_store WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_store_data[] = $result['store_id'];
		}

		return $blog_store_data;
	}

	public function getBlogCategories($blog_id) {
		$blog_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_to_category WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_category_data[] = $result['blog_category_id'];
		}

		return $blog_category_data;
	}

	public function getBlogRelated($blog_id) {
		$blog_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_related WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_related_data[] = $result['related_id'];
		}

		return $blog_related_data;
	}

	public function getBlogTags($blog_id) {
		$blog_tag_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_tag WHERE blog_id = '" . (int)$blog_id . "'");

		$tag_data = array();

		foreach ($query->rows as $result) {
			$tag_data[$result['language_id']][] = $result['tag'];
		}

		foreach ($tag_data as $language => $tags) {
			$blog_tag_data[$language] = implode(',', $tags);
		}

		return $blog_tag_data;
	}

	public function getTotalBlog($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog n LEFT JOIN " . DB_PREFIX . "blog_description nd ON (n.blog_id = nd.blog_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
			$sql .= " AND LCASE(nd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'UTF-8')) . "%'";
		}

		if (isset($data['filter_short_description']) && !is_null($data['filter_short_description'])) {
				$sql .= " AND LCASE(nd.short_description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_short_description'], 'UTF-8')) . "%'";
			}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND n.status = '" . (int)$data['filter_status'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

}
?>