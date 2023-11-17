<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getById($id, $columns = ['*']): ?Model;
}
