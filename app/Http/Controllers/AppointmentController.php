<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Notifications\AppointmentNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function create()
    {
        return view('appointments.create', [
            'services' => Service::active()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => ['required', 'integer', Rule::exists('services', 'id')->where(fn ($query) => $query->where('is_active', true))],
            'appointment_date' => ['required', 'date', 'after:now'],
        ]);

        $appointmentDate = Carbon::parse($request->appointment_date);
        $user = Auth::user();

        $hasConflict = Appointment::where('user_id', $user->id)
            ->where('status', '!=', 'cancelled')
            ->whereBetween('appointment_date', [$appointmentDate->copy()->subMinutes(30), $appointmentDate->copy()->addMinutes(30)])
            ->exists();

        if ($hasConflict) {
            return back()->withInput()->withErrors(['appointment_date' => 'You already have an appointment within 30 minutes of the selected time.']);
        }

        DB::beginTransaction();

        try {
            $appointment = Appointment::create([
                'user_id' => $user->id,
                'service_id' => $request->service_id,
                'appointment_date' => $appointmentDate,
                'status' => 'pending',
            ]);

            $appointment->load('service', 'user');
            $user->notify(new AppointmentNotification($appointment, 'booking'));

            DB::commit();

            return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully. A confirmation email has been sent.');
        } catch (\Throwable $exception) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Unable to book the appointment at this time. Please try again later.');
        }
    }

    public function index()
    {
        $user = Auth::user();

        return view('appointments.index', [
            'upcoming' => $user->appointments()->upcoming()->with('service')->orderBy('appointment_date')->get(),
            'past' => $user->appointments()->past()->with('service')->orderByDesc('appointment_date')->get(),
        ]);
    }

    public function show(Appointment $appointment)
    {
        abort_if($appointment->user_id !== Auth::id(), 403);

        return view('appointments.show', [
            'appointment' => $appointment->load('service', 'user'),
        ]);
    }

    public function cancel(Request $request, Appointment $appointment)
    {
        abort_if($appointment->user_id !== Auth::id(), 403);

        if (! in_array($appointment->status, ['pending', 'confirmed']) || $appointment->appointment_date->isPast()) {
            return back()->with('error', 'This appointment cannot be cancelled.');
        }

        $request->validate([
            'cancellation_reason' => ['required', 'string', 'max:1000'],
        ]);

        DB::beginTransaction();

        try {
            $appointment->update([
                'status' => 'cancelled',
                'cancellation_reason' => $request->input('cancellation_reason'),
            ]);

            $appointment->load('service', 'user');
            $appointment->user->notify(new AppointmentNotification($appointment, 'cancelled'));

            DB::commit();

            return redirect()->route('appointments.index')->with('success', 'Appointment cancelled successfully.');
        } catch (\Throwable $exception) {
            DB::rollBack();

            return back()->with('error', 'Unable to cancel the appointment at this time. Please try again later.');
        }
    }
}
