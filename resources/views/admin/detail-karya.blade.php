<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Karya</title>

    <link rel="icon" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-5xl mx-auto py-10">

    <a href="{{ url('/admin/karya') }}"
       class="text-blue-600 hover:text-blue-800 font-semibold">

        ← Kembali ke Data Karya

    </a>

    <div class="bg-white rounded-xl shadow mt-5 overflow-hidden">

        <div class="bg-blue-600 text-white px-8 py-5">

            <h1 class="text-2xl font-bold">

                Detail Karya Siswa

            </h1>

            <p class="text-blue-100">

                Informasi lengkap project yang diupload siswa.

            </p>

        </div>

        <div class="p-8">

            <table class="w-full">

                <tbody class="divide-y">

                    <tr>
                        <td class="font-semibold py-4 w-52">
                            Nama Siswa
                        </td>

                        <td>
                            {{ $project->user->name }}
                        </td>
                    </tr>

                    <tr>

                        <td class="font-semibold py-4">
                            Judul Project
                        </td>

                        <td>

                            {{ $project->title }}

                        </td>

                    </tr>

                    <tr>

                        <td class="font-semibold py-4">
                            Kategori
                        </td>

                        <td>

                            {{ $project->category->name }}

                        </td>

                    </tr>

                    <tr>

                        <td class="font-semibold py-4">
                            Deskripsi
                        </td>

                        <td>

                            {{ $project->description }}

                        </td>

                    </tr>

                    <tr>

                        <td class="font-semibold py-4">
                            Link Project
                        </td>

                        <td>

@if($project->live_link)

<a href="{{ $project->live_link }}"
target="_blank"
class="text-blue-600 underline break-all">

{{ $project->live_link }}

</a>

@else

-

@endif

                        </td>

                    </tr>

                    <tr>

                        <td class="font-semibold py-4">
                            Status
                        </td>

                        <td>

@if($project->status=='pending')

<span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">

Menunggu Review

</span>

@elseif($project->status=='approved')

<span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

Disetujui

</span>

@else

<span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">

Ditolak

</span>

@endif

                        </td>

                    </tr>

                    <tr>

                        <td class="font-semibold py-4">
                            Upload
                        </td>

                        <td>

{{ $project->created_at->format('d F Y H:i') }}

                        </td>

                    </tr>

                </tbody>

            </table>

            @if($project->status=='pending')

<div class="mt-10 border-t pt-8">

<h2 class="text-xl font-bold mb-5">

Review Project

</h2>

<form
action="{{ url('/admin/karya/'.$project->id.'/update-status') }}"
method="POST">

@csrf
@method('PUT')

<label class="font-semibold">

Catatan Admin

</label>

<textarea
name="catatan"
rows="5"
class="w-full border rounded-lg mt-2 p-3"
placeholder="Tulis catatan untuk siswa..."></textarea>

<div class="flex gap-4 mt-6">

<button
name="status"
value="approved"
class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg">

✔ Approve

</button>

<button
name="status"
value="rejected"
class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg">

✖ Reject

</button>

</div>

</form>

</div>

@endif
@if($project->status!='pending')

<div class="mt-10 bg-gray-50 border rounded-lg p-6">

<h2 class="font-bold text-lg mb-3">

Hasil Review

</h2>

@if($project->status=='approved')

<p class="text-green-700">

<strong>Catatan :</strong>

{{ $project->approval_note ?? 'Tidak ada catatan.' }}

</p>

@else

<p class="text-red-700">

<strong>Alasan Penolakan :</strong>

{{ $project->rejection_reason }}

</p>

@endif

@if($project->reviewer)

<p class="text-sm text-gray-500 mt-3">

Direview oleh :

<b>{{ $project->reviewer->name }}</b>

</p>

@endif

</div>

@endif
        </div>
    </div>
</div>

</body>
</html>