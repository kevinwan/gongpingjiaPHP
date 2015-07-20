<?php
/**
 * 估值报告控制器
 *
 * @author abiao 2015-7-16
 */
class Sell_IndexController extends XF_Controller_Abstract
{
	public function __construct()
	{
		parent::__construct ( $this );
		$this->_view->setResourcePath ( $this->static_url );
	}
	
	public function indexAction()
	{
	}
	
	// 上传图片
	public function uploadAction()
	{
		$this->setLayout (new Layout_Default());
		$this->_view->headStylesheet ('/css/sell/upload.css');
		$this->_view->headStylesheet ('/css/common.css');
		$this->_view->headScript ('/js/plupload/plupload.full.min.js')->appendFile ( '/js/pagejs/upload.js' );
	}
	
	public function uploadfileAction() {
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
			
		@set_time_limit(5 * 60);
			
		// usleep(5000);
			
		$targetDir = "D:/xampp/htdocs/pahaoche/gongpingjiaPHP/static/uploads/car";
			
		//$targetDir = 'uploads';
		$cleanupTargetDir = true;
		$maxFileAge = 5 * 3600;
			
		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}
			
		if (isset($_REQUEST["name"])) {
			$fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
			$fileName = $_FILES["file"]["name"];
		} else {
			$fileName = uniqid("file_");
		}
			
		$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
			
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
		
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}
				
			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
					
				if ($tmpfilePath == "{$filePath}.part") {
					continue;
				}
					
				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}
			
		if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}
			
		if (!empty($_FILES)) {
			if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}
				
			if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}
			
		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}
			
		@fclose($out);
		@fclose($in);
			
		if (!$chunks || $chunk == $chunks - 1) {
			rename("{$filePath}.part", $filePath);
		}
			
		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
	}
	
}

