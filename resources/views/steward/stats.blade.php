@extends('steward.layout')

@section('steward-content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Statistics</h1>
    <p class="text-gray-600">Overview of zone activity</p>
</div>

<div class="grid grid-cols-1 gap-6">
    <!-- Events Over Time -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Events Over Time</h3>
        <canvas id="eventsOverTimeChart" class="w-full" style="max-height: 400px;"></canvas>
    </div>

    <!-- Activity by User -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Activity by User</h3>
        <canvas id="activityByUserChart" class="w-full" style="max-height: 400px;"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Events Over Time Chart
        const eventsOverTimeCtx = document.getElementById('eventsOverTimeChart').getContext('2d');
        const eventsOverTimeData = @json($eventsOverTime);
        
        new Chart(eventsOverTimeCtx, {
            type: 'line',
            data: {
                labels: Object.keys(eventsOverTimeData),
                datasets: [{
                    label: 'Number of Events',
                    data: Object.values(eventsOverTimeData),
                    borderColor: 'rgb(59, 130, 246)',
                    tension: 0.1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Activity by User Chart
        const activityByUserCtx = document.getElementById('activityByUserChart').getContext('2d');
        const activityByUserData = @json($activityByUser);
        const userLabels = Object.keys(activityByUserData);
        const onData = userLabels.map(user => activityByUserData[user].on);
        const offData = userLabels.map(user => activityByUserData[user].off);

        new Chart(activityByUserCtx, {
            type: 'bar',
            data: {
                labels: userLabels,
                datasets: [
                    {
                        label: 'ON',
                        data: onData,
                        backgroundColor: 'rgba(34, 197, 94, 0.6)',
                        borderColor: 'rgb(34, 197, 94)',
                        borderWidth: 1
                    },
                    {
                        label: 'OFF',
                        data: offData,
                        backgroundColor: 'rgba(239, 68, 68, 0.6)',
                        borderColor: 'rgb(239, 68, 68)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                         ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
