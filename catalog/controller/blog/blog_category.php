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

class ControllerBlogBlogCategory extends Controller {
	public function index() {
		$this->language->load('blog/blog_category');

		$this->load->model('catalog/blog_category');

		$this->load->model('catalog/blog');

		$this->load->model('tool/image');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}

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

		if (isset($this->request->get['cat_id'])) {
			$cat_id = '';

			$parts = explode('_', (string)$this->request->get['cat_id']);

			foreach ($parts as $cat_id_item) {
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

			$blog_category_id = array_pop($parts);
		} else {
			$blog_category_id = 0;
		}

		$blog_category_info = $this->model_catalog_blog_category->getBlogCategory($blog_category_id);

		if ($blog_category_info) {
	  		$this->document->setTitle($blog_category_info['name']);
			$this->document->setDescription($blog_category_info['meta_description']);
			$this->document->setKeywords($blog_category_info['meta_keyword']);

			$this->data['heading_title'] = $blog_category_info['name'];

			$this->data['text_refine'] = $this->language->get('text_refine');
			$this->data['text_empty'] = $this->language->get('text_empty');

			$this->data['text_display'] = $this->language->get('text_display');
			$this->data['text_limit'] = $this->language->get('text_limit');
			$this->data['button_search'] = $this->language->get('button_search');
			$this->data['button_continue'] = $this->language->get('button_continue');

			if ($blog_category_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($blog_category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
			} else {
				$this->data['thumb'] = '';
			}

			$this->data['description'] = html_entity_decode($blog_category_info['description'], ENT_QUOTES, 'UTF-8');

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$this->data['categories'] = array();

			$results = $this->model_catalog_blog_category->getBlogCategories($blog_category_id);

			foreach ($results as $result) {
				$blog_total = $this->model_catalog_blog->getTotalBlog(array('filter_blog_category_id' => $result['blog_category_id']));

				$this->data['categories'][] = array(
					'name'  => $result['name'] . ' (' . $blog_total . ')',
					'href'  => $this->url->link('blog/blog_category', 'cat_id=' . $this->request->get['cat_id'] . '_' . $result['blog_category_id'] . $url)
				);
			}

			$this->data['blog'] = array();

			$data = array(
				'sort'  => 'n.date_added',
				'order' => 'DESC',
				'filter_blog_category_id' => $blog_category_id,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$blog_total = $this->model_catalog_blog->getTotalBlog($data);

			$results = $this->model_catalog_blog->getBlog($data);

			foreach ($results as $result) {
				$width = ''; $height = '';

				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$firstImgBlog = $this->catchFirstImage(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'));
					if($firstImgBlog == 'no_image.jpg'){
						$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
					}else{
						$image = $firstImgBlog; $width = 'width="'.$this->config->get('config_image_product_width').'"'; $height = 'height="'.$this->config->get('config_image_product_height').'"';
					}
				}

				if (empty($result['short_description'])) {
					$short_description = substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 500).' ...';
				}else{
					$short_description = $result['short_description'];
				}


				$this->data['blog'][] = array(
					'blog_id'  => $result['blog_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'short_description'       => $short_description,
					'date_added'       => date('H:i:s - '.$this->language->get('date_format_short'), strtotime($result['date_added'])),
					'width'      => $width,
					'height'      => $height,
					'href'        => $this->url->link('blog/blog', 'cat_id=' . $this->request->get['cat_id'] . '&blog_id=' . $result['blog_id'])
				);
			}

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$url = '';

			$this->data['limits'] = array();

			$this->data['limits'][] = array(
				'text'  => $this->config->get('config_catalog_limit'),
				'value' => $this->config->get('config_catalog_limit'),
				'href'  => $this->url->link('blog/blog_category', 'cat_id=' . $this->request->get['cat_id'] . $url . '&limit=' . $this->config->get('config_catalog_limit'))
			);

			$this->data['limits'][] = array(
				'text'  => 25,
				'value' => 25,
				'href'  => $this->url->link('blog/blog_category', 'cat_id=' . $this->request->get['cat_id'] . $url . '&limit=25')
			);

			$this->data['limits'][] = array(
				'text'  => 50,
				'value' => 50,
				'href'  => $this->url->link('blog/blog_category', 'cat_id=' . $this->request->get['cat_id'] . $url . '&limit=50')
			);

			$this->data['limits'][] = array(
				'text'  => 75,
				'value' => 75,
				'href'  => $this->url->link('blog/blog_category', 'cat_id=' . $this->request->get['cat_id'] . $url . '&limit=75')
			);

			$this->data['limits'][] = array(
				'text'  => 100,
				'value' => 100,
				'href'  => $this->url->link('blog/blog_category', 'cat_id=' . $this->request->get['cat_id'] . $url . '&limit=100')
			);

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();
			$pagination->total = $blog_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('blog/blog_category', 'cat_id=' . $this->request->get['cat_id'] . $url . '&page={page}');

			$this->data['pagination'] = $pagination->render();

			$this->data['limit'] = $limit;

			$this->data['continue'] = $this->url->link('blog/all');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/blog_category.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/blog/blog_category.tpl';
			} else {
				$this->template = 'default/template/blog/blog_category.tpl';
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

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('blog/blog_category', $url),
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

  function catchFirstImage($content) {
	  $first_img = '';
	  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
	  if(isset($matches[1][0])){
	  	$first_img = $matches[1][0];
		}
	  if(empty($first_img)){ //Defines a default image
	    $first_img = "no_image.jpg";
	  }
	  return $first_img;
	} //end function
}
?>