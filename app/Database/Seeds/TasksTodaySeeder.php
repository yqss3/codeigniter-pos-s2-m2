<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TasksTodaySeeder extends Seeder
{
    public function run()
    {
        $userTable = $this->db->table('users');

        // Create demo account if it does not exist
        $user = $userTable
            ->where('email', 'demo@example.com')
            ->get()
            ->getRowArray();

        if (!$user) {
            $userTable->insert([
                'name'       => 'Demo User',
                'email'      => 'demo@example.com',
                'password'   => password_hash('Demo1234!', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Add sample tasks only if the table is empty
        $taskTable = $this->db->table('tasks');

        if ($taskTable->countAllResults() === 0) {
            $today = date('Y-m-d');
            $yesterday = date('Y-m-d', strtotime('-1 day'));
            $tomorrow = date('Y-m-d', strtotime('+1 day'));

            $tasks = [
                [
                    'title' => 'Review class notes',
                    'description' => 'Review important lessons.',
                    'task_date' => $today,
                    'is_archived' => 0,
                ],
                [
                    'title' => 'Complete programming activity',
                    'description' => 'Finish the CodeIgniter activity.',
                    'task_date' => $today,
                    'is_archived' => 0,
                ],
                [
                    'title' => 'Organize study materials',
                    'description' => 'Arrange notes and reviewers.',
                    'task_date' => $today,
                    'is_archived' => 0,
                ],
                [
                    'title' => 'Read previous lesson',
                    'description' => 'Review yesterday’s lesson.',
                    'task_date' => $yesterday,
                    'is_archived' => 0,
                ],
                [
                    'title' => 'Submit previous assignment',
                    'description' => 'Check the assignment submission.',
                    'task_date' => $yesterday,
                    'is_archived' => 0,
                ],
                [
                    'title' => 'Prepare tomorrow’s tasks',
                    'description' => 'List upcoming activities.',
                    'task_date' => $tomorrow,
                    'is_archived' => 0,
                ],
                [
                    'title' => 'Plan weekly schedule',
                    'description' => 'Organize the upcoming week.',
                    'task_date' => $tomorrow,
                    'is_archived' => 0,
                ],
                [
                    'title' => 'Old completed task',
                    'description' => 'Sample archived task.',
                    'task_date' => $yesterday,
                    'is_archived' => 1,
                ],
            ];

            foreach ($tasks as &$task) {
                $task['created_at'] = date('Y-m-d H:i:s');
                $task['updated_at'] = date('Y-m-d H:i:s');
            }
            unset($task);

            $taskTable->insertBatch($tasks);
        }
    }
}