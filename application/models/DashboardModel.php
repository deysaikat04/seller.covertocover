<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dipan
 * Date: 14-08-2017
 * Time: 23:29
 */
class DashboardModel extends CI_Model
{
		public function addSeller($userData)
		{
					if ($this->db->insert('seller', $userData)) {
							$lastDataId = $this->db->insert_id();
							return $lastDataId;
					} else {
							return false;
					}
		}
		public function checkSellerExixt($id)
    {
        $sql = "select * from seller s where s.ionid = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }
		public function toptenBookExist($name)
    {
        $sql = "select * from topten  where bookname = '$name'";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }
		public function toptenBookCount()
    {
				$c = 0;
        $sql = "select * from topten";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count >= 1) {
            return $count;
        } else {
            return $c;
        }
    }
		public function checkAuthor($name)
    {
        $sql = "select * from author where name = '$name'";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count == 1) {
            return $data;
        } else {
            return false;
        }
    }
		public function checkPublisher($name)
    {
        $sql = "select * from publisher where pname = '$name'";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count == 1) {
            return $data;
        } else {
            return false;
        }
    }
		public function getSellerStatus($id) 
    {
        $sql = "select * from seller s where s.ionid = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
		public function registerSeller($id,$data)
    {
        $this->db->where('ionid', $id);
        if($this->db->update('seller', $data)){
            return true;
        } else {
            return false;
        }
    }
		public function getLastProductID()
    {
        $sql = "select MAX(id) as lastId from books order by id DESC LIMIT 1 ";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
    public function insertMultipleImages($data)
    {
        $inserted = array();
        $dataCount = count($data);
        for($i = 0; $i < $dataCount; $i++) {
            $inserted = $this->db->insert('portfolio_tb', $data[$i]);
        }
        return $inserted;
    }
		public function addBook($albumFormData, $qty)
			{
					$data = array();
					for($i = 0; $i < $qty; $i++){
						if ($this->db->insert('books', $albumFormData)) {
								$lastDataId = $this->db->insert_id();
								$data[$i] = $lastDataId; 
						} else {
								$data[$i] = 0;
						}
					}
				return $data;
		}
		public function toptenBookAdd($Data)
    {
        $result = 0;
        if ($this->db->insert('topten', $Data)) {
            $lastDataId = $this->db->insert_id();
            $result = $lastDataId;
        } 				
        return $result;
    }
		public function toptenBookDelete()
    {
        $sql = "DELETE FROM `topten` ORDER BY id limit 1";
        $query = $this->db->query($sql);
        if ($query == 1) {
            return true;
        } else {
            return false;
        }
			
    }
		public function addEdition($editionData)
    {
        $result = 0;
        if ($this->db->insert('bookedition', $editionData)) {
            $lastDataId = $this->db->insert_id();
            $result = $lastDataId;
        } 				
        return $result;
    }
		public function addAuthor($Data)
    {
        $result = 0;
        if ($this->db->insert('author', $Data)) {
            $lastDataId = $this->db->insert_id();
            $result = $lastDataId;
        } 				
        return $result;
    }
		public function addPublisher($Data)
    {
        $result = 0;
        if ($this->db->insert('publisher', $Data)) {
            $lastDataId = $this->db->insert_id();
            $result = $lastDataId;
        } 				
        return $result;
    }
		public function addBooksToEdition($editionData)
    {
        $result = 0;
        for($i = 0; $i < count($editionData); $i++){
						if ($this->db->insert('bookstoedition', $editionData[$i])) {
								//$lastDataId = $this->db->insert_id();
								$result = 1;
						} 
					}				
        return $result;
    }
		public function addEdToAuthToPub($Data)
    {
        $result = 0;
        if ($this->db->insert('editiontoauthor', $Data)) {
            $lastDataId = $this->db->insert_id();
            $result = $lastDataId;
        } 				
        return $result;
    }
		public function addDiscount($Data)
    {
        $result = array();
        for($i = 0; $i < count($Data); $i++){
						if ($this->db->insert('discount', $Data[$i])) {
								$lastDataId = $this->db->insert_id();
								$result[$i] = $lastDataId;
						} else{
							$result[$i] = 0;
						}
					}				
        return $result;
    }
    public function insertCoverImage($albumDataCover)
    {
        $result = 0;
        if ($this->db->insert('image_tb', $albumDataCover)) {
            //$lastDataId = $this->db->insert_id();
            $result = 1;
        }
        return $result;
    }
    public function insertAlbumImages($data)
    {
        if($this->db->insert('image_tb', $data)){
            return true;
        } else {
            return false;
        }
    }
    /*------------order------------*/
    public function getOrderSummary()
    {
        $sql = "select * from order_tb";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
    public function getSellerFromBookId($seller)
    {
        $sql = "select * from discount where sellerid = $seller";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
    public function customerData($id)
    {
        $sql = "select name,email,phone,city,address,state,zip,country from customer where id = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
     public function getBookFromOrder($id)
    {
        $sql = "select * from books where id = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
    /*------------order ends------------*/
    public function removeImage($id)
    {
        $sql = "DELETE FROM `portfolio_tb` WHERE `id`= $id";
        $query = $this->db->query($sql);
        if ($query == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function insertVideo($video)
    {
        $inserted = $this->db->insert('video_tb', $video);
        return $inserted;
    }
    public function getVideos()
    {
        $query = $this->db->get('video_tb');
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
    public function removeFilm($id)
    {
        $sql = "DELETE FROM `video_tb` WHERE `id`= $id";
        $query = $this->db->query($sql);
        if ($query == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function getVideo($id)
    {
        $sql = "SELECT * FROM `video_tb` WHERE `id`= $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
    public function updateVideo($data)
    {
        $this->db->where('id', $data['id']);
        if($this->db->update('video_tb', $data)){
            return true;
        } else {
            return false;
        }
    }
    public function getallAlbum()
    {
        $sql = "select * from books a, image_tb i where a.id = i.bookid AND i.is_cover=1"; 
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
    public function removeAlbumId($id)
    {
        $sql_child = "DELETE FROM  image_tb where bookid = $id";
        $query_child = $this->db->query($sql_child);
        if($query_child == 1) {
            $sql_par = "DELETE FROM  album_details_tb where id = $id";
            $query_par = $this->db->query($sql_par);
        }
        if ($query_par == 1) {
            return true;
        } else {
            return false;
        }
    }
    /*public function getallBooks()
    {
        $sql = "select * from books p, image_tb i where p.id = i.bookid AND i.is_cover=1";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }*/
	/****************************************  Joining  ****************************************************/
	
		public function getBookIdBySeller($id)
    {
        $sql = "select * from discount where sellerid = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
		public function getEditionIdByBook($id)
    {
        $sql = "select * from bookstoedition where bookid = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
		public function geAuthPubIdByEdition($id)
    {
        $sql = "select distinct editionid,authorid,pid from editiontoauthor where editionid = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
	/***********************************************************/
		// get bookdata 
		public function getBookData($id)
    {
        $sql = "select * from books where id = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
		// get edition data 
		public function getEditionData($id)
    {
        $sql = "select * from bookedition where id = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
		// get authordata 
		public function getAuthorData($id)
    {
        $sql = "select * from author where id = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
	// get publisher data 
		public function getPublisherData($id)
    {
        $sql = "select * from publisher where id = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
	
    public function getAlbumDetailsbyId($id)
    {
        $sql = "select * from books a where a.id = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
		public function getbookCountId($id)
    {
        $sql = "SELECT COUNT(*) as c FROM `books` WHERE sellerid = $id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
    public function getAlbumCoverImagesbyId($id)
    {
        $sql = "select * from image_tb  where bookid = $id AND is_cover = 1";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);

        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
    public function getAlbumImagesbyId($id)
    {
        $sql = "select * from image_tb i where i.bookid = $id AND i.is_cover = 0";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
    public function imagecount($id)
    {
        $query = $this->db->query("select * from image_tb i where i.bookid = $id AND i.is_cover = 1");
        $row_count = $query->num_rows();
        return $row_count;
    }
    public function removeAlbumImage($id)
    {
        $sql = "DELETE FROM `image_tb` WHERE `id`= $id";
        $query = $this->db->query($sql);
        if ($query == 1) {
            return 1;
        } else {
            return 0;
        }
    }
    public function updateBook($albumFormData){
        $this->db->where('id', $albumFormData['id']);
        if($this->db->update('books', $albumFormData)){
            return true;
        } else {
            return false;
        }
    }
	
		public function countAll(){
			$count = array();
			$query_album = $this->db->query("select * from books");
			$row_album = $query_album->num_rows();
			$query_images = $this->db->query("select * from `image_tb`");
			$row_images = $query_images->num_rows();
			$query_portfolio = $this->db->query("select * from `customer`");
			$row_port = $query_portfolio->num_rows();
			$query_order = $this->db->query("select * from `author`");
			$row_order = $query_order->num_rows();
			
			$count =array(
					'allAlbum' => $row_album,
					'allImages' => $row_images,
					'allPort' => $row_port,
					'allVideo' => $row_order
			);
			return $count;			
		}

    public function removeStat($data,$pr_id,$status)
    {
        extract($data);
        if($status == 0){
            $this->db->where('Id', $pr_id);  
            $this->db->update($table_name, array('status' => 1)); 
            return true;
        }
        else{
            $this->db->where('Id', $pr_id);  
            $this->db->update($table_name, array('status' => 0)); 
            return true;
        }  
        
    }
	public function remove($pr_id)
    {
        $sql = "select * from books where id = $pr_id "; 
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $count = count($data);
        if ($count < 1) {
            return false;
        } else {
            return $data;
        }
    }
}