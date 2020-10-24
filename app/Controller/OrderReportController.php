<?php
	class OrderReportController extends AppController{

		public function index(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));
			// debug($orders);exit;

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
			// debug($portions);exit;


			// To Do - write your own array in this format
			$order_reports = array('Order 1' => array(
										'Ingredient A' => 1,
										'Ingredient B' => 12,
										'Ingredient C' => 3,
										'Ingredient G' => 5,
										'Ingredient H' => 24,
										'Ingredient J' => 22,
										'Ingredient F' => 9,
									),
								  'Order 2' => array(
								  		'Ingredient A' => 13,
								  		'Ingredient B' => 2,
								  		'Ingredient G' => 14,
								  		'Ingredient I' => 2,
								  		'Ingredient D' => 6,
								  	),
								);

			// ...
			$dishes_menu = [
				'seafood_fried_rice' => ['ingredient_a' => 1, 'ingredient_b' => 2],
				'fried_rice_with_silver_fish' => ['ingredient_a' => 1],
				'vegetarian_fried_rice'	=> ['ingredient_c' => 3, 'ingredient_f' => 5],
				'sing_chew_fried_bee_hoon' => ['ingredient_a' => 6, 'ingredient_f' => 7, 'ingredient_h' => 1],
				'fragrant_chicken' => ['ingredient_g' => 12, 'ingredient_i' => 11],
				'lemon_chicken' => ['ingredient_d' => 2],
				'crispy_chicken_wings' => ['ingredient_e' => 3],
				'bbq_chicken_wings' => ['ingredient_b' => 5],
				'rendang_chicken' => ['ingredient_c' => 6],
				'japanese_teriyaki_chicken' => ['ingredient_e' => 12, 'ingredient_j' => 1],
				'sambal_egg' => ['ingredient_e' => 2, 'ingredient_g' => 15, 'ingredient_h' => 12],
				'rendang_mutton' => ['ingredient_b' => 3, 'ingredient_e' => 5],
				'sambal_seafood_mee_goreng' => ['ingredient_g' => 2],
				'deep_fried_fish_tofu' => ['ingredient_a' => 7],
				'chicken_satay' => ['ingredient_h' => 8],
				'cuttlefish_balls' => ['ingredient_b' => 4, 'ingredient_e' => 9],
				'fried_fish_balls' => ['ingredient_g' => 10, 'ingredient_i' => 16],
				'pandan_cake' => ['ingredient_i' => 1],
				'mango_pudding' => ['ingredient_j' => 3],
				'chicken_nuggests' => ['ingredient_h' => 5]
			];

			$orders = [
				'order_1' => ['seafood_fried_rice' => 1, 'vegetarian_fried_rice' => 1, 'fragrant_chicken' => 2, 'crispy_chicken_wings' => 3, 'bbq_chicken_wings' => 2],
				'order_2' => ['fried_rice_with_silver_fish' => 1, 'sing_chew_fried_bee_hoon' => 2, 'lemon_chicken' => 3],
				'order_3' => ['vegetarian_fried_rice' => 1, 'lemon_chicken' => 1, 'rendang_chicken' => 1, 'rendang_mutton' => 3],
				'order_4' => ['sing_chew_fried_bee_hoon' => 1, 'bbq_chicken_wings' => 3, 'rendang_mutton' => 5, 'cuttlefish_balls' => 6, 'pandan_cake' => 2, 'chicken_nuggests' => 4],
				'order_5' => ['fried_rice_with_silver_fish' => 1, 'vegetarian_fried_rice' => 2, 'sing_chew_fried_bee_hoon' => 3],
				'order_6' => ['crispy_chicken_wings' => 1, 'bbq_chicken_wings' => 3],
				'order_7' => ['seafood_fried_rice' => 1, 'fragrant_chicken' => 1, 'bbq_chicken_wings' => 1, 'deep_fried_fish_tofu' => 4, 'cuttlefish_balls' => 5],
				'order_8' => ['sambal_seafood_mee_goreng' => 1, 'chicken_satay' => 3, 'cuttlefish_balls' => 4, 'fried_fish_balls' => 5],
				'order_9' => ['japanese_teriyaki_chicken' => 1, 'sambal_egg' => 1, 'chicken_satay' => 1, 'cuttlefish_balls' => 2, 'pandan_cake' => 2, 'chicken_nuggests' => 3],
				'order_10' => ['crispy_chicken_wings' => 1, 'japanese_teriyaki_chicken' => 2]
			];

			
			foreach($orders as $order_name => $order) {
				foreach($order as $dishes => $quantity_dish) {
					for($i = 0; $i < $quantity_dish; $i++) {
						$ingredients_array = $dishes_menu[$dishes]; //this is an array
						//$order_reports_answer[] = $ingredients_array;
							foreach($ingredients_array as $ingredient_key => $quantity) {
								if(!isset($order_reports_answer[$order_name][$ingredient_key] )) {
								$order_reports_answer[$order_name][$ingredient_key] = $quantity;
								}
								else {
								$order_reports_answer[$order_name][$ingredient_key] += $quantity;
								}
							}
						}
					}
			}

			$this->set('order_reports',$order_reports_answer);

			$this->set('title',__('Orders Report'));
		}

		public function Question(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));

			// debug($orders);exit;

			$this->set('orders',$orders);

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
				
			// debug($portions);exit;

			$this->set('portions',$portions);

			$this->set('title',__('Question - Orders Report'));
		}

	}