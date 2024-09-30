<?php

namespace App\Controllers;

class ImageUpload extends BaseController
{
    public function index()
    {
        return view('upload_form');
    }

    public function upload()
    {
        // Validate the request method
        if ($this->request->getMethod() === 'post') {
            // Get the uploaded file
            $file = $this->request->getFile('image');

            // Check if the file is valid and has not been moved
            if ($file->isValid() && !$file->hasMoved()) {
                // Move the uploaded file to the 'uploads' directory
                $file->move('uploads');

                // Store the file name in the session
                session()->set('uploaded_image', $file->getName());

                // Redirect to the view page
                return redirect()->to('/image-view');
            } else {
                // Redirect back with an error message if upload fails
                return redirect()->back()->with('error', 'Failed to upload image.');
            }
        }
    }

    public function view()
    {
        // Get the image name from the session
        $data['image'] = session()->get('uploaded_image');
        return view('image_display', $data);
    }
}
