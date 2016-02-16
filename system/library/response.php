<?php
class Response {
	private $headers = array();
	private $level = 0;
	private $output;

	public function addHeader($header) {
		$this->headers[] = $header;
	}

	public function redirect($url) {
		header('Location: ' . $url);
		exit;
	}

	public function setCompression($level) {
		$this->level = $level;
	}

	public function setOutput($output) {
		$this->output = $output;
	}

	private function compress($data, $level = 0) {
		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false)) {
			$encoding = 'gzip';
		}

		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'x-gzip') !== false)) {
			$encoding = 'x-gzip';
		}

		if (!isset($encoding)) {
			return $data;
		}

		if (!extension_loaded('zlib') || ini_get('zlib.output_compression')) {
			return $data;
		}

		if (headers_sent()) {
			return $data;
		}

		if (connection_status()) {
			return $data;
		}

		$this->addHeader('Content-Encoding: ' . $encoding);

		return gzencode($data, (int)$level);
	}

	public function output() {
		if ($this->output) {

			//Q: Add width/height tags to all images for Google Page Speed tip:
			//http://code.google.com/speed/page-speed/docs/rendering.html#SpecifyImageDimensions
		//	preg_match_all('/<img[^>]+>/i', $this->output, $result);
//
		//	$img = array();
		//	foreach($result[0] as $img_tag) {
		//	preg_match_all('/(width|height|src)=("[^"]*")/i',$img_tag, $img[$img_tag]);
		//	}
//
		//	foreach ($img as $k => $info) {
		//	if (count($info) == 3 && $info[1][0] == 'src') {
		//	//if (curl_init(str_replace('"', '', $info[2][0]))) {
		//	$imgfile = str_replace('"', '', $info[2][0]);
		//	$imgfile = str_replace(HTTP_SERVER, DIR_IMAGE . '../', $imgfile);
		//	$imgfile = str_replace(HTTPS_SERVER, DIR_IMAGE . '../', $imgfile);
		//	if (file_exists($imgfile)) {
		//	$image_info = getImageSize(str_replace('"', '', $imgfile));
		//	$k = trim($k, '/>');
		//	$k = trim($k, '>');
		//	$this->output = str_replace($k, ($k . ' ' . $image_info[3]), $this->output);
		//	}
		//	}
		//	}
			//

			if ($this->level) {
				$output = $this->compress($this->output, $this->level);
			} else {
				$output = $this->output;
			}

			if (!headers_sent()) {
				foreach ($this->headers as $header) {
					header($header, true);
				}
			}

			echo $output;
		}
	}
}
?>