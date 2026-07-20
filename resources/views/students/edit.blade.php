<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Edit Information</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Edit Information</h2>
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $student->name) }}" class="w-full p-2 border rounded @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Roll_no.</label>
                <input type="text" name="roll_no" value="{{ old('roll_no', $student->roll_no) }}" class="w-full p-2 border rounded @error('roll_no') border-red-500 @enderror">
                @error('roll_no') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Class_Room</label>
                <select name="class_room_id" class="w-full p-2 border rounded @error('class_room_id') border-red-500 @enderror">
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ old('class_room_id', $student->class_room_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
                @error('class_room_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $student->email) }}" class="w-full p-2 border rounded @error('email') border-red-500 @enderror">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-1">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob', $student->dob) }}" class="w-full p-2 border rounded @error('dob') border-red-500 @enderror">
                @error('dob') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="w-full bg-yellow-600 text-white p-2 rounded hover:bg-yellow-700">Save Update</button>
        </form>
    </div>
</body>
</html>