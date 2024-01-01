<?php

namespace App\Http\Controllers;

use App\hr;
use DateTime;
use App\grade;
use App\ratings;
use App\document;
use App\agreement;
use App\employees;
use App\evaluation;
use App\indicators;
use App\achievement;
use App\performance;
use App\perf_agreement;
use App\recommendation;
use App\perf_indicatorsAve;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PerformanceController extends Controller
{
    public function loginform()
    {
        return view('custom_auth.login');
    }

    public function logout()
    {

        Session::forget('user');

        return redirect('/')->with('success', 'Logged out successfully');
    }
    public function login(Request $request)
    {
        $data = $request->all();
        $Bdate = DateTime::createFromFormat('mdY', strval($data['Bdate']))->format('Y-m-d');
        $employee = employees::where('EmpNo', $data['EmpNo'])->where('Bdate', $Bdate)->first();

        if ($employee) {
            Session::put('user', $employee);
            return redirect('/index');
        }

        return back()->with('error', 'Invalid credentials');
    }


    public function index()
    {
        $user = Session::get('user')->EmpNo;
        $op = hr::where('Dept', 'OP')->where('Head_Tag', 1)->first();
        $vpfa = hr::where('Dept', 'VPFA')->where('Head_Tag', 1)->first();
        $vpar = hr::where('Dept', 'VPAR')->where('Head_Tag', 1)->first();
 
        if (Session::get('user')->hr->Head_Tag == 0) {
            $raters = hr::where('EmpNo', '<>', $user)->where('Dir_ID', Session::get('user')->hr->Dir_ID)->get();
        } elseif (Session::get('user')->hr->Head_Tag == 1) {
            $raters = hr::where('EmpNo', '<>', $user)->where('Dept_ID', '<>', Session::get('user')->hr->Dept_ID)->where('Dir_ID', Session::get('user')->hr->Dir_ID)->get();
        }
        $documents = document::get();
        $HRS = hr::get();
        $perf_ratee = performance::where('ratee_cid', $user)->get();
        $perf_rater = performance::where('rater_cid', $user)->get();
        $perf_hr = performance::all();
        return view('pages.index', compact('op', 'vpfa', 'vpar','raters', 'HRS', 'documents', 'perf_ratee', 'perf_rater', 'perf_hr'));
    }
    public function save_info(Request $request)
    {
        $data = $request->all();
        $user = Session::get('user');
        $ratee_cid = $user->EmpNo;
        $rater_cid = $data['rater'];
        $director_cid = $data['director'];
        $op_cid = $data['op'];
        $period_covered = $data['period_covered'];


        
        $doc_type = null; 
        $originalFilePath = null;

        if($user->hr->Head_Tag == 0 ) {
            $doc_type = '_Rank_';
            $originalFilePath = storage_path('app/public/rank.xls');
        }elseif($user->hr->Head_Tag == 1){
            $doc_type = '_Supervisory_';
            $originalFilePath = storage_path('app/public/supervisory.xls');
        }
      
        $newFileName = $ratee_cid .  $doc_type . now()->format('Ymd_His') . '.xls'; 
        $newFilePath = storage_path('app/public/pms/' . $newFileName);
        copy($originalFilePath, $newFilePath);

        $excel = IOFactory::load($newFilePath);
        $excel->getActiveSheet()->setCellValue('C6', $user->hr->Name);
        $writer = IOFactory::createWriter($excel, 'Xls');
        $writer->save($newFilePath);
        

        $performance = new performance();
        $performance->ratee_cid = $ratee_cid;
        $performance->rater_cid = $rater_cid;
        $performance->director_cid = $director_cid;
        $performance->op_cid = $op_cid;
        $performance->position = $user->hr->Position;
        $performance->period_cover = $period_covered;
        $performance->department = $user->hr->DeptName;
        $performance->doc_type = $user->hr->Head_Tag == 0 ? 1 : 2;
        $performance->filename = $newFileName;
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
        $needsImprovement = grade::where('cid', 1)->first();
        $goodPerformance = grade::where('cid', 2)->first();
        $satisfactoryPerformance = grade::where('cid', 3)->first();
        $excellentPerformance = grade::where('cid', 4)->first();

        return view('pages.instruction', compact('needsImprovement', 'goodPerformance', 'satisfactoryPerformance', 'excellentPerformance', 'performance_cid', 'ratee_cid'));
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
        $grade = grade::get();

        return view('pages.values_indicator', compact('grade', 'performance', 'performance_cid', 'ratee_cid'));
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

        $performance->ratee_overall_ave = $data['ratee_overall_ave'];
        $performance->rater_overall_ave = $data['rater_overall_ave'];
        $performance->final_ranking = $data['final_ranking'];
        $performance->save();

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
    public function editRank()
    {
        $indicators = indicators::where('doc_cid', 1)->orderBy('ord', 'asc')->get();
        return view('pages.editRank', compact('indicators'));
    }
    public function editSupervisory()
    {
        $indicators = indicators::where('doc_cid', 2)->orderBy('ord', 'asc')->get();
        return view('pages.editSupervisory', compact('indicators'));
    }

    public function getRankCriteria(Request $request)
    {
        $indicatorId = $request->input('indicator');

        $evaluationData = evaluation::where('ind_cid', $indicatorId)->orderBy('ord', 'asc')->get(['cid', 'criteria', 'remarks', 'ord']);


        return response()->json($evaluationData);
    }
    public function edit_Rankcriteria(Request $request)
    {
        $data = $request->all();
        $cids = $request->input('cids');
        $criteria = $request->input('criteria');
        $remarks = $request->input('remarks');
        $ord = $request->input('ord');

        if (isset($cids)) {
            foreach ($cids as $cid) {

                evaluation::where(['cid' => $cid])->update([
                    'criteria' => $criteria[$cid],
                    'remarks' => $remarks[$cid],
                    'ord' => $ord[$cid],

                ]);

            }
        }
        $indCIDs = $request->input('indCID');
        $newOrders = $request->input('newOrder');
        $newCriteria = $request->input('newCriteria');
        $newRemarks = $request->input('newRemarks');

        if (isset($indCIDs)) {
            foreach ($indCIDs as $index => $cid) {
                $evaluation = new evaluation();
                $evaluation->ind_cid = $cid;
                $evaluation->criteria = $newCriteria[$index];
                $evaluation->ord = $newOrders[$index];
                $evaluation->remarks = $newRemarks[$index];
                $evaluation->save();
            }
        }
        return back();

    }




    public function delete_criteria(Request $request)
    {
        $cid = $request->input('cid');
        try {
            $deleted = evaluation::where('cid', $cid)->delete();

            if ($deleted) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to delete the value.']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error occurred during the deletion.']);
        }
    }


    public function getRankValues(Request $request)
    {
        $indicators = indicators::where('doc_cid', 1)->orderBy('ord', 'asc')->get(['cid', 'value', 'percentage', 'critical_incident', 'ord']);

        return response()->json($indicators);
    }

    public function delete_value(Request $request)
    {
        $cid = $request->input('cid');
        try {
            $deleted = indicators::where('cid', $cid)->delete();

            if ($deleted) {
                evaluation::where('ind_cid', $cid)->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to delete the value.']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error occurred during the deletion.']);
        }
    }


    public function edit_Rankvalues(Request $request)
    {

        $data = $request->all();
        $cids = $request->input('cids');
        $values = $request->input('value');
        $percentages = $request->input('percentage');
        $critical_incident = $request->input('critical');
        $order = $request->input('ord');

        if ($cids) {
            foreach ($cids as $cid) {
                indicators::where(['cid' => $cid])->update([
                    'value' => $values[$cid],
                    'percentage' => $percentages[$cid],
                    'critical_incident' => $critical_incident[$cid],
                    'ord' => $order[$cid]
                ]);
            }
        }


        $newOrders = $request->input('newOrder');
        $newValue = $request->input('newValue');
        $newCritical = $request->input('newCritical');
        $newPercentage = $request->input('newPercentage');

        if (isset($newOrders)) {
            foreach ($newOrders as $index => $ord) {
                $indicator = new indicators();
                $indicator->doc_cid = 1;
                $indicator->value = $newValue[$index];
                $indicator->percentage = $newPercentage[$index];
                $indicator->critical_incident = $newCritical[$index];
                $indicator->ord = $ord;
                $indicator->save();
            }
        }

        return back();
    }


    public function edit_Supervalues(Request $request)
    {

        $data = $request->all();
        $cids = $request->input('cids');
        $values = $request->input('value');
        $percentages = $request->input('percentage');
        $critical_incident = $request->input('critical');
        $order = $request->input('ord');

        if ($cids) {
            foreach ($cids as $cid) {
                indicators::where(['cid' => $cid])->update([
                    'value' => $values[$cid],
                    'percentage' => $percentages[$cid],
                    'critical_incident' => $critical_incident[$cid],
                    'ord' => $order[$cid]
                ]);
            }
        }


        $newOrders = $request->input('newOrder');
        $newValue = $request->input('newValue');
        $newCritical = $request->input('newCritical');
        $newPercentage = $request->input('newPercentage');

        if (isset($newOrders)) {
            foreach ($newOrders as $index => $ord) {
                $indicator = new indicators();
                $indicator->doc_cid = 2;
                $indicator->value = $newValue[$index];
                $indicator->percentage = $newPercentage[$index];
                $indicator->critical_incident = $newCritical[$index];
                $indicator->ord = $ord;
                $indicator->save();
            }
        }

        return back();
    }

    public function edit_Supercriteria(Request $request)
    {
        $data = $request->all();
        $cids = $request->input('cids');
        $criteria = $request->input('criteria');
        $remarks = $request->input('remarks');
        $ord = $request->input('ord');

        if (isset($cids)) {
            foreach ($cids as $cid) {

                evaluation::where(['cid' => $cid])->update([
                    'criteria' => $criteria[$cid],
                    'remarks' => $remarks[$cid],
                    'ord' => $ord[$cid],

                ]);

            }
        }
        $indCIDs = $request->input('indCID');
        $newOrders = $request->input('newOrder');
        $newCriteria = $request->input('newCriteria');
        $newRemarks = $request->input('newRemarks');

        if (isset($indCIDs)) {
            foreach ($indCIDs as $index => $cid) {
                $evaluation = new evaluation();
                $evaluation->ind_cid = $cid;
                $evaluation->criteria = $newCriteria[$index];
                $evaluation->ord = $newOrders[$index];
                $evaluation->remarks = $newRemarks[$index];
                $evaluation->save();
            }
        }
        return back();

    }

    public function getSuperValues(Request $request)
    {
        $indicators = indicators::where('doc_cid', 2)->orderBy('ord', 'asc')->get(['cid', 'value', 'percentage', 'critical_incident', 'ord']);

        return response()->json($indicators);
    }


    public function getSuperCriteria(Request $request)
    {
        $indicatorId = $request->input('indicator');

        $evaluationData = evaluation::where('ind_cid', $indicatorId)->orderBy('ord', 'asc')->get(['cid', 'criteria', 'remarks', 'ord']);


        return response()->json($evaluationData);
    }



}