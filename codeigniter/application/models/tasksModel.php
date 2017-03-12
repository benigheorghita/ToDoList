<?php

class tasksModel extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
    }
    
    public function getAllTasks()
    {
        $this->db->select(array('id' ,'name', 'date_start', 'date_stop'));
        $this->db->from('tasks');
        $this->db->where('deleted', 0);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function getTask($id)
    {
        $this->db->select(array('tasks.*', 'lists.name list', 'lists.id listid'));    
        $this->db->from('tasks');
        $this->db->join('lists', 'tasks.list_id = lists.id', 'inner');
        $this->db->where('tasks.id', $id);
        $this->db->where('tasks.deleted', 0);
        $query = $this->db->get();
        
        return $query->row_array();
    }
    /**
     * Used to be sure that we won't have the same name twice on a list.
     */
    public function getTaskNameFromList($taskName, $listId)
    {
        $query = $this->db->get_where('tasks', array('name' => $taskName, 'list_id' => $listId, 'deleted' => 0));
        return $query->row_array();
    }
    
    public function create()
    {
        $data = array(
            'name' => $this->input->post('taskName'),
            'list_id' => (int) $this->input->post('list_id'),
            'content' => $this->input->post('content'),
            'date_start' => $this->input->post('datestart'),
            'date_stop' => $this->input->post('dateend'),
        );
        
        $this->db->insert('tasks', $data);
        
        return $this->db->insert_id();
    }
    
    public function edit()
    {
        $data = array(
            'name' => $this->input->post('taskName'),
            'list_id' => (int) $this->input->post('list_id'),
            'content' => $this->input->post('content'),
            'date_start' => $this->input->post('datestart'),
            'date_stop' => $this->input->post('dateend'),
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->where('deleted', 0);
        $this->db->update('tasks', $data);
        return $this->input->post('id');
    }
    
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tasks', array('deleted' => 1));
    }
    
    public function complete($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tasks', array('date_completed' => date("Y-m-d H:i:s")));
    }
}
