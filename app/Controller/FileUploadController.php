<?php

class FileUploadController extends AppController {
	public function index() {


		$this->set('title', __('File Upload Answer'));
		$file_uploads = $this->FileUpload->find('all');

		ini_set('auto_detect_line_endings', TRUE);

		if ($this->request->is('post')) {
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["upload_input"]["name"]);
			$upload_ok = 1;
			$file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	

			if($file_type != "csv") {
			  $this->set('error','Error : Wrong file format');
			  $upload_ok = 0;
			}

				
			// Check if $uploadOk is set to 0 by an error
			if ($upload_ok == 0) {
			  echo "Sorry, your file was not uploaded.";
			} else {
			  if (move_uploaded_file($_FILES["upload_input"]["tmp_name"], $target_file)) {				
				if (($handle = fopen($target_file, "r")) !== FALSE) {

					$row = 0;
					$csv_keys = ['name','email'];
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						if($row == 0) {
							$row++;
							continue;
						}
						$num = count($data);
						$row++;
						for ($c=0; $c < $num; $c++) {
							$file_uploads[$row]['FileUpload'][$csv_keys[$c]] = $data[$c];
						}
						$file_uploads[$row]['FileUpload']['id'] = $row;
						$file_uploads[$row]['FileUpload']['created'] = date('Y-m-d');
					}
				fclose($handle);
			  } else {
				echo $_FILES["upload_input"]["error"];
			  }
			}
			

		$this->set('file_uploads',$file_uploads);
		 }
	}
}
}
?>
