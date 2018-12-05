<?php

namespace App\Services;

use App\Board;

class BoardService
{    
    public function loadThreads(Board $board, $quantity = 3)
    {
        return $board->posts()
            ->with(['user', 'children' => function ($query) {
                $query->orderByDesc('num')
                    ->orderByDesc('created_at');
            }])
            ->where(['board_id' => $board->id, 'is_op' => 1, ['status', '!=', 'archived']])
            ->orderByDesc('is_sticky')
            ->orderByDesc('updated_at')
            ->get()
            ->map(function ($threads) use ($quantity) {
                $threads->children = $threads->children->take($quantity)->reverse();
                return $threads;
            });
    }
}
