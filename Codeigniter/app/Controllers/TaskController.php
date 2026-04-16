<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class TaskController extends BaseController {
    use ResponseTrait;

    // --- AUTHENTICATION (Unchanged) ---
    public function login() {
        return view('login_view');
    }

    public function authenticate() {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'isLoggedIn' => true, 
                'user_id'    => $user['id'], 
                'username'   => $user['username']
            ]);
            return redirect()->to('/tasks');
        }
        return redirect()->back()->with('error', 'Invalid Login Credentials');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }

    // --- MAIN DASHBOARD (UPDATED FOR READ-ONLY API) ---
   public function index() {
    if (!session()->get('isLoggedIn')) return redirect()->to('/login');
    
    $taskModel = new TaskModel();
    $userModel = new UserModel();
    $data['tasks'] = $taskModel->findAll(); 
    $data['all_users'] = $userModel->findAll();

    $client = \Config\Services::curlrequest();
    try {
        // Explicitly requesting 30 items via the limit parameter
        $response = $client->get('https://dummyjson.com/todos?limit=30');
        $result = json_decode($response->getBody(), true);

        $external_tasks = $result['todos'] ?? [];

        foreach ($external_tasks as &$task) {
            $task['status_label'] = $task['completed'] ? 'Completed' : 'Pending';
        }
        
        $data['external_todos'] = $external_tasks;

    } catch (\Exception $e) {
        $data['external_todos'] = []; 
    }

    return view('tasks_view', $data);
}
    // --- CRUD OPERATIONS (Unchanged) ---
   public function create() {
    $model = new TaskModel();
    
    $data = [
        'title'   => $this->request->getPost('title'),
        // Automatically assign to current user, removing the dropdown dependency
        'user_id' => session()->get('user_id'), 
        'status'  => 'pending'
    ];

    if ($model->insert($data)) {
        return redirect()->to('/tasks')->with('message', 'Task successfully created.');
    }
    return redirect()->back()->with('error', 'Creation failed.');
}

    public function edit($id = null) {
        $taskModel = new TaskModel();
        $userModel = new UserModel();
        $data['task'] = $taskModel->find($id);
        $data['all_users'] = $userModel->findAll(); 
        
        if (!$data['task']) {
            return redirect()->to('/tasks')->with('error', 'Task not found.');
        }
        return view('edit_task_view', $data);
    }

    public function update($id = null) {
    $model = new TaskModel();
    
    $data = [
        'title'   => $this->request->getPost('title'),
        'status'  => $this->request->getPost('status')
        // Removed 'user_id' update to prevent re-assignment
    ];

    if ($model->update($id, $data)) {
        return redirect()->to('/tasks')->with('message', 'Task updated successfully.');
    }
    return redirect()->back()->with('error', 'Update failed.');
}

    public function delete($id = null) {
        $model = new TaskModel();
        $existing = $model->find($id);
        
        if (!$existing) {
            return redirect()->to('/tasks')->with('error', 'Task does not exist.');
        }

        if ($model->delete($id)) {
            return redirect()->to('/tasks')->with('message', 'Task removed successfully.');
        }
        return redirect()->to('/tasks')->with('error', 'Delete failed.');
    }
}