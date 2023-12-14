@extends('layouts.template')

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Halaman Dashboard
            </h2>
            <!-- With avatar -->
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Tabel Nilai Kerja
            </h4>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama User</th>
                                <th class="px-4 py-3">Bulan</th>
                                <th class="px-4 py-3">Jumlah Jam Kerja/Total Jam Kerja</th>
                                <th class="px-4 py-3">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <?php $no = 1 ?>
                            @foreach ($groupedWorklogs as $group)
                                <?php $user = App\Models\User::find($group->user_id); ?>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm">
                                            {{ $no++ }}
                                        </td>
                                        <td class="px-4 py-3 text-xs">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-4 py-3 text-xs">
                                            {{ date('F Y', strtotime($group->year . '-' . $group->month . '-01')) }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $group->total_hours }} / 176 Jam
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <?php $nilai = ($group->total_hours)/176 ?>
                                            @if ($nilai > 1)
                                                1
                                            @else
                                                {{ $nilai }}
                                            @endif
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
