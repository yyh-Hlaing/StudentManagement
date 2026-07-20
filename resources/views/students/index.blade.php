<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Student Lists</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Student Lists</h2>
            <a href="{{ route('students.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Add New Student</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 border">Roll_no.</th><th class="p-3 border">နာမည်</th>
                    <th class="p-3 border">Class</th><th class="p-3 border">အီးမေးလ်</th>
                    <th class="p-3 border">Date of Birth</th><th class="p-3 border">လုပ်ဆောင်ချက်</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border">{{ $student->roll_no }}</td><td class="p-3 border">{{ $student->name }}</td>
                    <td class="p-3 border">{{ $student->classRoom->name }}</td><td class="p-3 border">{{ $student->email }}</td>
                    <td class="p-3 border">{{ $student->dob }}</td>
                    <td class="p-3 border flex gap-2">
                        <a href="{{ route('students.edit', $student->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Sure?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="p-3 text-center text-gray-500">There are no students yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>