<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm font-semibold text-gray-500">Welcome back,</div>
                    <div class="mt-2 text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</div>
                    <div class="mt-4 text-sm text-gray-600">Your appointment dashboard gives you a quick overview of upcoming bookings.</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm font-semibold text-gray-500">Total Appointments</div>
                    <div class="mt-3 text-3xl font-bold text-indigo-600">{{ $totalAppointments }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm font-semibold text-gray-500">Upcoming Appointments</div>
                    <div class="mt-3 text-3xl font-bold text-green-600">{{ $upcomingAppointments }}</div>
                </div>
            </div>

            <div class="mt-6 grid gap-4 lg:grid-cols-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                    <div class="mt-4 space-y-3">
                        <a href="{{ route('appointments.create') }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Book Appointment</a>
                        <a href="{{ route('appointments.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">View My Appointments</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.appointments.index') }}" class="inline-flex items-center justify-center rounded-md bg-gray-800 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-900">Admin Panel</a>
                        @endif
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Need Help?</h3>
                    <p class="mt-3 text-sm text-gray-600">If you have questions about your booking, contact support or manage your profile from the top navigation.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
