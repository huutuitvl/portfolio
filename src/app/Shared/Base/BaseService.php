<?php

namespace App\Shared\Base;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

abstract class BaseService
{
    /**
     * Run a database transaction with automatic rollback and error handling.
     *
     * @param callable $callback
     * @return mixed
     * @throws Throwable
     */
    protected function handleTransaction(callable $callback)
    {
        try {
            return DB::transaction(function () use ($callback) {
                return $callback();
            });
        } catch (Throwable $e) {
            Log::error('Transaction failed: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            throw $e; // optional: rethrow the exception to handle it further up the stack
        }
    }

}