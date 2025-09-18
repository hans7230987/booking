<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Court;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'court_id' => 'required|exists:courts,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        // 檢查同一球場是否已有衝突預約
        $exists = Booking::where('court_id', $request->court_id)
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_time', [$request->start_time, $request->end_time]) // 已有預約的開始時間落在新預約區間內
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]) // 已有預約的結束時間落在新預約區間內
                    ->orWhere(function ($q2) use ($request) { //已有預約完全覆蓋新預約
                        $q2->where('start_time', '<', $request->start_time)
                            ->where('end_time', '>', $request->end_time);
                    });
            })->exists();

        if ($exists) {
            return back()->with('error', '該時間段已被預約');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'court_id' => $request->court_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->back()->with('success', '預約成功！');
    }

    public function myBookings()
    {
        // 取得目前登入使用者的所有預約
        $bookings = auth()->user()->bookings()->with('venue')->get();

        return view('bookings.my_bookings', compact('bookings'));
    }
    
    public function cancel(Booking $booking)
    {
        // 確認是自己的預約才可取消
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->delete();

        return redirect()->route('my.bookings')->with('success', '預約已取消');
    }
}
