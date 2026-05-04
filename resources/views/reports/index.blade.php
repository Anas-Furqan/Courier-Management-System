@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8 flex justify-between items-center" style="background: linear-gradient(to right, #F59E0B, #F97316); box-shadow: 8px 8px 0 #000;">
        <div>
            <h1 class="text-4xl font-black mb-2">Generated Reports</h1>
            <p class="text-lg font-bold">View and download all generated reports.</p>
        </div>
        <a href="{{ route(auth()->user()->isAdmin() ? 'admin.reports.create' : 'agent.reports.create') }}" class="neo-btn bg-black text-white px-6 py-3" style="border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000;">+ Generate</a>
    </div>

    <!-- Reports Table -->
    <div class="border-4 border-black bg-white" style="box-shadow: 8px 8px 0 #000;">
        <div class="text-white border-b-4 border-black p-6" style="background-color: #F59E0B;">
            <h2 class="text-2xl font-black">All Reports ({{ count($reports ?? []) }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-4 border-black bg-gray-200">
                        <th class="px-6 py-4 text-left font-black">Type</th>
                        <th class="px-6 py-4 text-left font-black">Downloads</th>
                        <th class="px-6 py-4 text-left font-black">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports ?? [] as $report)
                        <tr class="border-b-2 border-black hover:bg-gray-100">
                            <td class="px-6 py-4 font-bold">{{ $report->report_type }}</td>
                            <td class="px-6 py-4 font-bold">{{ $report->download_count }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route(auth()->user()->isAdmin() ? 'admin.reports.download' : 'agent.reports.download', $report->id) }}" class="px-3 py-1 bg-orange-400 border-2 border-black font-bold text-sm">Download</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center font-bold">No reports yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection