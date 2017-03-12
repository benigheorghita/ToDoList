<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tasksModel');
        $this->load->model('listsModel');
        $this->load->helper('url_helper');
    }

    public function oneTask($id) {
        $data['task'] = $this->tasksModel->getTask($id);

        $this->load->view('templates/header', array('title' => $data['task']['name']));
        $this->load->view('pages/tasks/viewOne', $data);
        $this->load->view('templates/footer');
    }

    public function createTask() {
        $this->load->view('templates/header', array('title' => 'New Task'));
        $existingLists = $this->listsModel->getLists();
        
        if ($this->input->post('taskName')) {
            $this->handleTask('create', $existingLists);
        } else {
            
            $this->load->view(
                'pages/tasks/create', array('error' => '', 'existingLists' => $existingLists)
            );
        }

        $this->load->view('templates/footer');
    }

    public function editTask($id) {
        $data['task'] = $this->tasksModel->getTask($id);
        $data['existingLists'] = $this->listsModel->getLists();
        $this->load->view('templates/header', array('title' => 'Edit ' . $data['task']['name']));

        if ($this->input->post('taskName')) {
            $this->handleTask('edit', $data['existingLists']);
        } else {
            $this->load->view('pages/tasks/edit', array('task' => $data['task'], 'existingLists' => $data['existingLists']));
        }
        $this->load->view('templates/footer');
    }
    
    public function deleteTask($id)
    {
        $this->tasksModel->delete($id);
        redirect('/', 'location');
    }
    
    public function completeTask($id)
    {
        $this->tasksModel->complete($id);
        redirect('/task/' . $id, 'location');
    }

    /**
     * Method used to perform the validation for both creation and edit of tasks.
     */
    private function handleTask($status, $existingLists = array()) {
        $this->load->library(
                'processlibrary', array(
                    'data' => array(
                        'taskName' => $this->input->post('taskName'),
                        'list_id' => $this->input->post('list_id'),
                        'content' => $this->input->post('content'),
                    ),
                    'controller' => 'tasks'
                )
        );
        if (is_bool($this->processlibrary->validateForCreate())) {

            if ($this->processlibrary->validateForCreate()) {
                $idOfCreatedTask = $this->tasksModel->$status();
                redirect('task/' . $idOfCreatedTask . '/', 'location');
            } else {
                $this->load->view(
                        'pages/tasks/' . $status, array(
                            'error' => 'Your request to ' . $status . ' a task '
                                        . 'crashed because of an unexpected error. Please contact the technical support.',
                            'existingLists' => $existingLists,
                        )
                );
            }
        } elseif (
                is_string($this->processlibrary->validateForCreate()) &&
                $this->processlibrary->validateForCreate() == "incomplete"
        ) {
            $this->load->view(
                    'pages/tasks/' . $status, array(
                        'error' => 'Please complete all the fields.',
                        'existingLists' => $existingLists,
                    )
            );
        }
    }

}
