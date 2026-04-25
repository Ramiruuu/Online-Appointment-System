<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Notifications\AppointmentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $search = $request->input('search');

        $appointments = Appointment::with(['user', 'service'])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($startDate, fn ($query) => $query->whereDate('appointment_date', '>=', $startDate))
            ->when($endDate, fn ($query) => $query->whereDate('appointment_date', '<=', $endDate))
            ->when($search, function ($query, $search) {
                $query->whereHas('user', fn ($builder) => $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                );
            })
            ->orderBy('appointment_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.appointments.index', [
            'appointments' => $appointments,
            'status' => $status,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'search' => $search,
        ]);
    }

    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show', [
            'appointment' => $appointment->load('user', 'service'),
        ]);
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => ['required', Rule::in(['pending', 'confirmed', 'completed', 'cancelled'])],
            'cancellation_reason' => ['nullable', 'required_if:status,cancelled', 'string', 'max:1000'],
        ]);

        DB::beginTransaction();

        try {
            $appointment->update([
                'status' => $request->input('status'),
                'cancellation_reason' => $request->input('status') === 'cancelled'
                    ? $request->input('cancellation_reason')
                    : $appointment->cancellation_reason,
            ]);

            $appointment->load('user', 'service');
            $appointment->user->notify(new AppointmentNotification($appointment, 'status'));

            DB::commit();

            return back()->with('success', 'Appointment status updated successfully.');
        } catch (\Throwable $exception) {
            DB::rollBack();

            return back()->with('error', 'Unable to update appointment status. Please try again.');
        }
    }
}
