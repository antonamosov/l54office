<?php

namespace App\Http\Controllers\Api;

use App\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function get(Exam $exam)
    {
        return response()->json([
            'price' => $exam->price,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $examsInputArr = json_decode($request->input('exams'));
            if(!is_array($examsInputArr)) {
                return response()->json([
                    'success' => true,
                    'exams' => [],
                    'total_sum' => 0,
                    'total_sum_without_vat' => 0
                ]);
            }
            $exams = Exam::whereIn('id' ,$examsInputArr)->get();
            $examsArr = [];
            $totalSum = 0;
            $title = '';
                foreach($exams as $exam) {
                    $examsArr[$exam->id] = [
                        'title' => $exam->summaryTitlePriceAtTheEnd(),
                        'price' => '€' . $exam->price,
                        'price_without_vat' => '€' . ($exam->price - $exam->price * 0.22),
                    ];
                    $title .= $exam->summaryTitlePriceAtTheEnd() . "<br>";
                    $totalSum += $exam->price;
                }

            $response = [
                'success' => true,
                'exams' => $examsArr,
                'total_sum' => round($totalSum, 2),
                'total_sum_without_vat' => round($totalSum - $totalSum * 0.22, 2)
            ];

            return response()->json($response);
        }
        catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function summaryTitle(Exam $exam)
    {
        return response()->json([
            'title' => $exam->summaryTitle(),
        ]);
    }

    public function totalPrice(Exam $exam)
    {
        return response()->json($exam->price);
    }

    public function price(Exam $exam)
    {
        return response()->json($exam->price  - ($exam->price * 0.22));
    }
}
