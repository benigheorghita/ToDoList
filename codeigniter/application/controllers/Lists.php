<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('listsModel');
        $this->load->helper('url_helper');
    }
    
    public function allLists() 
    {
        $data['lists'] = $this->listsModel->getLists();
        $this->load->view('templates/header', array('title' => 'Available lists'));
        $this->load->view('pages/lists/viewAll', $data);
        $this->load->view('templates/footer');
    }
    
    public function oneList($id) 
    {
        $data['list'] = $this->listsModel->getList($id);
        $data['childrenTasks'] = $this->listsModel->getTasksForList($id);
        
        $this->load->view('templates/header', array('title' => $data['list']['name']));
        $this->load->view('pages/lists/viewOne', $data);
        $this->load->view('templates/footer');
    }
    
    public function deleteList($id) 
    {
        $this->listsModel->delete($id);
        redirect('/lists', 'location');
    }
    
    public function createList() 
    {
        $this->load->view('templates/header', array('title' => 'Available lists'));
        $existingLists = $this->listsModel->getLists();
        
        if ($this->input->post('listName')) {
            /**
             * processlibrary is used to make sure that we have the name set and
             * will not have the same name set twice.
             */
            $this->load->library('processlibrary', array(
                'data' => array(
                    'listName' => $this->input->post('listName'),
                ),
                'controller' => 'lists'
            ));
            if ($this->processlibrary->validateForCreate()) {
                $idOfCreatedList = $this->listsModel->create();
                redirect('list/' . $idOfCreatedList . '/', 'location');
            } elseif (!empty($this->input->post('listName'))) {
                $this->load->view(
                    'pages/lists/create', 
                    array('error' => 'This list name already exists. Please select another one.', 'existingLists' => $existingLists)
                );
            } else {
                $this->load->view(
                    'pages/lists/create', 
                    array(
                        'error' => 'Your list creation crashed because of an unexpected error. '
                        . 'Please contact the technical support.',
                        'existingLists' => $existingLists
                    )
                );
            }
        } else {
            
            $this->load->view('pages/lists/create', array(
                'error' => '', 
                'existingLists' => $existingLists
                )
            );
        }
        $this->load->view('templates/footer');
    }
}
