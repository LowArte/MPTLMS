<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\HistoryRepository;

class HistoryController extends BaseController
{ 
     /**
     * Получить истории изменения системы
     * @return JSON
     */
    public function GetHistory(HistoryRepository $historyRepositoryt)
    {
        $history = $historyRepositoryt->getHistory();
        return response()->json(compact('history'));
    }

}