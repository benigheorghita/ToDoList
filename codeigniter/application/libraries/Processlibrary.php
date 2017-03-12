<?php
/**
 * This class is used to make sure that we have the required fields to perform
 * a task / list creation and we don't have the same name twice. 
 * On edit action, it will skip the name filtering but will still check for 
 * required fields.
 */
class Processlibrary {
    
    private $controller;
    private $receivedData;
    private $CI;
    /**
     * 
     * @param type $params
     */
    public function __construct($params)
    {
        $this->CI =& get_instance();
        $this->receivedData = $params['data'];
        $this->controller = $params['controller'];
    }
    /**
     * 
     * @return boolean|string
     */
    public function validateForCreate() 
    {
        if ($this->controller == 'lists') {
            if (!empty($this->receivedData['listName']) && $this->validateListName()) {
                return true;
            }
            return;
        } else if ($this->controller == 'tasks') {
            if (
                !empty($this->receivedData['taskName']) &&
                (!empty($this->receivedData['list_id']) && $this->receivedData['list_id'] != 0) &&
                !empty($this->receivedData['content'])
            ) {
                if ($this->validateTaskNameForList()) {
                    return true;
                } else if ($this->CI->uri->segment(3) == "edit") {
                    // On edit action we should skip the name validation after list
                    return true;
                }
            } else {
                return 'incomplete';
            }
            return;
        }
    }
    /**
     * 
     * @return boolean
     */
    private function validateListName() 
    {
        $this->CI->load->model('listsModel');
        
        if (!empty($this->CI->listsModel->getListName($this->listName))) {
            return;
        }
        return true;
    }
    /**
     * 
     * @return boolean
     */
    private function validateTaskNameForList() 
    {
        $this->CI->load->model('tasksModel');
        
        if (!empty(
                $this->CI->tasksModel->getTaskNameFromList(
                    $this->receivedData['taskName'], 
                    $this->receivedData['list_id']
                )
            )) {
            return;
        }
        return true;
    }
}
