@extends('layouts.app')

@section('content')
<div class="space-y-6" data-reveal>
    <div class="hero-panel">
        <div>
            <p class="section-kicker">Reports</p>
            <h1 class="mt-3 text-4xl font-black text-white">Generated reports</h1>
        </div>
        <a href="{{ route(auth()->user()->isAdmin() ? 'admin.reports.create' : 'agent.reports.create') }}" class="btn-primary">Generate</a>
    </div>

    <div class="glass-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.25em] text-slate-400">
                    <tr>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Downloads</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($reports as $report)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 text-white">{{ $report->report_type }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $report->download_count }}</td>
                            <td class="px-6 py-4"><a href="{{ route(auth()->user()->isAdmin() ? 'admin.reports.download' : 'agent.reports.download', $report->id) }}" class="text-cyan-300 hover:text-cyan-200">Download</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-6 py-10 text-center text-slate-400">No reports yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection