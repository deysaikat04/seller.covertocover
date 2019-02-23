<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
      $this->load->library('Ion_auth');
	    if(!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else 
				{
        		$this->load->model('DashboardModel');
        		$found = array();
						$bookData = array();
						$orderCount = 0;				
						$data['user'] = $this->ion_auth->user()->row();
						$user=$this->ion_auth->user()->row();
				
						//check if seller exists
						$getStatus = $this->DashboardModel->checkSellerExixt($user->id);		
				
				
						
						if(!$getStatus)
						{
								$userData = array(
									'ionid' => $user->id,
									'name' => $user->first_name." ".$user->last_name,
									'email' => $user->email,
									'password' => $user->password,
									'phone' => $user->phone,
									'status' => "1",
									'toc' => date('Y-m-d H:i:s')
								);
							$lastInsertedId = $this->DashboardModel->addSeller($userData);
							if($lastInsertedId){
								$data['page'] = 'partial/SellerRegister';
            		$this->load->view('common/FormPage', $data);
							}
						}
						else{
								$sellerId = $this->DashboardModel->getSellerStatus($user->id); 				

								$orderSummary = $this->DashboardModel->getOrderSummary();
								$getSellerBookId = $this->DashboardModel->getSellerFromBookId($sellerId[0]['id']);

								for($i = 0; $i < count($orderSummary); $i++)
								{
									for($j= 0; $j < count($getSellerBookId); $j++)
									{
											if($getSellerBookId[$j]['bookid'] == $orderSummary[$i]['bookid'])
											{
													$orderCount++;
													break;
											} 
									}
								}
						
								$count =array(
										'allAlbum' => count($getSellerBookId),
										'allImages' => count($orderSummary),
										'allVideo' => $orderCount
								);
								$data['countAll'] = $count;	
								$data['page'] = 'partial/Stats';
								$this->load->view('common/Dashboard', $data);	
						}
            
        }
	}
}
