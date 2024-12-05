@extends('layouts.app')

@section('title', 'Persetujuan')

@section('content')
<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-image: url('{{ asset('image/bg_PASTI1.png') }}');
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>
</head>
<body class="relative">
    <!-- Back Button -->
    <a href="{{ url()->previous()}}" class="absolute top-15 left-7 bg-teal-800 text-white p-2 rounded-full hover:bg-teal-700">
        <i class="fas fa-arrow-left text-xl"></i>
    </a>
    <div class="bg-white shadow-lg rounded-lg mx-auto max-w-7xl p-6 mt-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold text-teal-800 mb-4 text-center flex items-center justify-left space-x-2">
                <span>Status IRS Mahasiswa Perwalian</span>
            </h1>

            <!-- Tombol Setujui Semua -->
            <td class="pb-2 pt-2 text-right button-container">
                <div class="flex justify-end">
                    <button class="btn bg-teal-500 btn-icon-text p-2 rounded-lg">
                        <!-- <i class="fa fa-check mr-1 ml-1 text-white"></i> -->
                        <strong class="text-white">Setujui Semua</strong>
                    </button>
                </div>
            </td>
        </div>
        <div class="min-h-screen bg-white-800 py-2">
            <!-- Tambahkan kelas w-full agar tabel mengikuti lebar penuh -->
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
                    <thead style="background-color: #FADBA9;">
                        <tr class="text-black text-center">
                            <th class="font-semibold text-sm uppercase px-6 py-4"> Nama </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> NIM </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Semester </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Status </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4"> </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach ($mahasiswaperwalian as $mahasiswa)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="inline-flex w-10 h-10"> <img class='w-10 h-10 object-cover rounded-full' alt='User avatar' src="{{ asset('image/profil.png') }}" /> </div>
                                    <div>
                                        <p> {{ $mahasiswa->nama }} </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <p class=""> {{ $mahasiswa->nim }} </p>
                            </td>
                            <td class="px-6 py-4 text-center"> {{ $mahasiswa->smt }} </td>

                            <!-- yang ini masih boongan -->
                            <td class="px-6 py-4 text-center"> <span class="text-white text-sm w-1/3 pb-1 bg-yellow-600 px-2 rounded-full"> Belum Disetujui </span> </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('IRS_Mahasiswa', ['nim' => $mahasiswa->nim]) }}" 
                                class="text-teal-800 hover:underline">Lihat</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>
@endsection