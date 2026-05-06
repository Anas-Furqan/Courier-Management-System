@extends('layouts.app')

@section('page-title', 'Reports')

@section('content')
<div class="space-y-8">

    {{-- Hero --}}
    <div class="page-hero bg-orange-400 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-black mb-1">Generated Reports</h1>
            <p class="font-bold text-black/70">View and download all generated shipment reports.</p>
        </div>
        <a href="{{ route(auth()->user()->isAdmin() ? 'admin.reports.create' : 'agent.reports.create') }}"
           class="neo-btn bg-black text-white flex-shrink-0">+ Generate</a>
    </div>

    {{-- Reports Table --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-orange-500 text-white border-b-4 border-black">
            <h2 class="text-2xl font-black">All Reports ({{ count($reports ?? []) }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="neo-table">
                <thead>
                    <tr>
                        <th>Report Type</th>
                        <th>Downloads</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports ?? [] as $report)
                        <tr>
                            <td class="font-black capitalize">{{ str_replace('_',' ',$report->report_type) }}</td>
                            <td>{{ $report->download_count }}</td>
                            <td>
                                <a href="{{ route(auth()->user()->isAdmin() ? 'admin.reports.download' : 'agent.reports.download', $report->id) }}"
                                   class="neo-btn-sm bg-orange-400 text-black">Download</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-12 text-gray-500">No reports yet. Generate your first report.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
