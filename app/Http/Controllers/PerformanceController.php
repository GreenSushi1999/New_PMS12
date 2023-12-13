<?php

namespace App\Http\Controllers;

use App\hr;
use App\grade;
use App\ratings;
use App\document;
use App\indicators;
use App\performance;
use App\perf_indicatorsAve;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        // $rater_empNo = Auth::user()->EmpNo;
        $rater_empNo = 23014;
        $documents = document::get();
        $HRS = hr::get();
        $performance = performance::where('rater_cid', $rater_empNo)->get();
        return view('pages.index', compact('documents', 'HRS', 'performance'));
    }
    public function save_info(Request $request)
    {
        $data = $request->all();
        // $ratee_cid = Auth::user()->EmpNo;
        $ratee_cid = 23014;
        $rater_cid = $data['rater'];
        $director_cid = $data['director'];
        $op_cid = $data['op'];
        $position = $data['position'];
        $period_covered = $data['period_covered'];
        $department = $data['department'];
        $doc_type = $data['doc_type'];


        $performance = new performance();
        $performance->ratee_cid = $ratee_cid;
        $performance->rater_cid = $rater_cid;
        $performance->director_cid = $director_cid;
        $performance->op_cid = $op_cid;
        $performance->position = $position;
        $performance->period_cover = $period_covered;
        $performance->department = $department;
        $performance->doc_type = $doc_type;
        $performance->save();

        $performance_cid = $performance->cid;
        return redirect('instruction/' . $performance_cid . '/' . $ratee_cid);
    }

    public function instruction($performance_cid, $ratee_cid)
    {
        $grades = grade::get();
        return view('pages.instruction', compact('grades', 'performance_cid', 'ratee_cid'));
    }

    public function values(Request $request)
    {

        $data = $request->all();
        $performance_cid = $data['performance_cid'];
        $ratee_cid = $data['ratee_cid'];
        return redirect('values-indicator/' . $performance_cid . '/' . $ratee_cid);
    }

    public function values_indicator($performance_cid, $ratee_cid)
    {

        $performance = performance::where('cid', $performance_cid)->first();
        return view('pages.values_indicator', compact('performance', 'performance_cid', 'ratee_cid'));
    }


    public function save_ratings(Request $request)
    {
        $data = $request->all();
        $perf_cid = $data['performance_cid'];
        $performance = performance::where('cid', $perf_cid)->first();
        $ratings = ratings::where('perf_cid', $perf_cid)->get();

        foreach ($performance->document->indicators as $perf_ind) {

            foreach ($perf_ind->evaluation as $eval) {
                if ($ratings->isEmpty()) {
                    foreach ($performance->ratings as $perf_rate) {
                        if ($perf_rate->eval_cid == $eval->cid) {
                            $perf_rate->ratee_rate = ($data['ratee' . $eval->cid] == null ? '' : $data['ratee' . $eval->cid]);
                            $perf_rate->rater_rate = ($data['rater' . $eval->cid] == null ? '' : $data['rater' . $eval->cid]);
                            $perf_rate->rater_rate = ($data['rater' . $eval->cid] == null ? '' : $data['rater' . $eval->cid]);
                            if ($eval->remarks == 1) {
                                $perf_rate->remarks = ($data['remarks' . $eval->cid] == null ? '' : $data['remarks' . $eval->cid]);
                            }
                            $perf_rate->save();
                        }
                    }
                } else {
                    $ratings = new ratings();
                    $ratings->perf_cid = $perf_cid;
                    $ratings->eval_cid = $eval->cid;
                    $ratings->ratee_rate = ($data['ratee' . $eval->cid] == null ? '' : $data['ratee' . $eval->cid]);
                    $ratings->rater_rate = ($data['rater' . $eval->cid] == null ? '' : $data['rater' . $eval->cid]);
                    $ratings->rater_rate = ($data['rater' . $eval->cid] == null ? '' : $data['rater' . $eval->cid]);
                    if ($eval->remarks == 1) {
                        $ratings->remarks = ($data['remarks' . $eval->cid] == null ? '' : $data['remarks' . $eval->cid]);
                    }
                    $ratings->save();

                }
            }
        }
    }


}


