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

class ControllerBlogSearch extends Controller {
	public function index() {
    	$this->language->load('blog/search');

		$this->load->model('catalog/blog_category');

		$this->load->model('catalog/blog');

		$this->load->model('tool/image');

		if (isset($this->request->get['filter_name_blog'])) {
			$filter_name_blog = $this->request->get['filter_name_blog'];
		} else {
			$filter_name_blog = '';
		}

		if (isset($this->request->get['filter_tag'])) {
			$filter_tag = $this->request->get['filter_tag'];
		} else {
			$filter_tag = '';
		}

		if (isset($this->request->get['filter_description'])) {
			$filter_description = $this->request->get['filter_description'];
		} else {
			$filter_description = '';
		}

		if (isset($this->request->get['filter_blog_category_id'])) {
			$filter_blog_category_id = $this->request->get['filter_blog_category_id'];
		} else {
			$filter_blog_category_id = 0;
		}

		if (isset($this->request->get['filter_sub_blog_category'])) {
			$filter_sub_blog_category = $this->request->get['filter_sub_blog_category'];
		} else {
			$filter_sub_blog_category = '';
		}

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

		if (isset($this->request->get['keyword'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->request->get['keyword']);
		} else {
			$this->document->setTitle($this->language->get('heading_title'));
		}

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
      		'separator' => false
   		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_blog'),
			'href'      => $this->url->link('blog/all'),
			'separator' => $this->language->get('text_separator')
		);

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

		if (isset($this->request->get['filter_sub_blog_category'])) {
			$url .= '&filter_sub_blog_category=' . $this->request->get['filter_sub_blog_category'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('blog/search', $url),
      		'separator' => $this->language->get('text_separator')
   		);

    	$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_empty'] = $this->language->get('text_empty');
    $this->data['text_critea'] = $this->language->get('text_critea');
    $this->data['text_search'] = $this->language->get('text_search');
		$this->data['text_keyword'] = $this->language->get('text_keyword');
		$this->data['text_blog_category'] = $this->language->get('text_blog_category');
		$this->data['text_sub_blog_category'] = $this->language->get('text_sub_blog_category');
		$this->data['text_limit'] = $this->language->get('text_limit');

		$this->data['entry_search'] = $this->language->get('entry_search');
    $this->data['entry_description'] = $this->language->get('entry_description');

    $this->data['button_search'] = $this->language->get('button_search');

		$this->load->model('catalog/blog_category');

		// 3 Level Category Search
		$this->data['categories'] = array();

		$categories_1 = $this->model_catalog_blog_category->getBlogCategories(0);

		foreach ($categories_1 as $category_1) {
			$level_2_data = array();

			$categories_2 = $this->model_catalog_blog_category->getBlogCategories($category_1['blog_category_id']);

			foreach ($categories_2 as $category_2) {
				$level_3_data = array();

				$categories_3 = $this->model_catalog_blog_category->getBlogCategories($category_2['blog_category_id']);

				foreach ($categories_3 as $category_3) {
					$level_3_data[] = array(
						'blog_category_id' => $category_3['blog_category_id'],
						'name'        => $category_3['name'],
					);
				}

				$level_2_data[] = array(
					'blog_category_id' => $category_2['blog_category_id'],
					'name'        => $category_2['name'],
					'children'    => $level_3_data
				);
			}

			$this->data['categories'][] = array(
				'blog_category_id' => $category_1['blog_category_id'],
				'name'        => $category_1['name'],
				'children'    => $level_2_data
			);
		}

		$this->data['blog'] = array();

		if (isset($this->request->get['filter_name_blog']) || isset($this->request->get['filter_tag'])) {
			$data = array(
				'filter_name_blog'         => $filter_name_blog,
				'filter_tag'          => $filter_tag,
				'filter_description'  => $filter_description,
				'filter_blog_category_id'  => $filter_blog_category_id,
				'filter_sub_blog_category' => $filter_sub_blog_category,
				'start'               => ($page - 1) * $limit,
				'limit'               => $limit
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
					'href'        => $this->url->link('blog/blog', $url . '&blog_id=' . $result['blog_id'])
				);
			}

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

			if (isset($this->request->get['filter_sub_blog_category'])) {
				$url .= '&filter_sub_blog_category=' . $this->request->get['filter_sub_blog_category'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

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

			if (isset($this->request->get['filter_sub_blog_category'])) {
				$url .= '&filter_sub_blog_category=' . $this->request->get['filter_sub_blog_category'];
			}

			$this->data['limits'] = array();

			$this->data['limits'][] = array(
				'text'  => $this->config->get('config_catalog_limit'),
				'value' => $this->config->get('config_catalog_limit'),
				'href'  => $this->url->link('blog/search', $url . '&limit=' . $this->config->get('config_catalog_limit'))
			);

			$this->data['limits'][] = array(
				'text'  => 25,
				'value' => 25,
				'href'  => $this->url->link('blog/search', $url . '&limit=25')
			);

			$this->data['limits'][] = array(
				'text'  => 50,
				'value' => 50,
				'href'  => $this->url->link('blog/search', $url . '&limit=50')
			);

			$this->data['limits'][] = array(
				'text'  => 75,
				'value' => 75,
				'href'  => $this->url->link('blog/search', $url . '&limit=75')
			);

			$this->data['limits'][] = array(
				'text'  => 100,
				'value' => 100,
				'href'  => $this->url->link('blog/search', $url . '&limit=100')
			);

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

			if (isset($this->request->get['filter_sub_blog_category'])) {
				$url .= '&filter_sub_blog_category=' . $this->request->get['filter_sub_blog_category'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();
			$pagination->total = $blog_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('blog/search', $url . '&page={page}');

			$this->data['pagination'] = $pagination->render();
		}

		$this->data['filter_name_blog'] = $filter_name_blog;
		$this->data['filter_description'] = $filter_description;
		$this->data['filter_blog_category_id'] = $filter_blog_category_id;
		$this->data['filter_sub_blog_category'] = $filter_sub_blog_category;

		$this->data['limit'] = $limit;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/search.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/blog/search.tpl';
		} else {
			$this->template = 'default/template/blog/search.tpl';
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