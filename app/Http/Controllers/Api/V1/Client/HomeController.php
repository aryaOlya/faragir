<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\Mysql\Setting\SettingRepository;
use Illuminate\Http\Request;

class HomeController extends ApiController
{
    protected SettingRepository $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function index()
    {
        $settingInfo = $this->settingRepository->first();
        $info = json_decode($settingInfo->info);

        return $this->success(200,$info,"welcome");
    }
}
