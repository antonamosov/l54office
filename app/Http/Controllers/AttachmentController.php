<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Email;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function destroy(Attachment $attachment)
    {
        $file = base_path() . '/' . $attachment->path;
        if(file_exists($file)) {
            unlink($file);
        }
        $attachment->delete();

        return redirect()->back();
    }
}
