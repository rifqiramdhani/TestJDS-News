<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //

    protected $successMessage = [
        'get' => 'Data has been successfully retrieved',
        'insert' => 'Data has been successfully saved',
        'update' => 'Data has been successfully updated',
        'delete' => 'Data has been successfully deleted',
    ];

    protected $errorMessage = [
        'notfound' => 'Data not found',
        'get' => 'Data has failed to retrieved',
        'insert' => 'Data has failed to saved',
        'update' => 'Data has failed to updated',
        'delete' => 'Data has failed to deleted',
    ];

    public function sendResponse($message, $result = [])
    {
        $response = [
            'status' => "success",
            'message' => $message,
            'data' => $result,
        ];

        return response()->json($response, 200);
    }

    public function sendError($message, $code = 404, $errorMessages = [])
    {
        $response = [
            'status' => "failed",
            'message' => $message,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
