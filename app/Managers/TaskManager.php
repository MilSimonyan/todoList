<?php

declare(strict_types=1);

namespace App\Managers;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class TaskManager
{
    public function __construct(
        protected TaskRepository $taskRepository
    ) {
    }

    /**
     * @param int $id
     *
     * @return \App\Models\Task|null
     */
    public function getById(int $id): ?Task
    {
        /** @var Task|null */
        return $this->taskRepository->find($id);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAll(): Collection
    {
        return $this->taskRepository->all();
    }

    /**
     * @param array $data
     *
     * @return \App\Models\Task
     */
    public function create(array $data): Task
    {
        $status = $data['status'] ?? null;

        if (!$status) {
            $data['status'] = TaskStatusEnum::getValueByName(TaskStatusEnum::TODO->name);
        }

        /** @var Task */
        return $this->taskRepository->create($data);
    }

    /**
     * Why I don't wrote this repo? Because I Want to show that I can work with model too
     *
     * @param int   $id
     * @param array $data
     *
     * @return \App\Models\Task
     * @throws \Exception
     */
    public function update(int $id, array $data): Task
    {
        /** @var Task $task */
        $task = $this->taskRepository->find($id);

        if (!$task) {
            throw new Exception('Task not exists.');
        }

        $task->title = Arr::get($data, 'title', $task->title);
        $task->description = Arr::get($data, 'description', $task->description);
        $task->title = Arr::get($data, 'status', $task->status);
        $task->save();

        return $task;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->taskRepository->delete($id);
    }
}
