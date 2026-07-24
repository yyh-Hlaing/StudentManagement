<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin - Student List</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 p-6">

<div class="max-w-6xl mx-auto my-8">
    
    <!-- Top Action Bar -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Recycle Bin</h1>
        </div>
        
        <a href="{{ route('students.index') }}" class="bg-slate-700 text-white px-4 py-2 rounded-lg hover:bg-slate-800 transition text-sm">
            ← Back to Student List
        </a>
    </div>

    <!-- Success Flash Message -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs font-semibold text-slate-600 uppercase">
                    <th class="p-4">Image</th>
                    <th class="p-4">Name</th>
                    <th class="p-4">Roll No</th>
                    <th class="p-4">Class</th>
                    <th class="p-4">Deleted At</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                @forelse($students as $student)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4">
                            @if($student->image)
                                <img src="{{ asset('storage/' . $student->image) }}" class="w-10 h-10 rounded-full object-cover opacity-60">
                            @else
                                <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-500">
                                    No Img
                                </div>
                            @endif
                        </td>
                        <td class="p-4 font-medium text-slate-900">{{ $student->name }}</td>
                        <td class="p-4">{{ $student->roll_no }}</td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-semibold">
                                {{ $student->classRoom->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="p-4 text-xs text-slate-400">
                            {{ $student->deleted_at->diffForHumans() }}
                        </td>
                        <td class="p-4 text-center space-x-2">
                            <!-- Restore Button -->
                            <form action="{{ route('students.restore', $student->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-emerald-50 text-emerald-600 hover:bg-emerald-100 px-3 py-1.5 rounded-md text-xs font-semibold transition">
                                    Restore
                                </button>
                            </form>

                            <!-- Permanent Delete Button -->
                            <form action="{{ route('students.forceDelete', $student->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you confirm?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded-md text-xs font-semibold transition">
                                    Delete Permanently
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">
                            No Trash yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="p-4 border-t border-slate-100">
            {{ $students->links() }}
        </div>
    </div>
</div>

</body>
</html>