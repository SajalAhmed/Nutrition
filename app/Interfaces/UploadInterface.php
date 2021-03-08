<?php

namespace App\Interfaces;

interface UploadInterface
{
    public function upload();
    public function download($data);
}
