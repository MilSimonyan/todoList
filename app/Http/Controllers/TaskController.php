<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Managers\TaskManager;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskController extends Controller
{
    public function __construct(
        public TaskManager $taskManager
    ) {
    }

    /**
     * @param \App\Http\Requests\TaskRequest $request
     *
     * @return \App\Models\Task
     */
    public function create(TaskRequest $request): Task
    {
        $data = $request->all();

        return $this->taskManager->create($data);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function index(): Collection
    {
        return $this->taskManager->getAll();
    }

    /**
     * @param int $id
     *
     * @return \App\Models\Task|null
     */
    public function show(int $id): ?Task
    {
        return $this->taskManager->getById($id);
    }

    /**
     * @throws \Exception
     */
    public function update(TaskUpdateRequest $request, int $id): Task
    {
        return $this->taskManager->update($id, $request->all());
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->taskManager->delete($id);
    }
}
