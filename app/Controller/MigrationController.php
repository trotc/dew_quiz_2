<?php

	App::uses('SimpleXLSX', 'Lib');

	class MigrationController extends AppController{
		



		public function index() {
			ini_set('error_reporting', E_ALL);
			ini_set('display_errors', true);

			$this->loadModel('Member');
			$this->loadModel('Transaction');
			$this->loadModel('TransactionItem');
			$all_member = $this->Member->find('all');
			$member_key_array = [];
			foreach($all_member as $all_member_row) {
				$member_key_array[$all_member_row['Member']['name']] = $all_member_row['Member']['id'];
			}

			if ($this->request->is('post')) {
				$target_dir = "uploads/";
				$target_file = $target_dir . basename($_FILES["upload_input"]["name"]);
				$upload_ok = 1;
				$file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
	
				if($file_type != "xlsx") {
				  $this->set('error','Error : Wrong file format');
				  $upload_ok = 0;
				}
	
					
				// Check if $uploadOk is set to 0 by an error
				if ($upload_ok == 0) {
				  echo "Sorry, your file was not uploaded.";
				} else {
				  if (move_uploaded_file($_FILES["upload_input"]["tmp_name"], $target_file)) {				
					if (($handle = fopen($target_file, "r")) !== FALSE) {
						if ( $xlsx = SimpleXLSX::parse($target_file) ) {
							$rows = ( $xlsx->rows() );
							$count = 0;
							foreach($rows as $row) {
								if($count == 0) {
									$count++;
									continue;
								}
								$member_array = [
									'type' => substr($row[3],0,4), 
									'no' => substr($row[3],4),
									'name' => $row[2],
									'created' =>  date('Y-m-d H:i:s'),
									'modified' => date('Y-m-d H:i:s'),
									'valid' => 1
								];

								$this->Member->clear();
								$this->Member->save($member_array);
								$member_id = $this->Member->getLastInsertId();

								$transaction_array = [
									'member_id' => $member_id,
									'member_name' => $row[2],
									'member_paytype' => $row[4],
									'date' => date("Y-m-d",strtotime($row[0])),
									'year' => date("Y",strtotime($row[0])),
									'month' => date("j",strtotime($row[0])),
									'ref_no' => $row[1],
									'receipt_no' => $row[3],
									'payment_method' => $row[6],
									'batch_no' => $row[7],
									'cheque_no' => (!empty($row[9])) ? $row[9] : null,
									'payment_type' => $row[10],
									'renewal_year' => $row[11],
									'subtotal' => $row[12],
									'tax' => $row[13],
									'total' => $row[14],
								];

								$this->Transaction->clear();
								$this->Transaction->save($transaction_array);
								$transaction_id = $this->Transaction->getLastInsertId();
								
								$transaction_item_array = [						
									'transaction_id' => $transaction_id,
									'description' => $row[10],
									'quantity' => 1,
									'unit_price' => $row[12],
									'sum' => $row[12],
									'valid ' => 1,
									'created' => date('Y-m-d H:i:s'),
									'modified' => date('Y-m-d H:i:s'),
									'table' => 'Member',
									'table_id' => $member_id
								];
								$this->TransactionItem->clear();
								$this->TransactionItem->save($transaction_item_array);
							}
							$this->set('success_msg','Success: Excel file was succesfully uploaded');
						} else {
							$this->set('error_msg','Error: '.SimpleXLSX::parseError());
						}
						}
					fclose($handle);
				  } else {
					echo $_FILES["upload_input"]["error"];
				  }
				}
				
	
			$this->set('file_uploads',$file_uploads);
			 }
		}


		



		public function q1(){
			
			$this->setFlash('Question: Migration of data to multiple DB table');
				
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_instruction(){

			$this->setFlash('Question: Migration of data to multiple DB table');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
	}