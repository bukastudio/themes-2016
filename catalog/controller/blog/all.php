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

class ControllerBlogAll extends Controller {
	public function index() {
		$this->language->load('blog/all');

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
			//$limit = $this->config->get('config_catalog_limit');
			$limit = 5;
		}

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
       		'separator' => false
   		);

   	$data = array(
   			'sort'  => 'n.date_added',
				'order' => 'DESC',
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$blog_total = $this->model_catalog_blog->getTotalBlog($data);

		if ($blog_total > 0) {

	  	$this->document->setTitle($this->language->get('text_blog'));

			$this->data['heading_title'] = $this->language->get('text_blog');

			$this->data['text_blog'] = $this->language->get('text_blog');
			$this->data['text_empty'] = $this->language->get('text_empty');

			$this->data['text_display'] = $this->language->get('text_display');
			$this->data['text_limit'] = $this->language->get('text_limit');
			$this->data['button_search'] = $this->language->get('button_search');
			$this->data['button_continue'] = $this->language->get('button_continue');

			$this->data['breadcrumbs'][] = array(
  		'text'      => $this->language->get('text_blog'),
			'href'      => $this->url->link('blog/all'),
  		'separator' => $this->language->get('text_separator')
  		);

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$this->data['blog'] = array();

			$results = $this->model_catalog_blog->getBlog($data);

			foreach ($results as $result) {
				$width = ''; $height = '';
				if ($result['image']) {
					$image = $result['image'];
				} else {
					$firstImgBlog = $this->catchFirstImage(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'));
					if($firstImgBlog == 'no_image.jpg'){
						$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
					}else{
						$image = $firstImgBlog; $width = 'width="100px"'; $height = 'height="100px"';
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
					'date_added'       => date($this->language->get('date_format_long') . ' - H:i:s', strtotime($result['date_added'])),
					'width'      => $width,
					'height'      => $height,
					'href'        => $this->url->link('blog/blog', '&blog_id=' . $result['blog_id'])
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
				'href'  => $this->url->link('blog/all', $url . '&limit=' . $this->config->get('config_catalog_limit'))
			);

			$this->data['limits'][] = array(
				'text'  => 25,
				'value' => 25,
				'href'  => $this->url->link('blog/all', $url . '&limit=25')
			);

			$this->data['limits'][] = array(
				'text'  => 50,
				'value' => 50,
				'href'  => $this->url->link('blog/all', $url . '&limit=50')
			);

			$this->data['limits'][] = array(
				'text'  => 75,
				'value' => 75,
				'href'  => $this->url->link('blog/all', $url . '&limit=75')
			);

			$this->data['limits'][] = array(
				'text'  => 100,
				'value' => 100,
				'href'  => $this->url->link('blog/all', $url . '&limit=100')
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
			$pagination->url = $this->url->link('blog/all', $url . '&page={page}');

			$this->data['pagination'] = $pagination->render();

			$this->data['limit'] = $limit;

			$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/all.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/blog/all.tpl';
			} else {
				$this->template = 'default/template/blog/all.tpl';
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
				'href'      => $this->url->link('blog/all', $url),
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