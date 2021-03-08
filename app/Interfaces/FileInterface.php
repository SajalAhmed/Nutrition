<?php

namespace App\Interfaces;

interface FileInterface
{
    public function upload();
    public function download($data);
    public function generate($data);
}
