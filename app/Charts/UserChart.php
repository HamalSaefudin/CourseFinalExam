<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UserChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $users = User::all();

        $adminCount = $users->where('role', '=', 'admin')->count();
        $userCount = $users->where('role', '=', 'user')->count();

        $data = [
            'Admin' => $adminCount,
            'User' => $userCount,
        ];

        return $this->chart->pieChart()
            ->setTitle('User Distribution')
            ->addData([$adminCount, $userCount])
            ->setLabels(['Admin', 'User']);
    }
}
