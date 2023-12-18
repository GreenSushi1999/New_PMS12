<?php

namespace App\Http\Controllers;

use App\hr;
use App\grade;
use App\ratings;
use App\document;
use App\agreement;
use App\employees;
use App\indicators;
use App\achievement;
use App\performance;
use App\perf_agreement;
use App\recommendation;
use App\perf_indicatorsAve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceController extends Controller
{

    public function index()
    {

        // $rater_empNo = Auth::user()->EmpNo;
        $rater_empNo = 23014;
        $documents = document::get();
        $HRS = hr::get();
        $performance = performance::where('ratee_cid', $rater_empNo)->get();
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


        $agreements = agreement::get();
        $perf_agreement = perf_agreement::find($performance->cid);

        foreach ($agreements as $agreement) {
            if (!$perf_agreement) {
                $perf_agree = new perf_agreement();
                $perf_agree->perf_cid = $performance->cid;
                $perf_agree->agr_cid = $agreement->cid;
                $perf_agree->tick = null;
                $perf_agree->save();
            }
        }

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

        return redirect('achievements/' . $performance->cid . '/' . $performance->ratee_cid);
    }

    public function achievements($performance_cid, $ratee_cid)
    {


        $performance = performance::where('cid', $performance_cid)->first();

        return view('pages.achievement', compact('performance'));
    }




    public function add_achievement(Request $request)
    {
        $data = $request->all();
        $newAchievement = new achievement();
        $newAchievement->perf_cid = $data['addPerf_cid'];
        $newAchievement->achievement = $data['addAchievement'];
        $newAchievement->save();
        return back();
    }

    public function delete_achievement(Request $request)
    {
        try {
            $cid = $request->input('cid');
            achievement::where('cid', $cid)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function update_achievement(Request $request)
    {
        try {
            $request->validate([
                'cid' => 'required|numeric',
                'achievement' => 'required|string|max:255',
            ]);

            $cid = $request->input('cid');
            $achievementText = $request->input('achievement');

            achievement::where('cid', $cid)->update(['achievement' => $achievementText]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateAndNext(Request $request)
    {
        $data = $request->all();
        $performance = performance::where('cid', $data['performance_cid'])->first();

        $request->validate([
            'achievements.*' => 'required|string|max:255',
        ]);

        $achievements = $request->input('achievements');

        if ($achievements) {
            foreach ($achievements as $cid => $achievementText) {
                achievement::where(['perf_cid' => $performance->cid, 'cid' => $cid])
                    ->update(['achievement' => $achievementText]);
            }
        }

        return redirect('recommendations/' . $performance->cid . '/' . $performance->ratee_cid);
    }

    public function recommendations($performance_cid, $ratee_cid)
    {


        $performance = performance::where('cid', $performance_cid)->first();

        return view('pages.recommendations', compact('performance'));
    }
    public function add_recommendation(Request $request)
    {
        $data = $request->all();
        $newRecommendation = new recommendation();
        $newRecommendation->perf_cid = $data['addPerf_cid'];
        $newRecommendation->for_improvement = $data['addForImprovement'];
        $newRecommendation->action_plan = $data['addActionPlan'];
        $newRecommendation->save();
        return back();
    }



    public function delete_recommendation(Request $request)
    {
        try {
            $cid = $request->input('cid');
            recommendation::where('cid', $cid)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function update_recommendation(Request $request)
    {
        try {
            $request->validate([
                'cid' => 'required|numeric',
                'for_improvement' => 'required|string|max:255',
                'action_plan' => 'required|string|max:255',
            ]);

            $cid = $request->input('cid');
            $for_improvement = $request->input('for_improvement');
            $action_plan = $request->input('action_plan');

            recommendation::where('cid', $cid)->update(['for_improvement' => $for_improvement, 'action_plan' => $action_plan]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateRecAndNext(Request $request)
    {
        $data = $request->all();
        $performance = performance::where('cid', $data['performance_cid'])->first();

        $request->validate([
            'for_improvement.*' => 'required|string|max:255',
            'action_plan.*' => 'required|string|max:255',
        ]);

        $for_improvement = $request->input('for_improvement');
        $action_plan = $request->input('action_plan');

        if ($for_improvement || $action_plan) {
            foreach ($for_improvement as $cid => $improvement) {
                recommendation::where(['perf_cid' => $performance->cid, 'cid' => $cid])
                    ->update(['for_improvement' => $improvement]);
            }
            foreach ($action_plan as $cid => $plan) {
                recommendation::where(['perf_cid' => $performance->cid, 'cid' => $cid])
                    ->update(['action_plan' => $plan]);
            }
        }


        return redirect('agreement/' . $performance->cid . '/' . $performance->ratee_cid);
    }

    public function agreement($performance_cid, $ratee_cid)
    {

        $performance = performance::where('cid', $performance_cid)->first();
        $agreement = agreement::get();
        return view('pages.agreement', compact('agreement', 'performance'));
    }
    public function save_perfagreement(Request $request)
    {
        $data = $request->validate([
            'performance_cid' => 'required',
            'perf_agree.*' => 'nullable|in:1,2',
        ]);

        $performance = Performance::where('cid', $data['performance_cid'])->firstOrFail();

        if (isset($data['perf_agree'])) {
            foreach ($data['perf_agree'] as $cid => $tick) {
                perf_agreement::where(['perf_cid' => $performance->cid, 'agr_cid' => $cid])->update(['tick' => $tick]);
            }
        }
        return back();
    }

}