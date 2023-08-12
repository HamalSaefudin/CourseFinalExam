<?php

namespace App\Charts;

use App\Models\Course;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ActiveCourseChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $course = Course::all();

        $activeCourse = $course->where('is_active', '=', 1)->count();
        $inActiveCourse = $course->where('role', '=', 0)->count();


        return $this->chart->pieChart()
            ->setTitle('User Distribution')
            ->addData([$activeCourse, $inActiveCourse])
            ->setLabels(['Active Course', 'InActive Course']);
    }
}
