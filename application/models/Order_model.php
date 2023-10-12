<?php if(! defined('BASEPATH')) exit('No direct script acess allowed');

class Order_model extends CI_Model
{
  function __construct()
  {
	 parent::__construct();
	 //validasi jika user belum login
	 }

   function get_all()
   {
     $query = $this->db->query("select * from tbl_pinjam");
     return $query;
   }

   
  
}
?>
