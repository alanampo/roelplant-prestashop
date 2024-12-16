<?php

namespace Chatgptcontentgenerator\ProductReviews\Traits;

trait ResponseTrait
{
    public function jsonResponse($data = null)
    {
        if (is_array($data) || is_null($data)) {
            $data = array_merge(['success' => true], $data ?? []);
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function errorResponse($code = 500, $message = 'Error message default')
    {
        $error = ['code' => $code, 'message' => $message, 'status' => ''];

        if ($code == 18) {
            $error['status'] = 'quota_over';
        }
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'error' => $error,
        ]);
        exit;
    }

    public function jsonExeptionResponse(\Exception $e)
    {
        return $this->errorResponse($e->getCode(), $e->getMessage());
    }
}
