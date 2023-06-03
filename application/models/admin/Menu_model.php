<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_menu';
        
    }
    public function insert($data){
        $this->db->insert($this->table,$data);
        $insert_id = $this->db->insert_id();
        echo $this->db->last_query(); die();
        return  $insert_id;
    } 
    function update($data,$id){
        $this->db->where(array('id'=>$id));
        $this->db->update($this->table,$data);
        return true;
    }
    function updateMenu($data,$id){
       
        $this->db->update($this->table,$data);
        return true;
    }
    function deleteRow($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table); 
        return true;
    }

    public function get_count_record()
    {
        $query = $this->db->count_all($this->table);

        return $query;
    }

    public function getAll(){
       $this->db->order_by("id", "desc");
        $data = $this->db->get_where($this->table)->result();
        return $data;
    }
   
    function setMenu($menu){
        foreach($menu as $key => $menuItems){
            
            $parent = $menuItems['id'];
            $parentMenuArr = array();
            $parentMenuArr['ordering'] = $key;
            $parentMenuArr['parent'] = 0;
            
            
            $this->update($parentMenuArr,$parent);           
            if(isset($menuItems['children'])){
                $this->saveMenuChilds($menuItems['children'],$parent);
            }
        }
    }
    function saveMenuChilds($childMenu,$parent){
        foreach($childMenu as $key => $child){
            $parentMenuArr = array();
            $parentMenuArr['ordering'] = $key;
            $parentMenuArr['parent'] = $parent;
            $where = array('id'=>$child['id']);
            $this->update($parentMenuArr,$child['id']);           
            if(isset($child['children'])){
                $parent = $child['id'];
                $this->saveMenuChilds($child['children'],$parent);
            }
        }
    }
    function getMenu(&$html){

        $this->db->where('parent="0"');
        $this->db->order_by('ordering','asc');
        $data = $this->db->get($this->table)->result_array();
        
        foreach($data as $key => $menuItems){
            $html .= '<li class="dd-item" data-id="'.$menuItems['id'].'">
                        <div class="dd-handle">'.$menuItems['title'].'</div>
                        <a data-id="'.$menuItems['id'].'"  href="javascript:void(0)" title="Delete" class="fa fa-trash deletebutton"></a> ';
            $this->getChildMenu($menuItems['id'],$html);
            $html .= '</li>';
        } 
    }
    function getChildMenu($parent,&$html){

        $this->db->where('parent='.$parent);
        $this->db->order_by('ordering','asc');
        $data = $this->db->get($this->table)->result_array();

        
        
        if(count($data)){
            $html .= '<ol class="dd-list">';
            foreach($data as $items){
                $html .= '<li class="dd-item" data-id="'.$items['id'].'">
                        <div class="dd-handle">'.$items['title'].'
                        </div><a data-id="'.$items['id'].'" href="javascript:void(0)" title="Delete" class="fa fa-trash deletebutton"></a> ';
                $this->getChildMenu($items['id'],$html);
                $html .= '</li>';
            }
            $html .= '</ol>';
        }
    }
    
}