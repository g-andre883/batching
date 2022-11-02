<?php

namespace App\Jobs;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;


class ProcessEmployees implements ShouldQueue
{
    use Batchable,Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $employeeData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($employeeData)
    {
        $this->employeeData = $employeeData;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->employeeData as $employeeData) 
        {
            $employee = new Employee();
            $employee->name = $employeeData['郡']. $employeeData['市区町村']. $employeeData['面積'];
            $employee->save();
        }
    }
}
