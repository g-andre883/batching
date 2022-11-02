<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Jobs\ProcessEmployees;
use Illuminate\Support\Facades\Bus;

class UploadController extends Controller
{
    // メインページビュー
    public function index()
    {
        return view('upload');
    }

    // upload process progress
    public function progress()
    {
        return view('progress');
    }


    public function uploadFileAndStoreInDatabase(Request $request)
    {
        try
        {
            if ($request->has('csvFile'))
            {
                $fileName = $request->csvFile->getClientOriginalName();
                $fileNamePath = public_path('uploads'). '/'.$fileName;

                if(!file_exists($fileNamePath))
                {
                    $request->csvFile->move(public_path('uploads'), $fileName);
                }

                $header = null;
                $dataFromcsv = array();
                $records = array_map('str_getcsv', file($fileNamePath));



                foreach($records as $record)
                {
                    if(!$header)
                    {
                        $header = $record;
                    }
                    else
                    {
                        $dataFromcsv[] = $record;
                    }
                }
                // Breakin data for example 10k

                $dataFromcsv = array_chunk($dataFromcsv, 300);
                Bus::batch([])->dispatch();
                $batch = Bus::batch([])->dispatch();

                foreach ($dataFromcsv as $index => $dataCsv)
                {
                    foreach($dataCsv as $data)
                    {
                        $employeeData[$index][] = array_combine($header, $data);
                    }
                    $batch->add(new ProcessEmployees($employeeData[$index]));
                    // ProcessEmployees::dispatch($employeeData[$index]);
                }
                // we update sesion id every time we process new batch
                session()->put('lastBatchId', $batch->id);

                return redirect('/progress?id='. $batch->id);

            }
        } catch (Exception $e)
        {
            Log::error($e);
            dd($e);

        }
    }
}
