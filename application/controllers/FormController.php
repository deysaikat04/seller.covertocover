<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormController extends CI_Controller
{
		
		public function __construct()
		{
			parent::__construct();
					// load Session Library
					$this->load->library('session');
					$this->load->model('DashboardModel');
					$this->load->library("pagination");
					// setting the date time format
					date_default_timezone_set('Asia/Kolkata');
		}
	
	
    public function addPortfolioImage()
    {
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $valERR = validation_errors();
            $this->session->set_flashdata('portfolioDataInsertFailed', $valERR);
            header("Location: " . base_url('Dashboard/page/Portfolio'));
        }
        $category = $this->input->post('category');
        if (!empty($_FILES['portfolioImage']['name'])) {
            $imageData = $this->uploadMultipleImages($_FILES);
            $portfolioData = $this->getPortfolioData($imageData, $category);
            $this->load->model('DashboardModel');
            $isUploaded = $this->DashboardModel->insertMultipleImages($portfolioData);
            if ($isUploaded == 1) {
                $this->session->set_flashdata('portfolioDataInsertSuccess', "Well that was easy!");
                header("Location: " . base_url('Dashboard/page/Portfolio'));
            } else {
                $this->session->set_flashdata('portfolioDataInsertFailed', "Looks like something is broken!");
                header("Location: " . base_url('Dashboard/page/Portfolio'));
            }
        } else {
            $this->session->set_flashdata('imageNotFound', "Please, select an image to upload.");
            header("Location: " . base_url('Dashboard/page/Portfolio'));
        }
    }

    public function addBook()
    {
        
        $this->form_validation->set_rules('bookName', 'Name of the Book', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('authorName', 'Author Name', 'trim|min_length[4]');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('price', 'Book Price', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('qty', 'No of Books', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('desc', 'Description', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('publisher', 'Publisher', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('page', 'Page', 'trim|required|min_length[1]');
        
				$this->form_validation->set_rules('discount', 'Discount', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('edition', 'Edition', 'trim|required|min_length[1]');

        $status = 1;
        $qty = $this->input->post('qty');
				$sellerId = $this->input->post('sellerId');			
				$authorName = $this->input->post('authorName');
		
				// data for *** BOOKS *** table
        $albumFormData = array(
            'name' => $this->input->post('bookName'),            
            'category' => $this->input->post('category'),
            'description' => $this->input->post('desc'),											
            'mrp' => $this->input->post('price'),            
            'status' => $status,
			'rating' => "3.0",            			
            'toc' => date('Y-m-d H:i:s'),
            'tou' => date('Y-m-d H:i:s')
        );
				//$maxTableId = $this->DashboardModel->getLastProductID(); 			
			
				// data for *** BOOKEDITION *** table
        $editionData = array(
            'ename' => $this->input->post('edition'),
            'pages' => $this->input->post('page'),			
            'toc' => date('Y-m-d H:i:s')
        );	
			
				
			
        if ($this->form_validation->run() == FALSE) {
            $valERR = validation_errors();
            $this->session->set_flashdata('addFromValErr', $valERR);
            redirect(base_url() . 'Dashboard/page/AddAlbum');
        } 
				else 
				{	//  1
            if (!empty($_FILES['portfolioImage']['name'])) 
						{ // 2
							
							// Insert form data in BOOKS table
							$lastInsertedId = $this->DashboardModel->addBook($albumFormData, $qty);
							
							if ($lastInsertedId)// if last inserted ID exist3
							{ 
										// data for *** DISCOUNT *** table
										// data for *** bookstoedition *** table
										for($i = 0; $i < $qty; $i++)	
										{
												$discountData[] = array(
														'sellerid' => $sellerId,	
														'bookid' => $lastInsertedId[$i],	
														'discount' => $this->input->post('discount')												
												);
										}
										// Insert form data in discount table
										$lastDiscountId = $this->DashboardModel->addDiscount($discountData);
								
								
								
										//get topten by name
										$toptenBookExist = $this->DashboardModel->toptenBookExist($this->input->post('bookName'));
										$toptenBookCount = $this->DashboardModel->toptenBookCount();
										$toptenData = array(
																'bookname' => $this->input->post('bookName'),	
																'discountid' => $lastDiscountId[0],	
																'toc' => date('Y-m-d H:i:s')												
														);
										if($toptenBookCount <= 10){						

											if(!$toptenBookExist){ // add book																				
												$toptenBookId = $this->DashboardModel->toptenBookAdd($toptenData);								
											}									
										} else {
											// delete top one
											$deleteId = $this->DashboardModel->toptenBookDelete();
											if($deleteId){
												$toptenBookId = $this->DashboardModel->toptenBookAdd($toptenData);			
											}									
										}
														
								
								
								
										// Insert form data in bookedition table
										$lasteditionId = $this->DashboardModel->addEdition($editionData);
								
										// data for *** bookstoedition *** table
										for($i = 0; $i < $qty; $i++)	
										{
											$books2editionData[] = array(
													'editionid' => $lasteditionId,
													'bookid' => $lastInsertedId[$i],			
													'toc' => date('Y-m-d H:i:s')
											);			
											
											
										}
										// Insert form data in bookstoedition table
										$lastBooksToEditionId = $this->DashboardModel->addBooksToEdition($books2editionData);
										
										for($i = 0; $i < count($authorName); $i++)	
										{
											//check if author exist
											$authorExist = $this->DashboardModel->checkAuthor($authorName[$i]);

											if(!$authorExist){
												// data for *** author *** table
												$authorData[] = array(
														'name' => $authorName[$i],
														'status' => "1",
														'toc' => date('Y-m-d H:i:s')
												);	
												// Insert form data in author table
												$lastAuthorId[$i][0]['id'] = $this->DashboardModel->addAuthor($authorData[$i]);												
											} else{
												$lastAuthorId[] = $authorExist;
											}		
										}
								
								
										//check if publisher exist
										$publisherExist = $this->DashboardModel->checkPublisher($this->input->post('publisher'));
								
										if(!$publisherExist){
											// data for *** author *** table
											$publisherData = array(
													'pname' => $this->input->post('publisher'),	
													'toc' => date('Y-m-d H:i:s')
											);	
											// Insert form data in author table
											$lastPubId[0]['id'] = $this->DashboardModel->addPublisher($publisherData);
										} else{
											$lastPubId = $publisherExist;
										}
																
										for($i = 0; $i < count($lastAuthorId); $i++)	{
												if(!empty($lastAuthorId) && !empty($lastPubId) && !empty($lasteditionId)){
													$edToAuthToPubData = array(
															'editionid' => $lasteditionId,
															'authorid' => $lastAuthorId[$i][0]['id'],
															'pid' => $lastPubId[0]['id'],	
															'toc' => date('Y-m-d H:i:s')
													);	

				
													// Insert form data in author table
													$lastId = $this->DashboardModel->addEdToAuthToPub($edToAuthToPubData);

												}
										}
								
											$this->session->set_flashdata('addFromSucc', 'Data Added Successfully.');
											if (!empty($_FILES['coverImage']['name'])) 
											{ // second time checking if exists or not //  4
												
												for($i = 0; $i < $qty; $i++)	
												{	
													$path = 'assets/images/album/' . $lastInsertedId[$i] . '/';
													
													$dir_exist = true; // flag for checking the directory exist or not
													if (!is_dir($path)) {
															mkdir($path, 0777, true);
															$dir_exist = false; // dir not exist
													}
													$config['upload_path'] = $path;
													$config['allowed_types'] = 'jpg|png';
													$config['max_size'] = '500';
													$config['encrypt_name'] = true;
													$this->load->library('upload', $config);
													$this->upload->initialize($config);

													if (!$this->upload->do_upload('coverImage', FALSE)) 
													{
															$leadImgUldErr = $this->upload->display_errors();
															$this->session->set_flashdata('errUploadCoverImg', $leadImgUldErr);
													} 
													else 
													{ // Upload successful
															$leadUpload_data = $this->upload->data();
															
														
															$path = 'assets/images/album/' . $lastInsertedId[$i] . '/';
															$image_path = $path . $leadUpload_data['raw_name'] . $leadUpload_data['file_ext'];
															
														
															$leadImgData = array(
																	"bookid" => $lastInsertedId[$i],
																	"file_name" => $leadUpload_data['file_name'],
																	"is_cover" => 1,
																	"path" => $image_path,
																	"tou" => date('Y-m-d H:i:s'),
																	"toc" => date('Y-m-d H:i:s')
															);
														}
//echo "<pre>";
//print_r($leadImgData); 
															// uploading cover image
															$leadImgInsertd = $this->DashboardModel->insertCoverImage($leadImgData);
	
//echo  "leadImgInsertd = ".$leadImgInsertd."<br>";														
			
															if (!$leadImgInsertd) {
																	$this->session->set_flashdata('errInsertCoverImg', 'Encountered an Error While Saving Image.');
																	$data['page'] = 'partial/AddAlbum';
																	//redirect(base_url() . 'Dashboard/page/AddAlbum');
															}
															if (!empty($_FILES['portfolioImage']['name'])) 
															{ // If other images exists
																	$c =0;																	
																	$dataInfo = array();
																	
																	if($i == 0){
																		$cpt = count($_FILES['portfolioImage']['name']);
																		$this->session->set_userdata('cpt',$cpt);
																		$files = $_FILES;
																		$this->session->set_userdata('file',$files);
																	} 
																	else{
																		$cpt = $this->session->userdata('cpt');
																		$files = $this->session->userdata('file');
																	} 
																
																	$path = 'assets/images/album/' . $lastInsertedId[$i] . '/';
																	
																for ($j = 0; $j < $cpt; $j++) {
																	
																			$_FILES['portfolioImage']['name'] = $files['portfolioImage']['name'][$j];
																			$_FILES['portfolioImage']['type'] = $files['portfolioImage']['type'][$j];
																			$_FILES['portfolioImage']['tmp_name'] = $files['portfolioImage']['tmp_name'][$j];
																			$_FILES['portfolioImage']['error'] = $files['portfolioImage']['error'][$j];
																			$_FILES['portfolioImage']['size'] = $files['portfolioImage']['size'][$j];
																			$othconfig['upload_path'] = $path;
																			$othconfig['allowed_types'] = 'jpg|png';
																			$othconfig['max_size'] = '500';
																			$othconfig['encrypt_name'] = true;
																			$this->load->library('upload', $othconfig);
																			$this->upload->initialize($othconfig);
																	
																			if (!$this->upload->do_upload('portfolioImage')) {
																					$otherImgUldErr = $this->upload->display_errors();
																					$this->session->set_flashdata('errAlbumImg', 'You have not uploaded other images.');
																			} else { // Upload successful
																					$otherImageData = $this->upload->data();
																					
																				
																					$path = 'assets/images/album/' . $lastInsertedId[$i] . '/';
																					$image_path = $path . $otherImageData['file_name'];
																					$dataInfo = array(
																							"bookid" => $lastInsertedId[$i],
																							"file_name" => $otherImageData['file_name'],
																							"is_cover" => 0,
																							"path" => $image_path,
																							"tou" => date('Y-m-d H:i:s'),
																							"toc" => date('Y-m-d H:i:s')
																					);																				
	//print_r($dataInfo);
																					$otherImgUploded = $this->DashboardModel->insertAlbumImages($dataInfo);
																				
//echo  "otherImgUploded = ".$otherImgUploded."<br>";
																					if (!$otherImgUploded) {
																							$this->session->set_flashdata('errAlbumInsertImg', 'Encountered an Error While Saving Images.');
																					}
																			}
																	}
													
															$this->session->set_flashdata('addAlbumSucc', 'You have successfully added new Book.');
															//redirect(base_url() . 'Dashboard/page/AddAlbum');
													}
												}// end of for		
											} ////  4 ends
								}  //  3 ends
								else {
										$this->session->set_flashdata('addAlbumErr', 'Encountered an Error While Saving Data.');
										//redirect(base_url() . 'Dashboard/page/AddAlbum');
								}
            }// all upload finishes 
						//  2 ends
					
					else {
                $this->session->set_flashdata('cvrImageNotFound', 'You have not selected any image to upload!');
                redirect(base_url() . 'Dashboard/page/AddAlbum');
            }
        } //  1 ends
			$this->session->unset_userdata('cpt');
			$this->session->unset_userdata('file');
      redirect(base_url() . 'Dashboard/page/AddAlbum');

    }

    function uploadMultipleImages($files, $productId = null)
    {
        // portfolio upload
        $_FILES = array();
        $resultObj = array();
        $cpt = count($files['portfolioImage']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['portfolioImage']['name'] = $files['portfolioImage']['name'][$i];
            $_FILES['portfolioImage']['type'] = $files['portfolioImage']['type'][$i];
            $_FILES['portfolioImage']['tmp_name'] = $files['portfolioImage']['tmp_name'][$i];
            $_FILES['portfolioImage']['error'] = $files['portfolioImage']['error'][$i];
            $_FILES['portfolioImage']['size'] = $files['portfolioImage']['size'][$i];

            $otherConfig['upload_path'] = 'assets/images/portfolio/';
            $otherConfig['allowed_types'] = 'jpg|png';
            $otherConfig['max_size'] = '500';
            $otherConfig['encrypt_name'] = true;
            $this->load->library('upload', $otherConfig);

            if (!$this->upload->do_upload('portfolioImage')) {
                $otherImgUldErr = $this->upload->display_errors();
                $this->session->set_flashdata('imageInsertFailed', $otherImgUldErr);
                header("Location: " . base_url('Dashboard/page/Portfolio'));
                die;
            } else {
                $resultObj[$i] = $this->upload->data();
            }
        }

        return $resultObj;
    }

    function getPortfolioData($imageData, $category)
    {
        $imageDataInfo = array();
        $imageCount = count($imageData);
        for ($i = 0; $i < $imageCount; $i++) {
            $image_path = "assets/images/portfolio/" . $imageData[$i]['raw_name'] . $imageData[$i]['file_ext'];
            $imageDataInfo[$i] = array(
                "path" => $image_path,
                "category" => $category,
                "file_name" => $imageData[$i]['file_name'],
                "tou" => date('Y-m-d H:i:s'),
                "toc" => date('Y-m-d H:i:s')
            );
        }
        return $imageDataInfo;
    }

    public function removePortfolioImage($id, $fileName)
    {
        $path = 'assets/images/portfolio/' . $fileName;
        $fileDeleted = $this->removeFile($path);
        if ($fileDeleted) {
            $this->load->model('DashboardModel');
            $isRemoved = $this->DashboardModel->removeImage($id);
            if ($isRemoved) {
                $this->session->set_flashdata('portfolioImageDeleteSuccess', "Image has been removed.");
                header("Location: " . base_url('Dashboard/page/Portfolio'));
            } else {
                $this->session->set_flashdata('portfolioImageDeleteFailed', "We couldn't remove the image.");
                header("Location: " . base_url('Dashboard/page/Portfolio'));
            }
        } else {
            $this->session->set_flashdata('portfolioImageDeleteFailed', "We couldn't remove the image.");
            header("Location: " . base_url('Dashboard/page/Portfolio'));
        }
    }

    function removeFile($path)
    {
        if (unlink($path)) {
            return true;
        } else {
            return false;
        }
    }

    public function addVideo()
    {
        $this->form_validation->set_rules('title', 'Title of the Video', 'trim|required');
        $this->form_validation->set_rules('link', 'Video Link', 'trim|required');
        $this->form_validation->set_rules('details', 'Details', 'trim');
        if ($this->form_validation->run() == FALSE) {
            $valERR = validation_errors();
            $this->session->set_flashdata('filmDataInsertFailed', $valERR);
            header("Location: " . base_url('Dashboard/page/Videos'));
        }
        $title = $this->input->post('title');
        $link = $this->input->post('link');
        $details = $this->input->post('details');

        $data = array(
            'title' => $title,
            'details' => $details,
            'link' => $link,
            'tou' => date('Y-m-d H:i:s'),
            'toc' => date('Y-m-d H:i:s')
        );
        $this->load->model('DashboardModel');
        $inserted = $this->DashboardModel->insertVideo($data);
        if ($inserted) {
            $this->session->set_flashdata('filmDataInsertSuccess', 'Video has been added.');
            header("Location: " . base_url('Dashboard/page/Videos'));
        } else {
            $this->session->set_flashdata('filmDataInsertFailed', 'Looks like something is broken.');
            header("Location: " . base_url('Dashboard/page/Videos'));
        }
    }

    public function removeFilm($id)
    {
        $this->load->model('DashboardModel');
        $isRemoved = $this->DashboardModel->removeFilm($id);
        if ($isRemoved) {
            $this->session->set_flashdata('videoDeleteSuccess', "Image has been removed.");
            header("Location: " . base_url('Dashboard/page/Videos'));
        } else {
            $this->session->set_flashdata('videoDeleteFailed', "We couldn't remove the image.");
            header("Location: " . base_url('Dashboard/page/Videos'));
        }
    }

    public function editVideo()
    {
        $this->form_validation->set_rules('id', 'Id', 'trim|required');
        $this->form_validation->set_rules('title', 'Title of the Video', 'trim|required');
        $this->form_validation->set_rules('link', 'Video Link', 'trim|required');
        $this->form_validation->set_rules('details', 'Details', 'trim');
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $link = $this->input->post('link');
        $details = $this->input->post('details');
        if ($this->form_validation->run() == FALSE) {
            $valERR = validation_errors();
            $this->session->set_flashdata('filmUpdateFailed', $valERR);
            header("Location: " . base_url('Dashboard/EditFilm/' . $id));
        }

        $data = array(
            'id' => $id,
            'title' => $title,
            'details' => $details,
            'link' => $link,
            'tou' => date('Y-m-d H:i:s')
        );
        $this->load->model('DashboardModel');
        $updated = $this->DashboardModel->updateVideo($data);
        if ($updated) {
            $this->session->set_flashdata('filmUpdateSuccess', "Record has been Updated.");
            header("Location: " . base_url('Dashboard/EditFilm/' . $id));
        } else {
            $this->session->set_flashdata('filmUpdateFailed', "We couldn't update the record.");
            header("Location: " . base_url('Dashboard/EditFilm/' . $id));
        }
    }
    public function delete_files($target) {
        if(is_dir($target)){
            $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

            foreach( $files as $file )
            {
                delete_files( $file );
            }

            rmdir( $target );
            return true;
        } elseif(is_file($target)) {
            unlink( $target );
            return true;
        }
    }
    public function removeAlbum($id){
        $path = 'assets/images/album/' . $id;
       $fileDeleted = $this->delete_files($path);
        if ($fileDeleted) {
            $this->load->model('DashboardModel');
            $isRemoved = $this->DashboardModel->removeAlbumId($id);
            if ($isRemoved) {
                $this->session->set_flashdata('albumRmSucc', "Record has been Updated.");
                header("Location: " . base_url('Dashboard/page/ViewAlbum'));
            } else {
                $this->session->set_flashdata('albumRmErr', "We couldn't update the record.");
                header("Location: " . base_url('Dashboard/page/ViewAlbum'));
            }
        }
    }

    public function removeAlbumImage($albumId, $id, $sellerid, $fileName){
        $path = 'assets/images/album/' .$albumId.'/'. $fileName;
        $fileDeleted = $this->removeFile($path);
			
			
			$data['stock'] = $this->DashboardModel->getbookCountId($sellerid );
			$data['noOfBooks'] =  $data['stock'][0]['c'];
			
        if ($fileDeleted) {
            $this->load->model('DashboardModel');
            $isRemoved = $this->DashboardModel->removeAlbumImage($id);
					
            if ($isRemoved) {
                $this->session->set_flashdata('albumImageDeleteSuccess', "Image has been removed.");
                header("Location: " . base_url('Dashboard/EditBook/'.$albumId.'/'.$sellerid));
            } else {
                $this->session->set_flashdata('albumImageDeleteFailed', "1We couldn't remove the image.");
                header("Location: " . base_url('Dashboard/EditBook/'.$albumId.'/'.$sellerid));
            }
        } else {
            $this->session->set_flashdata('albumImageDeleteFailed', "2We couldn't remove the image.");
            header("Location: " . base_url('Dashboard/EditBook/'.$albumId.'/'.$sellerid));
        }
    }

    public function updateCover($id)
    {
        $this->form_validation->set_rules('toc', 'toc', 'trim|required');
        $toc = $this->input->post('toc');
        $path = 'assets/images/album/' . $id . '/';
				
			
			$sellerid =  $this->input->post('sellerId'); 
			$data['stock'] = $this->DashboardModel->getbookCountId($sellerid );
			$data['noOfBooks'] =  $data['stock'][0]['c'];
			
			

        if (!empty($_FILES['coverImage']['name'])) { // second time checking if exists or not
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '500';
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);
					
						/* checking image resolution */
						$file = $_FILES['coverImage']['tmp_name'];
						list($width, $height) = getimagesize($file);
						if($width > $height){ 
							$message = 'Cover Image resolution is '.$width .' X '.$height;
							$this->session->set_flashdata('coverResErr', $message);
							redirect(base_url() . 'Dashboard/page/AddAlbum');		
						}										

						/*ends*/
            if (!$this->upload->do_upload('coverImage', FALSE)) {
                $leadImgUldErr = $this->upload->display_errors();
                $this->session->set_flashdata('errCoverImg', $leadImgUldErr);
            } else { // Upload successful
                $leadUpload_data = $this->upload->data();
                $image_path = $path . $leadUpload_data['raw_name'] . $leadUpload_data['file_ext'];
                $leadImgData = array(
                    "productId" => $id,
                    "file_name" => $leadUpload_data['file_name'],
                    "is_cover" => 1,
                    "path" => $image_path,
                    "tou" => date('Y-m-d H:i:s'),
                    "toc" => $toc
                );
                $this->load->model('DashboardModel');
                $leadImgInsertd = $this->DashboardModel->insertCoverImage($leadImgData);
                if (!$leadImgInsertd) {
                    $this->session->set_flashdata('ErrInsCvImg', 'Encountered an Error While Saving Image.');
                    header("Location: " . base_url('Dashboard/EditBook/' . $id . '/' . $sellerid));
                } else {
                    $this->session->set_flashdata('SuccsInsCvImg', 'Image Updated Successfully.');
                    header("Location: " . base_url('Dashboard/EditBook/' . $id. '/' . $sellerid));
                }
            }
        }
        $this->session->set_flashdata('addFromErr', 'Encountered an Error While Saving Data.');
        header("Location: " . base_url('Dashboard/EditBook/' . $id. '/' . $sellerid));

    }
    public function updateAlbumImage($id){
        $this->form_validation->set_rules('toc', 'toc', 'trim|required');
        $toc = $this->input->post('toc');
			
			$sellerid =  $this->input->post('sellerId'); 
			$data['stock'] = $this->DashboardModel->getbookCountId($sellerid );
			$data['noOfBooks'] =  $data['stock'][0]['c'];
			
        if($id) {
            if (!empty($_FILES['portfolioImage']['name'])) { // If other images exists
                $files = $_FILES;
                $dataInfo = array();
                $cpt = count($_FILES['portfolioImage']['name']);
                $path = 'assets/images/album/' . $id . '/';
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['portfolioImage']['name'] = $files['portfolioImage']['name'][$i];
                    $_FILES['portfolioImage']['type'] = $files['portfolioImage']['type'][$i];
                    $_FILES['portfolioImage']['tmp_name'] = $files['portfolioImage']['tmp_name'][$i];
                    $_FILES['portfolioImage']['error'] = $files['portfolioImage']['error'][$i];
                    $_FILES['portfolioImage']['size'] = $files['portfolioImage']['size'][$i];
                    $othconfig['upload_path'] = $path;
                    $othconfig['allowed_types'] = 'jpg|png';
                    $othconfig['max_size'] = '500';
                    $othconfig['encrypt_name'] = true;
                    $this->load->library('upload', $othconfig);
                    if (!$this->upload->do_upload('portfolioImage')) {
                        $otherImgUldErr = $this->upload->display_errors();
                        $this->session->set_flashdata('errAlbumImg', $otherImgUldErr);
                    } else { // Upload successful
                        $otherImageData = $this->upload->data();
//                                    $image_path = base_url("/assets/images/vcimg/". $otherImageData['raw_name'].$otherImageData['file_ext']);
                        $path = 'assets/images/album/' . $id . '/';
                        $image_path = $path . $otherImageData['raw_name'] . $otherImageData['file_ext'];
                        $dataInfo = array(
                            "productId" => $id,
                            "file_name" => $otherImageData['file_name'],
                            "is_cover" => 0,
                            "path" => $image_path,
                            "tou" => date('Y-m-d H:i:s'),
                            "toc" => $toc
                        );
                        $this->load->model('DashboardModel');
                        $otherImgUploded = $this->DashboardModel->insertAlbumImages($dataInfo);
                        if (!$otherImgUploded) {
                            $this->session->set_flashdata('ErrInsCvImg', 'Encountered an Error While Saving Image.');
                            header("Location: " . base_url('Dashboard/EditBook/' . $id. '/' . $sellerid));
                        } else {
                            $this->session->set_flashdata('SuccsInsCvImg', 'Image Updated Successfully.');
                            header("Location: " . base_url('Dashboard/EditBook/' . $id. '/' . $sellerid));
                        }
                    }
                }
                $this->session->set_flashdata('SuccsInsCvImg', 'Image Updated Successfully.');
                header("Location: " . base_url('Dashboard/EditBook/' . $id. '/' . $sellerid));
            }
        }
        $this->session->set_flashdata('addFromErr', 'Encountered an Error While Saving Data.');
        header("Location: " . base_url('Dashboard/EditBook/' . $id. '/' . $sellerid));
    }
	public function registerSeller()
    {
        $this->load->model('DashboardModel');
        $this->form_validation->set_rules('name', 'Name of the Seller', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('mail', 'Email', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('zip', 'Zip', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        
				$id = $this->input->post('ionid');
        $sellerFormData = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('mail'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
            'status' => "1"           
        );
        
				$data['user'] = $this->ion_auth->user()->row();
		
        if ($this->form_validation->run() == FALSE) {
						$valERR = validation_errors();
            $this->session->set_flashdata('addFromValErr', $valERR);
						
						$data['page'] = 'partial/SellerRegister';
            $this->load->view('common/FormPage', $data);
        } else {
						// Insert form data in table
                $lastInsertedId = $this->DashboardModel->registerSeller($id,$sellerFormData);					
                if ($lastInsertedId) { // if last inserted ID exist
									
										// setting up the session 
										$sellerSessionData = array(
											'id' => $lastInsertedId,
											'name' => $this->input->post('name'),
											'email' => $this->input->post('mail')
										);
										$this->session->set_userdata($sellerSessionData);
										
                    $this->session->set_flashdata('addFromSucc', 'Data Added Successfully.');									
										redirect(base_url());
								} else{
										$this->session->set_flashdata('addSellerErr', 'Error! Please try again.');
										$data['page'] = 'partial/SellerRegister';
            				$this->load->view('common/FormPage', $data);
								}
					
				}// validation check if
	}
}