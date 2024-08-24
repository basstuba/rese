<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AssessmentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Assessment;

class AssessmentController extends Controller
{
    public function assessment($shopId) {
        $user = Auth::user();
        $shop = Shop::withUserFavorites($user)->find($shopId);

        return view('assessment.create', compact('shop'));
    }

    public function assessmentCreate(AssessmentRequest $request) {
        $user = Auth::user();
        $assessment = $request->only('shop_id', 'count', 'assessment_comment');
        $assessment['user_id'] = $user['id'];

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
        $userAssessment = Assessment::where('user_id', $user['id'])->where('shop_id', $shop['id'])->first();

        return view('assessment.update', compact('shop', 'userAssessment'));
    }

    public function assessmentUpdate(AssessmentRequest $request) {
        $user = Auth::user();
        $assessment = $request->only('shop_id', 'count', 'assessment_comment');
        $assessment['user_id'] = $user['id'];

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
