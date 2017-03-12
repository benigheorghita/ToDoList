<?php

class listsModel extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
    }
    
    public function getLists()
    {
        $query = "SELECT l.id, l.name, count(t.id) count FROM LISTS l LEFT JOIN TASKS t "
                . "ON l.id = t.list_id WHERE l.deleted = 0 AND t.deleted = 0 GROUP BY l.id";
        $query = $this->db->query($query);
        return $query->result_array();
    }
    
    public function getList($id)
    {
        $this->db->select(array('lists.*', 'parentList.name parentListName'));    
        $this->db->from('lists');
        $this->db->join('lists parentList', 'lists.parent_id = parentList.id', 'left');
        $this->db->where('lists.id', $id);
        $this->db->where('lists.deleted', 0);
        $query = $this->db->get();
        
        return $query->row_array();
    }
    
    public function getTasksForList($id)
    {
        $this->db->select(array('id', 'name'));    
        $this->db->from('tasks');
        $this->db->where('list_id', $id);
        $this->db->where('deleted', 0);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function getListName($name)
    {
        $query = $this->db->get_where('lists', array('name' => $name));
        return $query->row_array();
    }
    
    public function create()
    {
        $data = array(
            'name' => $this->input->post('listName'),
            'parent_id' => ($this->input->post('parent') == "None") ? null : (int) $this->input->post('parent')
        );
        
        $this->db->insert('lists', $data);
        
        return $this->db->insert_id();
    }
    
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->update('lists', array('deleted' => 1));
    }
}
