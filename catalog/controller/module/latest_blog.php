<?php
/*------------------------------------------------------------------------
# Latest Blog Module for Advanced Blog Extension - Module for OpenCart 1.5.1.x
# ------------------------------------------------------------------------
# Copyright (C) 2011 OpenCartSoft.com. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: www.OpenCartSoft.com
# Websites:  http://www.opencartsoft.com -  Email: admin@opencartsoft.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/

class ControllerModuleLatestBlog extends Controller {
	protected function index($setting) {
		$this->language->load('module/latest_blog');

    $this->data['heading_title'] = $this->language->get('heading_title');

		$this->load->model('catalog/blog');

		$this->load->model('tool/image');

		$this->data['blog'] = array();

		$data = array(
			'sort'  => 'n.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_blog->getBlog($data);

		foreach ($results as $result) {
			$width = ''; $height = '';
			if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
			} else {
				$firstImgBlog = $this->catchFirstImage(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'));
				if($firstImgBlog == 'no_image.jpg'){
					$image = $this->model_tool_image->resize('no_image.jpg', $setting['image_width'], $setting['image_height']);
				}else{
					$image = $firstImgBlog; $width = 'width="'.$setting['image_width'].'"'; $height = 'height="'.$setting['image_height'].'"';
				}
			}

				if (empty($result['short_description'])) {
					$short_description = substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 500).' ...';
				}else{
					$short_description = $result['short_description'];
				}

			$this->data['blog'][] = array(
				'blog_id' => $result['blog_id'],
				'thumb'   	 => $image,
				'name'    	 => $result['name'],
				'short_description'       => $short_description,
				'date_added'       => date('H:i:s - '.$this->language->get('date_format_short'), strtotime($result['date_added'])),
				'width'      => $width,
				'height'      => $height,
				'href'    	 => $this->url->link('blog/blog', 'blog_id=' . $result['blog_id']),
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/latest_blog.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/latest_blog.tpl';
		} else {
			$this->template = 'default/template/module/latest_blog.tpl';
		}

		$this->render();
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