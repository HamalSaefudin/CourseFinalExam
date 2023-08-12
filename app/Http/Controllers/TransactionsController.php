<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\DetailTransactions;
use App\Models\Instructor;
use App\Models\Qualifications;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'user') {
            $list_transaksi = Transactions::where('user_id', Auth::user()->id)->latest()->get();
            $list_detail_transaction = collect($list_transaksi)->map(function ($item) {
                $qualification = DetailTransactions::where('transaction_id', $item->id)->first();
                if ($qualification) {
                    $course = Course::find($qualification->course_id);
                    $instructor = Instructor::find($qualification->instructor_id);

                    if ($course && $instructor) {
                        return [
                            'id' => $item->id,
                            'customer_name' => $item->customer_name,
                            'total' => $item->total,
                            'course_name' => $course->course_name,
                            'instructor_name' => $instructor->instructor_name,
                        ];
                    }
                }
                return null;
            })->filter()->values();
            return view('transactions.user', compact('list_detail_transaction'));
        }

        $list_transaksi = Transactions::all();
        $list_detail_transaction = collect($list_transaksi)->map(function ($item) {
            $qualification = DetailTransactions::where('transaction_id', $item->id)->first();
            if ($qualification) {
                $course = Course::find($qualification->course_id);
                $instructor = Instructor::find($qualification->instructor_id);

                if ($course && $instructor) {
                    return [
                        'id' => $item->id,
                        'customer_name' => $item->customer_name,
                        'total' => $item->total,
                        'course_name' => $course->course_name,
                        'instructor_name' => $instructor->instructor_name,
                        'membership' => $item->membership
                    ];
                }
            }
            return null;
        })->filter()->values();
        return view('transactions.user', compact('list_detail_transaction'));
    }

    private function getSale(string $level, int $price)
    {
        switch ($level) {
            case 'silver':
                return $price * 5 / 100;
            case 'gold':
                return  $price * 10 / 100;
            case 'platinum':
                return $price * 15 / 100;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'membership' => 'required|in:gold,silver,platinum',
            'qualification_id' => 'required|string',
            'course_id' => 'required|string',
            'harga' => 'required|integer',
        ]);

        $validate['discount'] = $this->getSale($validate['membership'], $validate['harga']);
        $validate['customer_name'] = Auth::user()->nama;
        $validate['transaction_code'] = Str::uuid()->toString();
        $validate['transaction_date'] = now();
        $validate['user_id'] = Auth::user()->id;
        $validate['subtotal'] = $validate['harga'];
        $validate['total'] = $validate['harga'] - $this->getSale($validate['membership'], $validate['harga']);

        $trx = Transactions::create($validate);

        $qualification = Qualifications::where('id', $validate['qualification_id'])->first();

        $detailTrx = DetailTransactions::create([
            'transaction_id' => $trx->id,
            'course_id' => $validate['course_id'],
            'instructor_id' => $qualification->instructor_id,
            'start_date' => now(),
            'price' => $validate['harga'],
            'discount' => $validate['discount']
        ]);

        if ($trx && $detailTrx) {
            return redirect(route('transactions.index'))->with('success', 'Berhasil enroll course');
        }
        return back()->with('error', 'Gagal enroll course, coba lagi dalam beberapa menit');
    }
}
