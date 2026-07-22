<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Lists</title>
    <!-- Tailwind CSS v4 Browser Engine -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 p-6 md:p-12 font-sans antialiased">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-xs border border-slate-200/80 overflow-hidden">
        
        <!-- Header Section -->
        <div class="flex justify-between items-center p-6 border-b border-slate-100">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Student Lists</h2>
                <p class="text-sm text-slate-500 mt-1">Manage all registered students and their profiles.</p>
            </div>
            <a href="{{ route('students.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold shadow-xs transition-colors">
                + Add New Student
            </a>
        </div>

        @if(session('success'))
            <div class="mx-6 mt-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-lg flex items-center shadow-2xs">
                <span class="mr-2 font-semibold">Success:</span> {{ session('success') }}
            </div>
        @endif

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="p-4 text-xs font-bold uppercase tracking-wider text-slate-500 w-24 text-center">Photo</th>
                        <th class="p-4 text-xs font-bold uppercase tracking-wider text-slate-500 w-28">Roll No.</th>
                        <th class="p-4 text-xs font-bold uppercase tracking-wider text-slate-500">Name</th>
                        <th class="p-4 text-xs font-bold uppercase tracking-wider text-slate-500">Class</th>
                        <th class="p-4 text-xs font-bold uppercase tracking-wider text-slate-500">Email Address</th>
                        <th class="p-4 text-xs font-bold uppercase tracking-wider text-slate-500">Date of Birth</th>
                        <th class="p-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-right pr-6">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($students as $student)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <!-- Photo Column -->
                        <td class="p-4 text-center whitespace-nowrap">
                            @if($student->image)
                                <img src="{{ asset('storage/' . $student->image) }}" alt="{{ $student->name }}" class="w-11 h-11 rounded-full object-cover ring-2 ring-slate-100 mx-auto">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=E2E8F0&color=475569&bold=true" alt="Default Avatar" class="w-11 h-11 rounded-full ring-2 ring-slate-100 mx-auto">
                            @endif
                        </td>
                        
                        <!-- Roll Number -->
                        <td class="p-4 text-sm font-medium text-slate-600 whitespace-nowrap">
                            <span class="bg-slate-100 px-2.5 py-1 rounded-md text-xs font-semibold">{{ $student->roll_no }}</span>
                        </td>
                        
                        <!-- Name -->
                        <td class="p-4 text-sm font-semibold text-slate-800 whitespace-nowrap">
                            {{ $student->name }}
                        </td>
                        
                        <!-- Class -->
                        <td class="p-4 text-sm text-slate-600 whitespace-nowrap">
                            {{ $student->classRoom->name ?? 'N/A' }}
                        </td>
                        
                        <!-- Email -->
                        <td class="p-4 text-sm text-slate-600 whitespace-nowrap">
                            {{ $student->email }}
                        </td>
                        
                        <!-- DOB -->
                        <td class="p-4 text-sm text-slate-600 whitespace-nowrap">
                            {{ $student->dob }}
                        </td>
                        
                        <!-- Actions -->
                        <td class="p-4 text-sm text-right pr-6 whitespace-nowrap">
                            <div class="inline-flex items-center gap-4">
                                <a href="{{ route('students.edit', $student->id) }}" class="text-amber-600 hover:text-amber-700 font-semibold transition-colors">Edit</a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')" class="inline">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-700 font-semibold cursor-pointer transition-colors">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-12 text-center text-slate-400 text-sm bg-slate-50/30">
                            <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            No students registered in the system yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>