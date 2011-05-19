<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Application_Model_Albums extends Zend_Db_Table
{
        protected $_name = 'album';

    public function getAlbum()
    {
        // $sql = "SELECT * FROM `album` ORDER BY album_id ASC";
        $query=$this->select('album_id','name_n','details');
        $query->where('name_n <> ? ','');
        //$query->limit(3);
        $query->order('name_n asc');
	  $result = $this->fetchAll($query);
          return $result;
    }
      public function addAlbum($a_name,$a_det)
        {
        $inser_data=array('name_n'=>$a_name,'details'=>$a_det);
        $result=$this->insert($inser_data);
        return  $result;
        }
    public function detAlbum($id)
        {
       // echo "gdsgdsg";exit;
        $query=$this->select('name_n','details');
        $query->where('album_id = ?',$id);
        $result=$this->fetchRow($query);
        return  $result;
        }
        public function editAlbum($a_name,$a_det,$id)
        {
            $arr=array('name_n'=>$a_name,'details'=>$a_det);
            //$where=this->('album_id = ?',$id);
           $where=$this->getAdapter()->quoteInto('album_id = ?', $id);
          $result=$this->update($arr,$where);

        return  $result;
        }
        public function deleteAlbum($id)
        {
           // $this->
            //echo $id;exit;
            $where=$this->getAdapter()->quoteInto('album_id=?',$id);
            $result=$this->delete($where);
            return $result;
        }
        public function getCommondata()
        {
            // $albums =  new Application_Model_Albums();
             $select = $this->select()
                           // ->setIntegrityCheck(false)
                            ->from(array('album' => 'album'),array('Id','name_n'))
                            ->join('album_det','album_det.Id = album.Id',array('album_det.Id'));
           // $result=$this->fetchAll($hhh);
             $result = $this->fetchAll($select);
           
            echo "<pre>";
            print_r($result);exit;
            return $result;

        }







}
?>
