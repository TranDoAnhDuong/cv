<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuestBook extends CI_Controller {
	
		public function index() {
		$this->load->model('guestbook/guestbook_model','guestbook_model');
		$data=$this->guestbook_model->getRecord();
		$this->load->view('template/main.php',array('view_name'=>'guestbook/index.php','data'=>$data));
			
		}
	
	public function feedback(){
		$now = new DateTime();
		$now->setTimezone(new DateTimezone('Asia/Ho_Chi_Minh'));
		$data = array(
			'message'=>$this->input->post("message"),
			'name'=>$this->input->post("name"),
			'email'=>$this->input->post("email"),
			'img' => $this->input->post("img"),
			'webaddress'=>$this->input->post("website"),
			'date'=>	$now->format('Y-m-d H:i:s')
		);
		$this->load->model('guestbook/guestbook_model','guestbook_model');
		$this->guestbook_model->insert($data);
		redirect('guestbook/index', 'refresh');
		
	}

	function upload_file() {
		$target_dir = FCPATH ."public/uploads/";
		$image = '';
		$x1 = $this->input->post("x");
		$y1 = $this->input->post("y");
		$w1 = $this->input->post("w");
		$h1 = $this->input->post("h");
		$degrees = $this->input->post("rotate");
		if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] <= 0) {
			$image = $_FILES['fileToUpload']['name'];
			$file_name = $image;
			$ext = pathinfo($image, PATHINFO_EXTENSION);
			$ext = strtolower($ext);
			$file_name = uniqid().'.'.$ext;
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . $file_name);

			$full_path_file = $target_dir.$file_name;
			if($degrees != 0) {
				if($ext == 'png') {
					$source = imagecreatefrompng($full_path_file);
				} else if($ext == 'jpg') {
					$source = imagecreatefromjpeg($full_path_file);
				}

				// Rotate
				$rotate = imagerotate($source, $degrees, 0);
				if($ext == 'png') {
					imagepng($rotate, $full_path_file);
				} else if($ext == 'jpg') {
					imagejpeg($rotate, $full_path_file);
				}
			}

			$image_info = @getimagesize($full_path_file);
			$image_width = $image_info[0];
			$image_height = $image_info[1];

			if($w1 != 0) {
				if($image_height > 352) {
					$ratio = $image_height/352;
					$x2 = $ratio * $x1;
					$y2 = $ratio * $y1;
					$w2 = $ratio * $w1;
					$h2 = $ratio * $h1;
				} else {
					$x2 = $x1;
					$y2 = $y1;
					$w2 = $w1;
					$h2 = $h1;
				}

				if($ext == 'png') {
					$im = imagecreatefrompng($target_dir.$image);
				} else if($ext == 'jpg') {
					$im = imagecreatefromjpeg($target_dir.$image);
				}
				
				$size = min(imagesx($im), imagesy($im));
				$im2 = imagecrop($im, ['x' => $x2, 'y' => $y2, 'width' => $w2, 'height' => $h2]);
				
				if ($im2 !== FALSE) {
					$file_name = uniqid().'.'.$ext;
					imagepng($im2, $target_dir.$file_name);
					imagedestroy($im2);
				}
				imagedestroy($im);
			}

		}

		echo json_encode(array('file_name' => $file_name));
	}
}