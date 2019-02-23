<?php
/**
 * Created by PhpStorm.
 * User: Saikat Dey
 * Date: 30-10-2017
 * Time: 11:52 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('DashboardModel');
    }
		
    public function page($page = 'Stats')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else {
					
					$user=$this->ion_auth->user()->row();
					$sellerId = $this->DashboardModel->getSellerStatus($user->id); 
					
					$sellerSessionData = array(
						'id' => $sellerId[0]['id'],
						'name' => $user->first_name." ".$user->last_name,
						'email' => $user->email
					);
					$this->session->set_userdata($sellerSessionData);
					
					
					
            if (!file_exists(APPPATH . 'views/partial/' . $page . '.php')) {
                show_404();
            }
            if ($page === 'Order') 
            {
                $found = array();
                $discount = array();
                $order = array();
                $bookData = array();
                $orderSummary = $this->DashboardModel->getOrderSummary();
                $getSellerBookId = $this->DashboardModel->getSellerFromBookId($this->session->userdata('id'));
                
                for($i = 0; $i < count($orderSummary); $i++)
                {
                    for($j= 0; $j < count($getSellerBookId); $j++)
                    {
                        if($getSellerBookId[$j]['bookid'] == $orderSummary[$i]['bookid'])
                        {
                            $found[] = $orderSummary[$i]['bookid'];
                            $discount[] = $getSellerBookId[$j]['discount'];
                            $order[] = $orderSummary[$i];
                            break;
                        }   

                    }
                }
                for($i = 0; $i < count($found); $i++)
                {
                    $getBookFromOrder[] = $this->DashboardModel->getBookFromOrder($found[$i]);
                    $bookData[] = array(
                        'id' => $getBookFromOrder[$i][0]['id'],
                        'bookname' => $getBookFromOrder[$i][0]['name'],
                        'rating' => $getBookFromOrder[$i][0]['rating'],
                        'price' => $order[$i]['price'],
                        'qty' => $order[$i]['qty'],
                        'customerid' => $order[$i]['customerid'],
                        'toc' => $order[$i]['toc']
                    );
                }
                
                $data['bookDetails'] = $bookData;
                

            } elseif ($page === 'Videos'){
                $data['videos'] = $this->DashboardModel->getVideos();
            } elseif ($page === 'ViewAlbum'){
                $data['allAlbum']=$this->DashboardModel->getallAlbum();
            } elseif ($page === 'BooksTable'){														
                // get data of book id from seller id
                $allBookId = $this->DashboardModel->getBookIdBySeller($this->session->userdata('id'));
                if($allBookId){
						for($i = 0; $i < count($allBookId); $i++){
							// getting edition id by book id
							$editionId[] = $this->DashboardModel->getEditionIdByBook($allBookId[$i]['bookid']);						
							$edId[$i] = $editionId[$i][0]['editionid'];

							// getting authorid, publisherid BY editionid
							$authorPublisherId[] = $this->DashboardModel->geAuthPubIdByEdition($editionId[$i][0]['editionid']);					

							// get book data
							$bookData[] = $this->DashboardModel->getBookData($allBookId[$i]['bookid']);	

							// get edition name
							$editionData[] = $this->DashboardModel->getEditionData($editionId[$i][0]['editionid']);	

							// get edition name
							$authorData[] = $this->DashboardModel->getAuthorData($authorPublisherId[$i][0]['authorid']);

							// get publisher name
							$publisherData[] = $this->DashboardModel->getPublisherData($authorPublisherId[$i][0]['pid']);

							// price
							$price = round( $bookData[$i][0]['mrp'] - ( $bookData[$i][0]['mrp'] * ( $allBookId[$i]['discount'] / 100 ) ) );

							$bookDetails[] = array(
								'bookid' => $allBookId[$i]['bookid'],
								'bookname' => $bookData[$i][0]['name'],
								'description' => $bookData[$i][0]['description'],
								'mrp' => $bookData[$i][0]['mrp'],
								'category' => $bookData[$i][0]['category'],
								'rating' => $bookData[$i][0]['rating'],
								'status' => $bookData[$i][0]['status'],

								'sellerid' => $allBookId[$i]['sellerid'],
								'discount' => $allBookId[$i]['discount'],

								'editionid' => $editionId[$i][0]['editionid'],
								'editionname' => $editionData[$i][0]['ename'],
								'pages' => $editionData[$i][0]['pages'],

								'authorid' => $authorPublisherId[$i][0]['authorid'],
								'authorname' => $authorData[$i][0]['name'],

								'publisherid' => $authorPublisherId[$i][0]['pid'],
								'publishername' => $publisherData[$i][0]['pname'],

								'price' => $price

							);
						}// end of for
					$data['bookDetails'] = $bookDetails;	
				} // end of if
				else{
					redirect(base_url());
				}
						
			/*echo "<pre>";
			print_r($data['bookDetails']);
			exit;*/
            } 
					
            $data['page'] = 'partial/' . $page;
            $this->load->view('common/Dashboard', $data);
        }
    }

    public function EditFilm($id = null)
    {
        if($id == null) {
            show_404();
        }
        $data['video'] = $this->DashboardModel->getVideo($id);
        if ($data['video']) {
            $data['page'] = 'partial/EditFilm';
            $this->load->view('common/Dashboard', $data);
        } else {
            show_404();
        }

    }
    public function EditBook($id = null)
    {
        if($id == null) {
            show_404();
        }
				$sellerid =  $this->uri->segment('4'); 
        $data['album'] = $this->DashboardModel->getAlbumDetailsbyId($id);
        //$data['stock'] = $this->DashboardModel->getbookCountId($sellerid );
       
        $data['coverImage'] = $this->DashboardModel->getAlbumCoverImagesbyId($id);
        $data['count'] = $this->DashboardModel->imagecount($id);
        $data['albumImage'] = $this->DashboardModel->getAlbumImagesbyId($id);

				//$data['noOfBooks'] =  $data['stock'][0]['c'];
				$data['noOfBooks'] =  "0";
        /*echo "<pre>";
 print_r($data['stock'][0]['count']); exit;*/


        if ($data['album']) {
            $data['page'] = 'partial/EditBook';
            $this->load->view('common/Dashboard', $data);
        } else {
            show_404();
        }

    }
    public function updateBookDetail($id , $sellerid){ 
        $this->load->model('DashboardModel');
        $this->form_validation->set_rules('bookName', 'Enter Title Here', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('author', 'Enter Author name Here', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('price', 'Enter Price Here', 'required');
        $this->form_validation->set_rules('pages', 'Pages', 'required');
        $this->form_validation->set_rules('publisher', 'Publisher', 'required');
       
        $toc = $this->input->post('toc');
				$sellerId = $this->input->post('sellerId');
        $status = 0;

        $albumFormData = array(
            'id' =>  $id,
            'name' => $this->input->post('bookName'),
            'category' => $this->input->post('category'),
            'author' => $this->input->post('author'),
            'description' => $this->input->post('desc'),
            'price' => $this->input->post('price'),
            'pages' => $this->input->post('pages'),
            'publisher' => $this->input->post('publisher'),
            'status' => $status,
            'toc' => $toc,
            'tou' => date('Y-m-d H:i:s')
        );

        /*echo "<pre>";
        print_r($albumFormData); exit;*/

        if ($this->form_validation->run() == FALSE) {
            $valERR = validation_errors();
            $this->session->set_flashdata('updateAlbumErr', $valERR);
            header("Location: " . base_url('Dashboard/EditBook/'.$albumFormData['id'].'/'.$sellerid));
        } else {
            $isUploaded = $this->DashboardModel->updateBook($albumFormData);
            if ($isUploaded) {
                $this->session->set_flashdata('updateAlbumSucc', "Record has been Updated.");
                header("Location: " . base_url('Dashboard/EditBook/'.$albumFormData['id'].'/'.$sellerid));
            } else {
                $this->session->set_flashdata('updateAlbumErr', "We couldn't update the record.");
                header("Location: " . base_url('Dashboard/EditBook/'.$albumFormData['id'].'/'.$sellerid));
            }
        }
    }

    public function remove($pr_id)
    {
        //$data['page'] = 'partial/'.$id;
        //$this->load->view('common/Dashboard', $data);
        $data['product_data'] = $this->DashboardModel->remove($pr_id);
        if(!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $data['page'] = 'partial/RemoveBook';
            $this->load->view('common/Dashboard', $data);
        }
    }

    public function removeStatus($pr_id,$status)
    {
        $data = array(
        'table_name' => 'products', // the table name
        'id' => $pr_id,
        'status' => $status
        );
        $this->load->model('DashboardModel');
        //$data['page'] = 'partial/'.$id;
        //$this->load->view('common/Dashboard', $data);
        if( $this->DashboardModel->removeStat($data,$pr_id,$status)){
        $data['page'] = 'partial/editContacts';
        redirect(base_url().'Dashboard/page/BooksTable');
        }
        else{
           $data['page'] = 'partial/editContacts';
            redirect(base_url().'Dashboard/page/BooksTable');
        }
    }
    public function CustomerData($encid = 0)
    {
        if($encid)
        {
            $salt="BOOK_SELLER";
            $decrypted_id_raw = base64_decode($encid);
            $cus = array();
            $id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
            if($id)
            {
                $data['customerData'] = $this->DashboardModel->customerData($id);
               /* echo "<pre>";
                print_r($data['customerData']);
                exit;*/
            }
            $data['page'] = 'partial/CustomerDetails';
            $this->load->view('common/Dashboard', $data);
        }else{
            redirect(base_url().'Dashboard/page/Order');    
        }
        
    }
}