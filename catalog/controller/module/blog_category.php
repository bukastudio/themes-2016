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

class ControllerModuleBlogCategory extends Controller {
	protected function index() {
		$this->language->load('module/blog_category');

    	$this->data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['cat_id'])) {
			$cat_id = explode('_', (string)$this->request->get['cat_id']);
		} else {
			$cat_id = array();
		}

		if (isset($cat_id[0])) {
			$this->data['blog_category_id'] = $cat_id[0];
		} else {
			$this->data['blog_category_id'] = 0;
		}

		if (isset($cat_id[1])) {
			$this->data['child_id'] = $cat_id[1];
		} else {
			$this->data['child_id'] = 0;
		}

		$this->load->model('catalog/blog_category');
		$this->load->model('catalog/blog');

		$this->data['categories'] = array();

		$categories = $this->model_catalog_blog_category->getBlogCategories(0);

		foreach ($categories as $category) {
			$children_data = array();

			$children = $this->model_catalog_blog_category->getBlogCategories($category['blog_category_id']);

			foreach ($children as $child) {
				$data = array(
					'filter_blog_category_id'  => $child['blog_category_id'],
					'filter_sub_blog_category' => true
				);

				$blog_total = $this->model_catalog_blog->getTotalBlog($data);

				$children_data[] = array(
					'blog_category_id' => $child['blog_category_id'],
					'name'        => $child['name'],
					'href'        => $this->url->link('blog/blog_category', 'cat_id=' . $category['blog_category_id'] . '_' . $child['blog_category_id'])
				);
			}

			$data = array(
				'filter_blog_category_id'  => $category['blog_category_id'],
				'filter_sub_blog_category' => true
			);

			$blog_total = $this->model_catalog_blog->getTotalBlog($data);

			$this->data['categories'][] = array(
				'blog_category_id' => $category['blog_category_id'],
				'name'        => $category['name'],
				'children'    => $children_data,
				'href'        => $this->url->link('blog/blog_category', 'cat_id=' . $category['blog_category_id'])
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/blog_category.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/blog_category.tpl';
		} else {
			$this->template = 'default/template/module/blog_category.tpl';
		}

		$this->render();
  	}
}
?>