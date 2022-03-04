<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DynamicTableController extends Controller
{
    public function index() {
        $tableData = $this->getDynamicTableData();
        //echo '<pre>', print_r($tableData);die;;
        return view('dynamic-table', compact('tableData'));
    }

    private function getDynamicTableData() {
        return [
            [
                'title' => 'Raptas Soft INC.',
                'branches' => [
                    ['title' => 'US', 'staffs' => ['Joe', 'David', 'Bella', 'Taylor', 'Phillip']],
                    ['title' => 'Dhaka', 'staffs' => ['Rani', 'Ibrahim', 'Al Amin', 'Rajib']],
                    ['title' => 'UK', 'staffs' => ['Russell', 'Peter', 'Kevin']]
                ]
            ],
            [
                'title' => 'Getweb INC.',
                'branches' => [
                    ['title' => 'Khulna', 'staffs' => ['Mizan', 'Rajib', 'Rubel', 'Sami']],
                    ['title' => 'Chittagong', 'staffs' => ['Shams', 'Tanvir', 'Roni', 'Mahin', 'Farid', 'Saiful']]
                ]
            ],
        ];
    }

    private function getDynamicTableData2() {
        return [
            'Raptas Soft INC.' => [
                'US' => ['Joe', 'David', 'Bella', 'Taylor', 'Phillip'],
                'Dhaka' => ['Rani', 'Ibrahim', 'Al Amin', 'Rajib'],
                'UK' => ['Russell', 'Peter', 'Kevin']
            ],
            'Getweb INC.' => [
                'Dhaka' => ['Mizan', 'Rajib', 'Rubel', 'Sami'],
                'Chittagong' => ['Shams', 'Tanvir', 'Roni', 'Mahin', 'Farid', 'Saiful']
            ]
        ];
    }
}
