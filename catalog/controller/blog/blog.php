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

class ControllerBlogBlog extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('blog/blog');

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_blog'),
			'href'      => $this->url->link('blog/all', ''),
			'separator' => $this->language->get('text_separator')
		);

		$this->load->model('catalog/blog_category');

		if (isset($this->request->get['cat_id'])) {
			$cat_id = '';

			foreach (explode('_', $this->request->get['cat_id']) as $cat_id_item) {
				if (!$cat_id) {
					$cat_id = $cat_id_item;
				} else {
					$cat_id .= '_' . $cat_id_item;
				}

				$blog_category_info = $this->model_catalog_blog_category->getBlogCategory($cat_id_item);

				if ($blog_category_info) {
					$this->data['breadcrumbs'][] = array(
						'text'      => $blog_category_info['name'],
						'href'      => $this->url->link('blog/blog_category', 'cat_id=' . $cat_id),
						'separator' => $this->language->get('text_separator')
					);
				}
			}
		}else{
			$blog_category_info = 0;
		}
		//var_dump($blog_category_info);

		if (isset($this->request->get['filter_name_blog']) || isset($this->request->get['filter_tag'])) {
			$url = '';

			if (isset($this->request->get['filter_name_blog'])) {
				$url .= '&filter_name_blog=' . $this->request->get['filter_name_blog'];
			}

			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}

			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}

			if (isset($this->request->get['filter_blog_category_id'])) {
				$url .= '&filter_blog_category_id=' . $this->request->get['filter_blog_category_id'];
			}

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_search'),
				'href'      => $this->url->link('blog/search', $url),
				'separator' => $this->language->get('text_separator')
			);
		}

		if (isset($this->request->get['blog_id'])) {
			$blog_id = $this->request->get['blog_id'];
		} else {
			$blog_id = 0;
		}

		$this->load->model('catalog/blog');

		$blog_info = $this->model_catalog_blog->getNew($blog_id);

		$this->data['blog_info'] = $blog_info;

		if ($blog_info) {
			$url = '';

			if (isset($this->request->get['cat_id'])) {
				$url .= '&cat_id=' . $this->request->get['cat_id'];
			}

			if (isset($this->request->get['filter_name_blog'])) {
				$url .= '&filter_name_blog=' . $this->request->get['filter_name_blog'];
			}

			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}

			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}

			if (isset($this->request->get['filter_blog_category_id'])) {
				$url .= '&filter_blog_category_id=' . $this->request->get['filter_blog_category_id'];
			}

			$this->data['breadcrumbs'][] = array(
				'text'      => $blog_info['name'],
				'href'      => $this->url->link('blog/blog', $url . '&blog_id=' . $this->request->get['blog_id']),
				'separator' => $this->language->get('text_separator')
			);

			$this->document->setTitle($blog_info['name']);
			$this->document->setDescription($blog_info['meta_description']);
			$this->document->setKeywords($blog_info['meta_keyword']);
			$this->document->addLink($this->url->link('blog/blog', 'blog_id=' . $this->request->get['blog_id']), 'canonical');

			$this->data['heading_title'] = $blog_info['name'];

			$this->data['text_select'] = $this->language->get('text_select');
			$this->data['text_share'] = $this->language->get('text_share');
			$this->data['text_wait'] = $this->language->get('text_wait');
			$this->data['text_tags'] = $this->language->get('text_tags');

			$this->data['button_continue'] = $this->language->get('button_continue');
			$this->data['continue'] = $this->url->link('blog/all');
			$this->data['tab_description'] = $this->language->get('tab_description');
			$this->data['tab_related'] = $this->language->get('tab_related');
			$this->data['tab_others'] = $this->language->get('tab_others');

			$this->data['blog_id'] = $this->request->get['blog_id'];

			$this->load->model('tool/image');

			if ($blog_info['image']) {
				$this->data['popup'] = $this->model_tool_image->resize($blog_info['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			} else {
				$this->data['popup'] = '';
			}

			if ($blog_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($blog_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			} else {
				$this->data['thumb'] = '';
			}
			$this->data['date_added'] = date($this->language->get('date_format_long') . ' - H:i:s', strtotime($blog_info['date_added']));
			$this->data['short_description'] = html_entity_decode($blog_info['short_description'], ENT_QUOTES, 'UTF-8');
			$this->data['description'] = html_entity_decode($blog_info['description'], ENT_QUOTES, 'UTF-8');

			$this->data['blog'] = array();

			$results = $this->model_catalog_blog->getBlogRelated($this->request->get['blog_id']);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				} else {
					$image = false;
				}

				$this->data['blog'][] = array(
					'blog_id' => $result['blog_id'],
					'thumb'   	 => $image,
					'name'    	 => $result['name'],
					'date_added'       => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'href'    	 => $this->url->link('blog/blog', $url . '&blog_id=' . $result['blog_id']),
				);
			}

			// other blog
			$this->data['other_blog'] = array();

			$results = $this->model_catalog_blog->getOtherBlog($blog_category_info['blog_category_id'], $this->request->get['blog_id'], 20);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				} else {
					$image = false;
				}

				$this->data['other_blog'][] = array(
					'blog_id' => $result['blog_id'],
					'thumb'   	 => $image,
					'name'    	 => $result['name'],
					'date_added'       => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'href'    	 => $this->url->link('blog/blog', $url . '&blog_id=' . $result['blog_id']),
				);
			}

			$this->data['tags'] = array();

			$results = $this->model_catalog_blog->getBlogTags($this->request->get['blog_id']);

			foreach ($results as $result) {
				$this->data['tags'][] = array(
					'tag'  => $result['tag'],
					'href' => $this->url->link('blog/search', 'filter_tag=' . $result['tag'])
				);
			}

			$this->model_catalog_blog->updateViewed($this->request->get['blog_id']);

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/blog.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/blog/blog.tpl';
			} else {
				$this->template = 'default/template/blog/blog.tpl';
			}

			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);

			$this->response->setOutput($this->render());
		} else {
			$url = '';

			if (isset($this->request->get['cat_id'])) {
				$url .= '&cat_id=' . $this->request->get['cat_id'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['filter_name_blog'])) {
				$url .= '&filter_name_blog=' . $this->request->get['filter_name_blog'];
			}

			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}

			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}

			if (isset($this->request->get['filter_blog_category_id'])) {
				$url .= '&filter_blog_category_id=' . $this->request->get['filter_blog_category_id'];
			}

      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('blog/blog', $url . '&blog_id=' . $blog_id),
        		'separator' => $this->language->get('text_separator')
      		);

      		$this->document->setTitle($this->language->get('text_error'));

      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}

			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);

			$this->response->setOutput($this->render());
    	}
  }
}
?>