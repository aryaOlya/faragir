<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\Traits\SetPrice;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCourseRequest;
use App\Http\Requests\Api\V1\UpdateCourseRequest;
use App\Models\Course;
use App\Repositories\Mysql\Course\CourseRepository;
use App\Repositories\Mysql\Price\PriceRepository;
use Illuminate\Support\Facades\DB;

class CourseController extends ApiController
{
    use SetPrice;
    protected CourseRepository $courseRepository;
    protected PriceRepository $priceRepository;

    public function __construct(CourseRepository $courseRepository,PriceRepository $priceRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->priceRepository = $priceRepository;
    }

    public function index()
    {
        $courses = $this->courseRepository->getAll(["lessons","prices"]);

        return $this->success(200,$courses,"all the courses with their price & lessons");
    }


    public function store(StoreCourseRequest $request)
    {
        try {
            DB::beginTransaction();
            $course = $this->courseRepository->create(["name"=>$request->name]);

            if (!is_null($request->lesson_id))
                $this->courseRepository->sync($course->lessons(),$request->lesson_ids);

            $this->setPrice($course,$request->price);
            DB::commit();

            return $this->success(200,$course,"course ".$request->name." created successfully!");

        }catch (\Exception){
            DB::rollBack();
        }
    }


    public function update(UpdateCourseRequest $request, Course $course)
    {
        $model = $course->prices;
        $this->courseRepository->update($model,["price"=>$request->price]);

        return $this->success(200,$course,"course ".$request->name." updated successfully!");

    }


    public function destroy(Course $course)
    {
        try {
            DB::beginTransaction();

            $this->priceRepository->deleteMorph($course->prices());
            $this->courseRepository->delete($course);

            DB::commit();

            return $this->success(202,[],"course deleted successfully!");

        }catch (\Exception){
            DB::rollBack();
        }

    }
}
