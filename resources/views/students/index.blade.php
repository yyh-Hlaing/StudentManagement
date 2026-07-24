<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 p-6">

<div class="max-w-6xl mx-auto my-8">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-slate-800">Student Lists</h1>
        <a href="{{ route('students.trash') }}" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-2 rounded-lg transition text-sm flex items-center gap-1.5">
            🗑️ Recycle Bin
        </a>
        <a href="{{ route('students.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Add New Student
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('students.index') }}" method="GET" class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            
            <!-- Search Input -->
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1">Search</label>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Name, Roll No, Email..." 
                       class="w-full p-2.5 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Class Filter Dropdown -->
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1">Filter by Class</label>
                <select name="class_room_id" class="w-full p-2.5 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Classes</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_room_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-slate-800 text-white p-2.5 rounded-lg text-sm font-medium hover:bg-slate-700 transition">
                    Filter
                </button>
                
                @if(request('search') || request('class_room_id'))
                    <a href="{{ route('students.index') }}" class="px-4 py-2.5 border border-slate-300 text-slate-600 rounded-lg text-sm hover:bg-slate-50 transition">
                        Reset
                    </a>
                @endif
            </div>

        </div>
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs font-semibold text-slate-600 uppercase">
                    <th class="p-4">Image</th>
                    <th class="p-4">Name</th>
                    <th class="p-4">Roll No</th>
                    <th class="p-4">Class</th>
                    <th class="p-4">Email</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                @forelse($students as $student)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4">
                            @if($student->image)
                                <img src="{{ asset('storage/' . $student->image) }}" class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-500">
                                    No Img
                                </div>
                            @endif
                        </td>
                        <td class="p-4 font-medium text-slate-900">{{ $student->name }}</td>
                        <td class="p-4">{{ $student->roll_no }}</td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-semibold">
                                {{ $student->classRoom->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="p-4">{{ $student->email }}</td>
                        <td class="p-4 text-center space-x-2">
                            <a href="{{ route('students.edit', $student->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">
                            No students found.
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