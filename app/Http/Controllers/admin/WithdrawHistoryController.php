<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Wallet;
use App\Withdraw;
use App\WithdrawHistory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class WithdrawHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function request()
    {
        $withdrawRequests = WithdrawHistory::where('status', '0')->get();
        //return $withdrawRequests;
        return view('admin.withdraw.request', compact('withdrawRequests'));
    }

    public function history()
    {
        $withdrawRequests = WithdrawHistory::where('status', '1')->get();
        return view('admin.withdraw.history', compact('withdrawRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\WithdrawHistory  $withdrawHistory
     * @return \Illuminate\Http\Response
     */
    public function show(WithdrawHistory $withdrawHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WithdrawHistory  $withdrawHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(WithdrawHistory $withdrawHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WithdrawHistory  $withdrawHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $withdrow = Withdraw::where('user_id', $request->user_id)->first();
        $withdrow->status = "1";
        $withdrow->update();

        $walet = Wallet::where('user_id', $request->user_id)->first();
        $walet->available = $walet->available - $request->amount;
        $walet->update();

        $withdrawHistory = WithdrawHistory::where('id', $id)->first();
        $withdrawHistory->status = "1";
        $withdrawHistory->update();

        Toastr::success('Withdraw request successfully Approved', 'Success');
        return redirect()->route('admin.withdraw.request');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WithdrawHistory  $withdrawHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(WithdrawHistory $withdrawHistory)
    {
        //
    }
}
