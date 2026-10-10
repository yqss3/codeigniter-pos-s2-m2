<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();

        $data['tasks'] = $taskModel
            ->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')
            ->findAll();

        return view('tasklist', $data);
    }

    public function create()
    {
        return view('task_form', [
            'task' => null,
            'validation' => session()->getFlashdata('validation'),
        ]);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|max_length[255]',
            'task_date' => 'required|valid_date[Y-m-d]',
        ];

        if (!$this->validate($rules)) {
            return view('task_form', [
                'task' => null,
                'validation' => $this->validator,
            ]);
        }

        $taskModel = new TaskModel();

        $taskModel->insert([
            'title' => trim($this->request->getPost('title')),
            'description' => trim(
                $this->request->getPost('description') ?? ''
            ),
            'task_date' => $this->request->getPost('task_date'),
            'is_archived' => 0,
        ]);

        return redirect()->to('/tasks')
            ->with('success', 'Task added successfully!');
    }

    public function edit($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (!$task || $task['is_archived']) {
            return redirect()->to('/tasks')
                ->with('error', 'Task not found.');
        }

        return view('task_form', [
            'task' => $task,
            'validation' => null,
        ]);
    }

    public function update($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (!$task || $task['is_archived']) {
            return redirect()->to('/tasks')
                ->with('error', 'Task not found.');
        }

        $rules = [
            'title' => 'required|max_length[255]',
            'task_date' => 'required|valid_date[Y-m-d]',
        ];

        if (!$this->validate($rules)) {
            return view('task_form', [
                'task' => $task,
                'validation' => $this->validator,
            ]);
        }

        $taskModel->update($id, [
            'title' => trim($this->request->getPost('title')),
            'description' => trim(
                $this->request->getPost('description') ?? ''
            ),
            'task_date' => $this->request->getPost('task_date'),
        ]);

        return redirect()->to('/tasks')
            ->with('success', 'Task updated successfully!');
    }

    public function archive($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (!$task || $task['is_archived']) {
            return redirect()->to('/tasks')
                ->with('error', 'Task not found.');
        }

        $taskModel->update($id, [
            'is_archived' => 1,
        ]);

        return redirect()->to('/tasks')
            ->with('success', 'Task archived successfully!');
    }
}