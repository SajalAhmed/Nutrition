<?php

namespace App\Repository;

interface DashboardInterface
{
    public function getAnalytics($data);
    public function registerUserCount($data);
    public function trainedUserCount($data);
    public function quizTestPassUserCount($data);
    public function certificateDownloadUserCount($data);
}
