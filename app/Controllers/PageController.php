<?php

namespace App\Controllers;

use App\Models\TaskModel;

class PageController extends BaseController
{
    public function home()
    {
        $data = [
            'tasks' => [],
            'today' => date('Y-m-d'),
        ];

        if (session()->get('logged_in')) {
            $data['tasks'] = (new TaskModel())
                ->where('is_archived', 0)
                ->where('task_date', date('Y-m-d'))
                ->orderBy('id', 'DESC')
                ->findAll();
        }

        return view('home', $data);
    }

    public function profile()
    {
        return view('profile');
    }

    public function about()
    {
        return view('about');
    }
}