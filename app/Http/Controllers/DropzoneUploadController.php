<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropzoneUploadController extends Controller
{
    public function fileStore(Request $rq)
    {
        $images = [];
        if ($rq->ajax()) {
            if ($rq->hasFile('file')) {
                $imageFiles = $rq->file('file');
                // set destination path
                $folderDir       = 'upload/motel';
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $folderDir;
                // this form uploads multiple files
                foreach ($rq->file('file') as $fileKey => $fileObject) {
                    // make sure each file is valid
                    if ($fileObject->isValid()) {
                        // make destination file name
                        $destinationFileName = $fileObject->getClientOriginalName();
                        // move the file from tmp to the destination path
                        $fileObject->move($destinationPath, $destinationFileName);
                        $images[] = $destinationFileName;
                    }
                }
            }
        };
        return json_encode($images);
    }

    public function fileDestroy(Request $rq)
    {
        if ($rq->ajax()) {
            $image_path = $_SERVER['DOCUMENT_ROOT'] . "/upload/motel/" . $rq->id;
            if (\File::exists($image_path)) {
                \File::delete($image_path);
            }
        }
    }
}
