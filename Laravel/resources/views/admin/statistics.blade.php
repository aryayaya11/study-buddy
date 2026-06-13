@extends('layouts.app_admin')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight text-gray-800">Dashboard Statistik</h2>
        </div>
        <div class="my-5">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Registrants per Subject -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-blue-200">
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Jumlah Pendaftar per Mata Pelajaran</h3>
                    <canvas id="registrantsChart"></canvas>
                </div>

                <!-- Details Table Placeholder -->
                <div id="registrants-details-container" class="hidden md:col-span-2 bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
                    <h3 id="details-title" class="text-xl font-bold text-gray-800 mb-4"></h3>
                    <div id="details-table" class="overflow-x-auto"></div>
                </div>

                <!-- Income per Subject -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-green-200">
                    <h3 class="text-xl font-bold text-green-900 mb-4">Pendapatan per Mata Pelajaran</h3>
                    <canvas id="incomeSubjectChart"></canvas>
                </div>

                <!-- Tutor Growth Chart -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-red-200">
                    <h3 class="text-xl font-bold text-red-900 mb-4">Pertumbuhan Jumlah Tutor</h3>
                    <canvas id="tutorGrowthChart"></canvas>
                </div>

                <!-- Tutors per Subject Chart -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-indigo-200">
                    <h3 class="text-xl font-bold text-indigo-900 mb-4">Jumlah Tutor per Mata Pelajaran</h3>
                    <canvas id="tutorsPerSubjectChart"></canvas>
                </div>

                <!-- Income per Term -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-purple-200 md:col-span-2">
                    <h3 class="text-xl font-bold text-purple-900 mb-4">Pendapatan per Bulan</h3>
                    <canvas id="incomeTermChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data from controller
        const registrantsData = @json($registrantsPerSubject);
        const incomeSubjectData = @json($incomePerSubject);
        const incomeTermData = @json($incomePerTerm);
        const tutorGrowthData = @json($tutorGrowth);
        const tutorsPerSubjectData = @json($tutorsPerSubject);

        // Registrants per Subject Chart
        const registrantsCtx = document.getElementById('registrantsChart').getContext('2d');
        new Chart(registrantsCtx, {
            type: 'bar',
            data: {
                labels: registrantsData.labels,
                datasets: registrantsData.datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                onClick: (event, elements) => {
                    if (elements.length > 0) {
                        const chartElement = elements[0];
                        const index = chartElement.index;
                        const subjectName = registrantsData.labels[index];
                        fetchRegistrantDetails(subjectName);
                    }
                }
            }
        });

        // Income per Subject Chart
        const incomeSubjectCtx = document.getElementById('incomeSubjectChart').getContext('2d');
        new Chart(incomeSubjectCtx, {
            type: 'pie',
            data: {
                labels: incomeSubjectData.map(d => d.name),
                datasets: [{
                    label: 'Pendapatan',
                    data: incomeSubjectData.map(d => d.income),
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.5)',
                        'rgba(245, 158, 11, 0.5)',
                        'rgba(239, 68, 68, 0.5)',
                        'rgba(139, 92, 246, 0.5)',
                        'rgba(236, 72, 153, 0.5)',
                    ],
                    borderColor: [
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(139, 92, 246, 1)',
                        'rgba(236, 72, 153, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });

        // Income per Term Chart
        const incomeTermCtx = document.getElementById('incomeTermChart').getContext('2d');
        new Chart(incomeTermCtx, {
            type: 'line',
            data: {
                labels: incomeTermData.map(d => d.term),
                datasets: [{
                    label: 'Pendapatan Bulanan',
                    data: incomeTermData.map(d => d.income),
                    backgroundColor: 'rgba(139, 92, 246, 0.2)',
                    borderColor: 'rgba(139, 92, 246, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Tutor Growth Chart
        const tutorGrowthCtx = document.getElementById('tutorGrowthChart').getContext('2d');
        new Chart(tutorGrowthCtx, {
            type: 'line',
            data: {
                labels: tutorGrowthData.map(d => d.term),
                datasets: [{
                    label: 'Jumlah Tutor Baru',
                    data: tutorGrowthData.map(d => d.tutor_count),
                    backgroundColor: 'rgba(239, 68, 68, 0.2)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });

        // Tutors per Subject Chart
        const tutorsPerSubjectCtx = document.getElementById('tutorsPerSubjectChart').getContext('2d');
        new Chart(tutorsPerSubjectCtx, {
            type: 'bar',
            data: {
                labels: tutorsPerSubjectData.map(d => d.subject_name),
                datasets: [{
                    label: 'Jumlah Tutor',
                    data: tutorsPerSubjectData.map(d => d.tutor_count),
                    backgroundColor: 'rgba(99, 102, 241, 0.5)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // This makes the bar chart horizontal
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });

        function fetchRegistrantDetails(subjectName) {
            const container = document.getElementById('registrants-details-container');
            const titleEl = document.getElementById('details-title');
            const tableEl = document.getElementById('details-table');

            titleEl.textContent = `Memuat detail untuk ${subjectName}...`;
            container.classList.remove('hidden');
            tableEl.innerHTML = '';

            fetch(`/admin/statistics/registrants/${encodeURIComponent(subjectName)}`)
                .then(response => response.json())
                .then(data => {
                    titleEl.textContent = `Detail Pendaftar: ${subjectName}`;

                    if (data.length === 0) {
                        tableEl.innerHTML = '<p class="text-gray-500">Tidak ada data pendaftar untuk mata pelajaran ini.</p>';
                        return;
                    }

                    let tableHTML = '<table class="min-w-full leading-normal"><thead><tr>' +
                        '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Siswa</th>' +
                        '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>' +
                        '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenjang</th>' +
                        '</tr></thead><tbody>';

                    data.forEach(student => {
                        tableHTML += `<tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${student.nama}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${student.jenis_kelamin}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${student.jenjang}</td>
                        </tr>`;
                    });

                    tableHTML += '</tbody></table>';
                    tableEl.innerHTML = tableHTML;
                });
        }
    });
</script>
@endsection