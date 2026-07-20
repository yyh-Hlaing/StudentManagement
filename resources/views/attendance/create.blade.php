<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Daily Attendence Report</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Daily Attendence Report</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif

       
        <form action="{{ route('attendance.create') }}" method="GET" class="mb-6 flex gap-4 items-end bg-gray-50 p-4 rounded border">
            <div class="flex-1">
                <label class="block text-sm font-semibold mb-1">Choose Class Rooms</label>
                <select name="class_room_id" onchange="this.form.submit()" class="w-full p-2 border rounded">
                    <option value="">Choose Section</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ $selected_class == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        @if(count($students) > 0)
        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf
            <div class="mb-4 max-w-xs">
                <label class="block text-sm font-semibold mb-1">Date</label>
                <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full p-2 border rounded">
            </div>

            <table class="w-full text-left border-collapse mb-6">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 border">Roll-no.</th>
                        <th class="p-3 border">Name</th>
                        <th class="p-3 border text-center">Present</th>
                        <th class="p-3 border text-center">Absent</th>
                        <th class="p-3 border text-center">Late</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border">{{ $student->roll_no }}</td>
                        <td class="p-3 border">{{ $student->name }}</td>
                        <td class="p-3 border text-center">
                            <input type="radio" name="attendance[{{ $student->id }}]" value="present" checked class="w-4 h-4 text-blue-600">
                        </td>
                        <td class="p-3 border text-center">
                            <input type="radio" name="attendance[{{ $student->id }}]" value="absent" class="w-4 h-4 text-red-600">
                        </td>
                        <td class="p-3 border text-center">
                            <input type="radio" name="attendance[{{ $student->id }}]" value="late" class="w-4 h-4 text-yellow-600">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold p-3 rounded">
                Attendance Report Successfully
            </button>
        </form>
        @elseif($selected_class)
            <p class="text-center text-gray-500 my-4">There are no students in this class yet.</p>
        @endif
    </div>
</body>
</html>