@extends('layouts.admin')

@section('content')
<div x-data="{ openAdd: false, openEdit: false, openDelete: false, currContent: { id: '', judul: '', isi: '', status: '', thumbnail: '' } }">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-gray-900">Library</h2>
        <button @click="openAdd = true" class="flex items-center space-x-3 bg-[#41D3BD] hover:opacity-80 text-gray-800 px-6 py-3 rounded-2xl transition-all shadow-sm font-bold">
            <i class="fa-solid fa-plus text-xl"></i>
            <span>Add Content</span>
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-2xl font-bold border border-green-200">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 text-black font-medium text-lg rounded-tl-[2.5rem]">Thumbnail</th>
                    <th class="px-6 py-6 text-black font-medium text-lg">Judul Konten</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Penulis</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Status</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                        <span class="bg-white px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($contents as $content)
                <tr class="hover:bg-gray-50/50 transition-all text-black font-medium">
                    <td class="pl-20 py-6">
    <div class="w-20 h-14 bg-gray-100 rounded-xl flex items-center justify-center border border-gray-100 overflow-hidden">
        @if($content->thumbnail)
            <img src="{{ asset($content->thumbnail) }}" alt="thumb" class="w-full h-full object-cover">
        @else
            <i class="fa-solid fa-image text-gray-300 text-xl"></i>
        @endif
    </div>
</td>
                    <td class="px-6 py-6 font-bold uppercase truncate max-w-xs">{{ $content->judul }}</td>
                    <td class="px-6 py-6 text-center font-semibold">{{ $content->penulis->nama ?? 'Admin' }}</td>
                    <td class="px-6 py-6 text-center">
                        <span class="px-4 py-1 rounded-full font-bold text-xs uppercase
                            {{ $content->status == 'published' ? 'bg-green-100 text-green-700' : ($content->status == 'draft' ? 'bg-red-700 text-white' : 'bg-red-100 text-red-700') }}">
                            {{ $content->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-center relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown" class="text-blue-600 focus:outline-none"><i class="fa-solid fa-ellipsis text-3xl"></i></button>
                        <div x-show="dropdown" @click.away="dropdown = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border rounded-2xl shadow-xl z-[100] overflow-hidden text-left">
                            <button @click="currContent = { id: '{{ $content->id }}', judul: '{{ $content->judul }}', isi: `{{ $content->isi }}`, status: '{{ $content->status }}', thumbnail: '{{ $content->thumbnail }}' }; openEdit = true; dropdown = false"
                                    class="w-full px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3">
                                <i class="fa-solid fa-pen-to-square text-blue-500"></i><span class="font-bold">Update</span>
                            </button>
                            <button @click="currContent = { id: '{{ $content->id }}', judul: '{{ $content->judul }}' }; openDelete = true; dropdown = false"
                                    class="w-full px-5 py-3 text-sm hover:bg-red-50 flex items-center space-x-3 text-red-600 border-t">
                                <i class="fa-solid fa-trash"></i><span class="font-bold">Delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="h-6"></div>
    </div>

    <!-- MODAL ADD CONTENT -->
    <div x-show="openAdd" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-2xl w-full p-8 shadow-2xl overflow-y-auto max-h-[90vh]" @click.away="openAdd = false">
            <h3 class="text-2xl font-bold mb-6 text-gray-700">Add New Content</h3>
            <form action="{{ route('admin.library.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Judul Artikel</label><input name="judul" type="text" required class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full px-4 py-2 border rounded-xl outline-none">
                            <option value="draft">Draft</option><option value="published">Published</option><option value="archived">Archived</option>
                        </select>
                    </div>
                    <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Upload Thumbnail</label>
            <input name="thumbnail" type="file" accept="image/*" class="w-full px-4 py-1.5 border rounded-xl outline-none bg-gray-50 text-sm">
        </div>
                </div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Isi Artikel</label><textarea name="isi" rows="6" required class="w-full px-4 py-2 border rounded-xl outline-none"></textarea></div>
                <div class="flex justify-end space-x-3 pt-4 border-t"><button @click="openAdd = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold">Batal</button><button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold shadow-lg">Simpan Konten</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT CONTENT -->
    <div x-show="openEdit" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-2xl w-full p-8 shadow-2xl overflow-y-auto max-h-[90vh]" @click.away="openEdit = false">
            <h3 class="text-2xl font-bold mb-6 text-gray-700">Update Content</h3>
            <form :action="'/library/update/' + currContent.id" method="POST" class="space-y-4">
                @csrf @method('PUT')
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Judul Artikel</label><input name="judul" type="text" x-model="currContent.judul" required class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Status</label>
                        <select name="status" x-model="currContent.status" class="w-full px-4 py-2 border rounded-xl outline-none">
                            <option value="draft">Draft</option><option value="published">Published</option><option value="archived">Archived</option>
                        </select>
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Thumbnail Path</label><input name="thumbnail" type="text" x-model="currContent.thumbnail" class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                </div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Isi Artikel</label><textarea name="isi" rows="6" x-model="currContent.isi" required class="w-full px-4 py-2 border rounded-xl outline-none"></textarea></div>
                <div class="flex justify-end space-x-3 pt-4 border-t"><button @click="openEdit = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold">Batal</button><button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold">Simpan Perubahan</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL DELETE -->
    <div x-show="openDelete" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-sm w-full p-8 text-center shadow-2xl">
            <div class="text-red-500 text-6xl mb-4"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h3 class="text-xl font-bold mb-2">Hapus Artikel?</h3>
            <p class="text-gray-500 mb-6 text-center text-sm">Menghapus <span class="font-bold text-red-600" x-text="currContent.judul"></span> tidak dapat dibatalkan.</p>
            <form :action="'/library/delete/' + currContent.id" method="POST">
                @csrf @method('DELETE')
                <div class="flex justify-center space-x-3">
                    <button @click="openDelete = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-xl font-bold">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style> [x-cloak] { display: none !important; } </style>
@endsection
