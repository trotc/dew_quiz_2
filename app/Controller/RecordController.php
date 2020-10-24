<?php
	class RecordController extends AppController{
		
		public function index(){
			ini_set('memory_limit','256M');
			set_time_limit(0);
			
			$this->setFlash('Listing Record page too slow, try to optimize it.');
			$this->Record->recursive = -1;
			$records = $this->Record->find('all');
			
			$this->set('records',$records);
			
			
			$this->set('title',__('List Record'));
		}

		public function get() {
			//$this->loadModel('Record');
			$this->autoRender = false;    
			$this->Record->recursive = -1;
			$records = $this->Record->find('all');
			// echo '<pre>';
			// print_r($records);
			// echo '</pre>';

			foreach($records as $record) {
				$array[] = [$record['Record']['id'], $record['Record']['name']];
			}

			//print_r($array);
			//echo json_encode(['draw' => 1, 'recordsTotal' => count($records), 'recordsFiltered' => count($records), 'data' => $array]);
			// "draw": 1,
			// "recordsTotal": 57,
			// "recordsFiltered": 57,

		}

		public function trial_get() {
			$this->autoRender = false;  
			$records = [
				['1','Test'],
				['2','Trial2']
			];
			echo json_encode(['draw' => 1, 'recordsTotal' => count($records), 'recordsFiltered' => count($records), 'data' => $records]);
		}
		
		
// 		public function update(){
// 			ini_set('memory_limit','256M');
			
// 			$records = array();
// 			for($i=1; $i<= 1000; $i++){
// 				$record = array(
// 					'Record'=>array(
// 						'name'=>"Record $i"
// 					)			
// 				);
				
// 				for($j=1;$j<=rand(4,8);$j++){
// 					@$record['RecordItem'][] = array(
// 						'name'=>"Record Item $j"		
// 					);
// 				}
				
// 				$this->Record->saveAssociated($record);
// 			}
			
			
			
// 		}
	}