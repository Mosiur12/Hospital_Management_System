<?php

namespace App\Http\Controllers\instructor;


use App\Category;

use App\Http\Controllers\Controller;
use App\Wallet;
use App\Withdraw;
use App\WithdrawHistory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $availableWithdraws = 0;
        $id = Auth::user()->id;
        $withdraws = Withdraw::where('user_id', $id)->orderByDesc('id')->get();
        $totalWithdraws = Withdraw::where('user_id', $id)->where('status', '0')->orderByDesc('id')->get();
        $wallet = Wallet::where('user_id', $id)->first();

        foreach ($totalWithdraws as $Withdraws)
        {
            $availableWithdraws += $Withdraws->withdraw;
        }

        $availableWithdraws = $wallet->available - $availableWithdraws;
        $data['availableWithdraws'] = $availableWithdraws;

        return view('instructor.withdraw.index', compact('withdraws', 'wallet'), $data);
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
        $request->validate([
            'bank_name' => 'required',
            'account_no' => 'required',
            'amount' => 'required',
        ]);

        $availableWithdraws = 0;
        $id = Auth::user()->id;

        $totalWithdraws = Withdraw::where('user_id', $id)->where('status', '0')->orderByDesc('id')->get();
        $wallet = Wallet::where('user_id', $id)->first();

        foreach ($totalWithdraws as $Withdraws)
        {
            $availableWithdraws += $Withdraws->withdraw;
        }
        $availableWithdraws = $wallet->available - $availableWithdraws;

        if ($request->amount > $availableWithdraws or $request->amount < 10)
        {
            Toastr::error('Sorry, failed to Withdraw request Because, you limit cross', 'fail');
            return redirect()->back();
        }



        $withdraw = new Withdraw();
        $withdraw->user_id = $id;
        $withdraw->withdraw = $request->amount;
        $withdraw->status = "0";

        if($withdraw->save())
        {
            $data = new WithdrawHistory();
            $data->withdraw_id = $withdraw->id;
            $data->user_id = $id;
            $data->bank_name = $request->bank_name;
            $data->account_no = $request->account_no;
            $data->amount = $request->amount;
            $data->save();
        }


        Toastr::success('Withdraw request successfully create', 'Success');
        return redirect()->route('instructor.withdraws.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function show(Withdraw $withdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdraw $withdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdraw $withdraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdraw $withdraw)
    {
        //
    }
}
