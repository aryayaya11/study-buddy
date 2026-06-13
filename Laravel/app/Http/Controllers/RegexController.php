<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegexController extends Controller
{
    public function index()
    {
        // Daftar regex pattern
        $patterns = [
            '^.*a$', '^[BJ].*', '^.{6}$', '^[^aeiouAEIOU].*', '.*n.*n.*',
            '^[A-M].*', '.*ra.*', '^[A-Za-z]{7,}$', '.*ng$'
        ];

        // Daftar kota Indonesia
        $cities = [
            "Jakarta","Surabaya","Bandung","Semarang","Yogyakarta","Solo",
            "Bogor","Bekasi","Depok","Tangerang","Cirebon","Malang",
            "Medan","Padang","Pekanbaru","Palembang","Banda Aceh","Jambi",
            "Pontianak","Banjarmasin","Balikpapan","Samarinda","Makassar",
            "Manado","Denpasar","Mataram","Kupang","Jayapura","Ambon",
        ];

        // Pilih challenge awal
        $pattern = collect($patterns)->random();
        $sampleCities = collect($cities)->random(10)->all();

        return view('Regex', [
            'pattern' => $pattern,
            'cities'  => $sampleCities,
            'score'   => session('score', 0), // skor awal
        ]);
    }

  public function check(Request $request)
{
    $pattern = $request->input('pattern');
    $cities = explode(',', $request->input('cities'));
    $answer = $request->input('answer'); // <-- ini string jawaban user

    $compiled = '/' . trim($pattern, '/') . '/';
    $correct = collect($cities)->filter(fn($c) => preg_match($compiled, $c))->values()->all();

    $userList = collect(explode(',', $answer))
        ->map(fn($a) => trim($a))
        ->filter()
        ->all();

    $isCorrect = empty(array_diff($userList, $correct)) && empty(array_diff($correct, $userList));

    // cari missing & extra
    $missing = array_diff($correct, $userList);
    $extra   = array_diff($userList, $correct);

    // Skor
    $score = session('score', 0);
    if ($isCorrect) {
        $score += 10;
    }
    session(['score' => $score]);

    // Challenge baru
    $patterns = [
        '^.*a$', '^[BJ].*', '^.{6}$', '^[^aeiouAEIOU].*', '.*n.*n.*',
        '^[A-M].*', '.*ra.*', '^[A-Za-z]{7,}$', '.*ng$'
    ];

    $citiesList = [
        "Jakarta","Surabaya","Bandung","Semarang","Yogyakarta","Solo",
        "Bogor","Bekasi","Depok","Tangerang","Cirebon","Malang",
        "Medan","Padang","Pekanbaru","Palembang","Banda Aceh","Jambi",
        "Pontianak","Banjarmasin","Balikpapan","Samarinda","Makassar",
        "Manado","Denpasar","Mataram","Kupang","Jayapura","Ambon",
    ];

    $newPattern = collect($patterns)->random();
    $newCities  = collect($citiesList)->random(10)->all();

    return view('Regex', [
        'pattern'   => $newPattern,
        'cities'    => $newCities,
        'answer'    => $userList,   // 🔹 kirim jawaban user
        'correct'   => $correct,
        'missing'   => $missing,
        'extra'     => $extra,
        'isCorrect' => $isCorrect,
        'score'     => $score,
    ]);
}

}