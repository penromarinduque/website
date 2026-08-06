<?php

namespace App\Http\Traits\Settings;

use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

trait SystemFileUploaderTrait
{

    public function profileUpload($request, $name, $filePath = null)
    {

        if ($request->hasFile($name)) {

            $Filesystem = new Filesystem;

            $profile = $request->file($name);

            $extension = $profile->getClientOriginalExtension();

            $filename = $this->fileName().'.'.$extension;
  
            if ($Filesystem->exists($filePath)) 
            {
                $Filesystem->delete([$filePath]);
            }

            $directory = public_path('web/images');

            $profile->move($directory, $filename);

            return 'web/images/'.$filename;

        }

    }

    public function fileName()
    {
        return Str::random(10);
    }

    public function my_file_checker($request)
    {

        $this->validate($request, [
            /* FILES */
            'file1' => 'mimes:'.$this->validatefile('D'),
            'file2' => 'mimes:'.$this->validatefile('D'),
            'file3' => 'mimes:'.$this->validatefile('D'),
            /* IMAGES */
            'image' => 'mimes:'.$this->validatefile('I'),
            'image1' => 'mimes:'.$this->validatefile('I'),
            'image2' => 'mimes:'.$this->validatefile('I'),
            'image3' => 'mimes:'.$this->validatefile('I'),
        ]);

    }

    public function validatefile($type)
    {
        $getarray = app('SystemFileExtension')->where('file_type', $type)->where('status', '1')->get();

        return implode(",", Arr::pluck($getarray, 'file_extension'));
    }
    
}
