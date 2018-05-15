<?php

class ImageModel extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->library('image_lib');
	}
	protected $mime_types = array(
	
			'txt' => 'text/plain',
			'htm' => 'text/html',
			'html' => 'text/html',
			'php' => 'text/html',
			'css' => 'text/css',
			'js' => 'application/javascript',
			'json' => 'application/json',
			'xml' => 'application/xml',
			'swf' => 'application/x-shockwave-flash',
			'flv' => 'video/x-flv',
	
			// images
			'png' => 'image/png',
			'jpe' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'jpg' => 'image/jpeg',
			'gif' => 'image/gif',
			'bmp' => 'image/bmp',
			'ico' => 'image/vnd.microsoft.icon',
			'tiff' => 'image/tiff',
			'tif' => 'image/tiff',
			'svg' => 'image/svg+xml',
			'svgz' => 'image/svg+xml',
	
			// archives
			'zip' => 'application/zip',
			'rar' => 'application/x-rar-compressed',
			'exe' => 'application/x-msdownload',
			'msi' => 'application/x-msdownload',
			'cab' => 'application/vnd.ms-cab-compressed',
	
			// audio/video
			'mp3' => 'audio/mpeg',
			'qt' => 'video/quicktime',
			'mov' => 'video/quicktime',
	
			// adobe
			'pdf' => 'application/pdf',
			'psd' => 'image/vnd.adobe.photoshop',
			'ai' => 'application/postscript',
			'eps' => 'application/postscript',
			'ps' => 'application/postscript',
	
			// ms office
			'doc' => 'application/msword',
			'rtf' => 'application/rtf',
			'xls' => 'application/vnd.ms-excel',
			'ppt' => 'application/vnd.ms-powerpoint',
			'docx' => 'application/msword',
			'xlsx' => 'application/vnd.ms-excel',
			'pptx' => 'application/vnd.ms-powerpoint',
	
	
			// open office
			'odt' => 'application/vnd.oasis.opendocument.text',
			'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
	);
	
	public function getMimeTypeFromExtension($extension){
		return $this->mimeTypes[$extension];
	}
	
	public function uploadImageWithThumbnails($field_name){
		$imagen = null;
		
		$hash = md5(microtime(true) . 'filename');
		$savePath = substr($hash, 0, 1) . '/' . substr($hash, 1, 1) . '/';
		$full_path = IMG_PATH.$savePath;
		
		if(!file_exists($full_path)) mkdir($full_path, 0770, true);
		
		$config = array(
				'upload_path' => $full_path,
				'allowed_types' => 'gif|jpg|png|jpeg',
				'file_name' => $hash
		);
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($field_name)) {
// 			echo 'Errors: ' . $this->image_lib->display_errors();
		}
			
		else {
				
			$upload_data = $this->upload->data();

			$absolute_path = $upload_data['full_path'];
			$extension = $upload_data['file_ext'];
			$image_height = $upload_data['image_height'];
			$image_width = $upload_data['image_width'];
			$absolute_path = str_replace($extension, '', $absolute_path);
			rename($upload_data['full_path'], $absolute_path);
			
			//crop
			$length = 200;
			if($image_height > $image_width){
				$length = $image_width;
			} else{
				$length = $image_height;
			}
			
			$config = array(
					'image_library' => 'gd2',
					'source_image' => $absolute_path,
					'maintain_ratio' => false,
					'width' => $length,
					'height' => $length
			);
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->crop();
				
			//thumbnails
				
			$full_thumbs_path = THUMBS_PATH.$savePath;
			$absolute_thumbs_path = str_replace('/uploads', '/uploads/thumbnails', $absolute_path);
			
			if(!file_exists($full_thumbs_path)) mkdir($full_thumbs_path, 0770, true);
			
			$config = array(
					'image_library' => 'gd',
					'source_image' => $absolute_path,
					'new_image' => $full_thumbs_path,//'./uploads/',
					'maintain_ratio' => false,
					'width' => 113,
					'height' => 113
			);
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
				
			rename($absolute_thumbs_path, $absolute_thumbs_path . '_xs');
				
			// thumbnail (m)
			$config = array(
					'image_library' => 'gd',
					'source_image' => $absolute_path,
					'new_image' => $full_thumbs_path,//'./uploads/',
					'maintain_ratio' => false,
					'width' => 200,
					'height' => 200
			);
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
		
			rename($absolute_thumbs_path, $absolute_thumbs_path . '_m');
		
			$file_name = $upload_data['file_name'];
			$mime_type = $upload_data['file_type'];
			$size = floatval($upload_data['file_size']) * 1024;
			$type = 'public';
			$imagen = $this->insertIntoFilebank($file_name, $mime_type, $size, $type, $savePath . $hash);
		}
		return $imagen;
	}
	
	private function insertIntoFilebank($file_name, $mime_type, $size, $type, $savepath){
		$sql = 'INSERT INTO filebank
				(name, size, mimetype, isactive, savepath, type, encrypted )
				values (?, ?, ?, 1, ?, ?, 0)';
		$this->db->query ( $sql, array($file_name, $size, $mime_type, $savepath, $type));
	
		return $this->db->insert_id();
	}
	
}