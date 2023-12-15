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
        return view('pages.index', compact('HRS', 'documents', 'performance'));
    }
    public function save_info(Request $request)
    {
        $data = $request->all();

        $ratee_cid = 23014;
        // $rater_cid = 23014;
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
        $performance = performance::where('cid', $data['performance_cid'])->first();

        foreach ($performance->indicators as $perfInd) {

            $indicatorsAveExist = perf_indicatorsAve::where('perf_cid', $data['performance_cid'])->where('ind_cid', $perfInd->cid)->first();


            if ($indicatorsAveExist) {
                $indicatorsAveExist->ratee_ave = $data['ratee_ave' . $perfInd->cid] == null ? null : $data['ratee_ave' . $perfInd->cid];
                $indicatorsAveExist->rater_ave = $data['rater_ave' . $perfInd->cid] == null ? null : $data['rater_ave' . $perfInd->cid];
                if ($perfInd->critical_incident == 1) {
                    $indicatorsAveExist->critical_incident = $data['critical_incident' . $perfInd->cid] == null ? '' : $data['critical_incident' . $perfInd->cid];
                }
                $indicatorsAveExist->save();
            } else {
                $indicatorsAve = new perf_indicatorsAve();
                $indicatorsAve->ind_cid = $perfInd->cid;
                $indicatorsAve->perf_cid = $data['performance_cid'];
                $indicatorsAve->ratee_ave = $data['ratee_ave' . $perfInd->cid] == null ? null : $data['ratee_ave' . $perfInd->cid];
                $indicatorsAve->rater_ave = $data['rater_ave' . $perfInd->cid] == null ? null : $data['rater_ave' . $perfInd->cid];
                if ($perfInd->critical_incident == 1) {
                    $indicatorsAve->critical_incident = $data['critical_incident' . $perfInd->cid] == null ? '' : $data['critical_incident' . $perfInd->cid];
                }
                $indicatorsAve->save();
            }
            foreach ($perfInd->evaluation as $eval) {
                $ratingsExist = ratings::where('perf_cid', $data['performance_cid'])->where('eval_cid', $eval->cid)->first();

                if ($ratingsExist) {
                    $ratingsExist->ratee_rate = $data['ratee' . $eval->cid] == null ? null : $data['ratee' . $eval->cid];
                    $ratingsExist->rater_rate = $data['rater' . $eval->cid] == null ? null : $data['rater' . $eval->cid];
                    if ($eval->remarks == 1) {
                        $ratingsExist->remarks = $data['remarks' . $eval->cid] == null ? '' : $data['remarks' . $eval->cid];
                    }
                    $ratingsExist->save();

                } else {
                    $new_ratings = new ratings();
                    $new_ratings->perf_cid = $data['performance_cid'];
                    $new_ratings->eval_cid = $eval->cid;
                    $new_ratings->ratee_rate = $data['ratee' . $eval->cid] == null ? null : $data['ratee' . $eval->cid];
                    $new_ratings->rater_rate = $data['rater' . $eval->cid] == null ? null : $data['rater' . $eval->cid];
                    if ($eval->remarks == 1) {
                        $new_ratings->remarks = $data['remarks' . $eval->cid] == null ? '' : $data['remarks' . $eval->cid];
                    }
                    $new_ratings->save();

                }
            }
        }
    }
}


