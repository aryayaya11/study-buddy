<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index()
    {
         // Student facts: Number of registrants for each subject
        $registrantsDataRaw = DB::table('fact_pendaftaran_siswa_sb')
            ->join('dim_mapel_sb', 'fact_pendaftaran_siswa_sb.sk_mapel', '=', 'dim_mapel_sb.sk_mapel')
            ->join('dim_siswa_sb', 'fact_pendaftaran_siswa_sb.sk_siswa', '=', 'dim_siswa_sb.sk_siswa')
            ->select(
                'dim_mapel_sb.nama_mapel as subject_name',
                DB::raw("CASE 
                            WHEN dim_siswa_sb.jenjang LIKE 'sd%' THEN 'sd'
                            WHEN dim_siswa_sb.jenjang LIKE 'smp%' THEN 'smp'
                            WHEN dim_siswa_sb.jenjang LIKE 'sma%' THEN 'sma'
                            ELSE 'lainnya' 
                         END as level"),
                DB::raw('SUM(fact_pendaftaran_siswa_sb.jumlah_pendaftaran) as registrants')
            )
            ->groupBy('subject_name', 'level')
            ->orderBy('subject_name')
            ->orderBy('level')
            ->get();

        // Pivot the data for easier consumption by Chart.js
        $pivotedData = [];
        foreach ($registrantsDataRaw as $row) {
            $pivotedData[$row->subject_name][strtolower($row->level)] = $row->registrants;
        }

        $subjects = array_keys($pivotedData);
        $levels = ['sd', 'smp', 'sma'];
        $levelColors = ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(75, 192, 192, 0.5)'];

        $registrantsPerSubject = [
            'labels' => $subjects,
            'datasets' => collect($levels)->map(function ($level, $index) use ($subjects, $pivotedData, $levelColors) {
                return [
                    'label' => strtoupper($level),
                    'data' => collect($subjects)->map(function ($subject) use ($level, $pivotedData) {
                        return $pivotedData[$subject][$level] ?? 0;
                    })->all(),
                    'backgroundColor' => $levelColors[$index],
                ];
            })->all(),
        ];

        // Insight 1: Tutor Growth Over Time
        $tutorGrowth = DB::table('fact_tutor_sb')
            ->join('dim_waktu', 'fact_tutor_sb.sk_waktu', '=', 'dim_waktu.sk_waktu')
            ->select(
                DB::raw("CONCAT(dim_waktu.tahun, '-', LPAD(dim_waktu.bulan_ke, 2, '0')) as term"),
                DB::raw('SUM(fact_tutor_sb.jumlah_tutor) as tutor_count')
            )
            ->groupBy('term')
            ->orderBy('term', 'asc')
            ->get();

        // Insight 2: Tutor Count per Subject
        $tutorsPerSubject = DB::table('dim_mapel_sb')
            ->leftJoin('fact_tutor_sb', 'dim_mapel_sb.sk_mapel', '=', 'fact_tutor_sb.sk_mapel')
            ->select('dim_mapel_sb.nama_mapel as subject_name', DB::raw('COALESCE(SUM(fact_tutor_sb.jumlah_tutor), 0) as tutor_count'))
            ->groupBy('dim_mapel_sb.nama_mapel')
            ->orderBy('tutor_count', 'desc')
            ->get();

        // Income fact: Income per subject
        $incomePerSubject = DB::table('fact_pendapatan_sb')
            ->join('dim_mapel_sb', 'fact_pendapatan_sb.sk_mapel', '=', 'dim_mapel_sb.sk_mapel')
            ->select('dim_mapel_sb.nama_mapel as name', DB::raw('SUM(fact_pendapatan_sb.pendapatan) as income'))
            ->groupBy('dim_mapel_sb.nama_mapel')
            ->orderBy('income', 'desc')
            ->get();

        // Income fact: Income per term
        $incomePerTerm = DB::table('fact_pendapatan_sb')
            ->join('dim_waktu', 'fact_pendapatan_sb.sk_waktu', '=', 'dim_waktu.sk_waktu')
            ->select(
                DB::raw("CONCAT(dim_waktu.tahun, '-', LPAD(dim_waktu.bulan_ke, 2, '0')) as term"),
                DB::raw('SUM(fact_pendapatan_sb.pendapatan) as income')
            )
            ->groupBy('term')
            ->orderBy('term', 'asc')
            ->get();

        return view('admin.statistics', compact('registrantsPerSubject', 'incomePerSubject', 'incomePerTerm', 'tutorGrowth', 'tutorsPerSubject'));
    }

    /**
     * Get student details for a specific subject.
     */
    public function getRegistrantsBySubject($subjectName)
    {
        $students = DB::table('fact_pendaftaran_siswa_sb')
            ->join('dim_siswa_sb', 'fact_pendaftaran_siswa_sb.sk_siswa', '=', 'dim_siswa_sb.sk_siswa')
            ->join('dim_mapel_sb', 'fact_pendaftaran_siswa_sb.sk_mapel', '=', 'dim_mapel_sb.sk_mapel')
            ->where('dim_mapel_sb.nama_mapel', $subjectName)
            ->select('dim_siswa_sb.nama', 'dim_siswa_sb.jenis_kelamin', 'dim_siswa_sb.jenjang')
            ->distinct()
            ->get();

        return response()->json($students);
    }
}