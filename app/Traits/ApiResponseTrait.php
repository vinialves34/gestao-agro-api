<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait ApiResponseTrait
{
    /**
     * Return a successful JSON response.
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data = null, $message = null, $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param int $status
     * @param array|null $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($message = 'Erro', $status = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], ($status < 100 || $status > 599) ? 500 : $status);
    }

    /**
     * Return a paginated JSON response.
     *
     * @param LengthAwarePaginator $paginator
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function paginated(LengthAwarePaginator $paginator, $message = null)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'links' => $paginator->linkCollection(),
            ]
        ]);
    }
}
