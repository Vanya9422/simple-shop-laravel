<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    /**
     * @param array $files
     * @return void
     */
    public function uploadFile(array $files) : void
    {
        $fileName = static::FILENAME;
        $path = storage_path("app/public/{$fileName}");

        if (!is_dir($path)) {
            Storage::makeDirectory($path);
        }

        collect($files)->each(function ($file, $key) use ($path, $fileName) {
            if ($file){
                $imageName = getRandom(14) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $imageName);
                $array = ['url' => "{$fileName}/$imageName"];
                if ($key === 'general'){
                    $array['is_primary'] = true;
                    $generalImage = $this->generalImage()->exists();
                    if ($generalImage){
                        $this->generalImage()->update(['is_primary' => false]);
                    }
                }
                $this->images()->create($array);
            }
        });
    }

}
