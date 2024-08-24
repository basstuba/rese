<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AssessmentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Evaluation;
use App\Models\Assessment;

class AssessmentController extends Controller
{
    public function assessment($shopId) {
        $user = Auth::user();
        $shop = Shop::withUserFavorites($user)->find($shopId);
        $evaluations = Evaluation::all();

        return view('assessment.create', compact('shop', 'evaluations'));
    }

    public function assessmentCreate(AssessmentRequest $request) {
        $user = Auth::user();
        $evaluation = Evaluation::find($request->evaluation_id);
        $assessment = $request->only('shop_id', 'assessment_comment');
        $assessment['user_id'] = $user['id'];
        $assessment['evaluate'] = $evaluation['star'];
        $assessment['count'] = $evaluation['count'];

        if(!empty($request->imagePhoto)) {
            $dir = 'image';
            $fileName = $request->file('imagePhoto')->getClientOriginalName();
            $request->file('imagePhoto')->storeAs('public/' . $dir, $fileName);

            $assessment['photo_url'] = 'storage/' . $dir . '/' . $fileName;
        }else{
            $assessment['photo_url'] = null;
        }

        Assessment::create($assessment);

        return redirect()->route('detail', ['shop' => $request->shop_id]);
    }

    public function assessmentEdit($shopId) {
        $user = Auth::user();
        $shop = Shop::withUserFavorites($user)->find($shopId);
        $evaluations = Evaluation::all();
        $userAssessment = Assessment::where('user_id', $user['id'])->where('shop_id', $shop['id'])->first();
        $userEvaluation = Evaluation::where('count', $userAssessment['count'])->first();

        return view('assessment.update', compact('shop', 'evaluations', 'userAssessment', 'userEvaluation'));
    }

    public function assessmentUpdate(AssessmentRequest $request) {
        $user = Auth::user();
        $evaluation = Evaluation::find($request->evaluation_id);
        $assessment = $request->only('shop_id', 'assessment_comment');
        $assessment['user_id'] = $user['id'];
        $assessment['evaluate'] = $evaluation['star'];
        $assessment['count'] = $evaluation['count'];

        if(!empty($request->imagePhoto)) {
            $dir = 'image';
            $fileName = $request->file('imagePhoto')->getClientOriginalName();
            $request->file('imagePhoto')->storeAs('public/' . $dir, $fileName);

            $assessment['photo_url'] = 'storage/' . $dir . '/' . $fileName;
        }else{
            $assessment['photo_url'] = null;
        }

        Assessment::find($request->assessment_id)->update($assessment);

        return redirect()->route('detail', ['shop' => $request->shop_id]);
    }

    public function assessmentDelete(Request $request) {
        Assessment::find($request->assessmentId)->delete();

        return redirect()->route('detail', ['shop' => $request->shop_id]);
    }
}
