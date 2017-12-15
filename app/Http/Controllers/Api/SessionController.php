<?php

namespace App\Http\Controllers\Api;

use App\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;

class SessionController extends Controller
{
    public function free(Session $session)
    {
        $success = $session->free();
        $output = [
            'success' => $success
        ];
        if(!$success) {
            $output['message'] = 'No places';
        }

        return response()->json($output);
    }
}
