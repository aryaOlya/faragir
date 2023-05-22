<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\CacheHelpers;
use App\Helpers\Traits\SetPrice;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreLessonRequest;
use App\Http\Requests\Api\V1\UpdateLessonRequest;
use App\Models\Lesson;
use App\Repositories\Mysql\Lesson\LessonRepository;
use App\Repositories\Mysql\Price\PriceRepository;
use Illuminate\Support\Facades\DB;

class LessonController extends ApiController
{

    use SetPrice;

    protected LessonRepository $lessonRepository;
    protected PriceRepository $priceRepository;

    public function __construct(LessonRepository $lessonRepository,PriceRepository $priceRepository)
    {
        $this->lessonRepository = $lessonRepository;
        $this->priceRepository = $priceRepository;
    }

    public function index()
    {

        //$lessons = $this->lessonRepository->getAll(["prices","courses"],[]);

        $lessons = CacheHelpers::getFromCache("all_lessons",function (){
            return $this->lessonRepository->getAll(["prices","courses"],[]);
        });

        return $this->success(200,$lessons,"all the lessons with their price & parent course!");
    }


    public function store(StoreLessonRequest $request)
    {

        try {
            DB::beginTransaction();
            $lesson = $this->lessonRepository->create(["name"=>$request->name]);

            $this->lessonRepository->attach($lesson->courses(),$request->course_id);

            $this->setPrice($lesson,$request->price);
            DB::commit();

            CacheHelpers::clearCache(["all_courses","all_lessons"]);

            return $this->success(200,$lesson,"lesson ".$request->name." created successfully!");

        }catch (\Exception){

            DB::rollBack();
        }
    }


//    public function update(UpdateLessonRequest $request, Lesson $lesson)
//    {
//        //
//    }
    public function destroy(Lesson $lesson)
    {
        try {
            DB::beginTransaction();

            $this->priceRepository->deleteMorph($lesson->prices());
            $this->lessonRepository->delete($lesson);

            DB::commit();

            CacheHelpers::clearCache(["all_courses","all_lessons"]);

            return $this->success(202,[],"lesson deleted successfully!");

        }catch (\Exception){
            DB::rollBack();
        }

    }
}
