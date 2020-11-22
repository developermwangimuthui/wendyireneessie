<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Http\Resources\PaymentResource;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Yajra\Datatables\Datatables;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //pending is 0
        //completed is 1

        $user = Auth::user();
        $payment_history = Payment::where('user_id', $user->id)->get();
        $history = PaymentResource::collection($payment_history);

        return response([
            'error' => false,
            'message' => '',
            'payment_history' => $history,
        ], Response::HTTP_OK);
    }
    public function webIndex(Request $request)
    {
        if ($request->ajax()) {
            $all_payments = Payment::join('users','users.id','=','payments.user_id')
            ->select([
                'payments.id as id',
                'amount',
                'firstname',
                'lastname',
                'user_id',
                'phone',
                'status',
                'payments.updated_at',
            ])->get();
            return Datatables::of($all_payments)
                ->addIndexColumn()

                ->rawColumns(['action'])
                ->make(true);
        }

       return view('admin.payments.index');
    }
    public function pending(Request $request)
    {
        if ($request->ajax()) {
            $all_payments = Payment::join('users','users.id','=','payments.user_id')->where('payments.status', 0)
            ->select([
                'payments.id as id',
                'amount',
                'firstname',
                'lastname',
                'user_id',
                'phone',
                'status',
                'payments.updated_at',
            ])->get();
            return Datatables::of($all_payments)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<form action="../../payment/approve" method="post">

                    <input class="form-control" type="text" id="unique_code" required name="unique_code"/>
                    <input class="form-control" type="hidden" required name="payment_id" value="' . $data->id . '"/>
                    <input class="form-control" type="hidden" required name="_token" value="'.csrf_token().'"/>
                    <button class="btn btn-outline-danger btn-round waves-effect waves-light  type="submit"><i class="icon-money"></i>Pay</button>&nbsp;&nbsp;
                    </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.payments.pending');
    }
    public function complete(Request $request)
    {
        if ($request->ajax()) {
            $all_payments = Payment::join('users','users.id','=','payments.user_id')->where('payments.status', 1)
            ->select([
                'payments.id as id',
                'amount',
                'firstname',
                'lastname',
                'user_id',
                'phone',
                'status',
                'payments.updated_at',
            ])->get();
            return Datatables::of($all_payments)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.payments.completed');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
            $payment_id = $request->payment_id;
            $unique_code = $request->unique_code;
    $payment = Payment::where('id',$payment_id);
    if ($payment) {
    Payment::where('id',$payment_id)->update([
            'unique_code'=>$unique_code,
            'status'=>'1',
        ]);
        return redirect()->back()->with('success','Payment Updated Succesfully');
    } else {
        return redirect()->back()->with('error','Payment not Updated Succesfully');


    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
