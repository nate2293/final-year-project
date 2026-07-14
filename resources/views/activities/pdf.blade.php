<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Activity Report</title>
</head>
<body class="bg-white text-slate-900">
    <div class="p-6">
        <div class="mb-5">
            <h1 class="text-2xl font-bold">Student Activity Report</h1>
        </div>

        <div class="mb-5 text-sm">
            <p class="mb-1"><span style="font-weight: 700;">Student:</span> {{ $user->name }}</p>
            <p class="mb-1"><span style="font-weight: 700;">Email:</span> {{ $user->email }}</p>
            <p><span style="font-weight: 700;">Date:</span> {{ now()->format('F j, Y g:i A') }}</p>
        </div>
        
        {{--  --}}
        <table class="table-auto w-full text-xs" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="border: 1px solid #cbd5e1; padding: 8px; text-align: left;">Company</th>
                    <th style="border: 1px solid #cbd5e1; padding: 8px; text-align: left;">Opportunity</th>
                    <th style="border: 1px solid #cbd5e1; padding: 8px; text-align: left;">Status</th>
                    <th style="border: 1px solid #cbd5e1; padding: 8px; text-align: left;">Date</th>
                    <th style="border: 1px solid #cbd5e1; padding: 8px; text-align: left;">Notes</th>
                    <th style="border: 1px solid #cbd5e1; padding: 8px; text-align: left;">Evidence</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($activities as $activity)
                    <tr>
                        <td style="border: 1px solid #cbd5e1; padding: 8px; vertical-align: top;">
                            {{ $activity->opportunity?->company?->company_name ?? '—' }}
                        </td>

                        <td style="border: 1px solid #cbd5e1; padding: 8px; vertical-align: top;">
                            {{ $activity->opportunity?->job_title ?? '—' }}
                        </td>

                        <td style="border: 1px solid #cbd5e1; padding: 8px; vertical-align: top;">
                            {{ $activity->activity_type?->name ?? (string) $activity->activity_type }}
                        </td>

                        <td style="border: 1px solid #cbd5e1; padding: 8px; vertical-align: top; white-space: nowrap;">
                            {{ $activity->activity_date ? ($activity->activity_date)->format('M j, Y') : '—' }}
                        </td>

                        <td style="border: 1px solid #cbd5e1; padding: 8px; vertical-align: top;">
                            {{ $activity->notes ?? '—' }}
                        </td>

                        <td style="border: 1px solid #cbd5e1; padding: 8px; vertical-align: top; word-break: break-word;">
                            @if ($activity->evidence_link)
                                {{ $activity->evidence_link }}
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="border: 1px solid #cbd5e1; padding: 10px; text-align: center;">
                            No activities found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>