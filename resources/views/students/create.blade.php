<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Student Register</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">student Register</h2>
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 border rounded @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Roll_no.</label>
                <input type="text" name="roll_no" value="{{ old('roll_no') }}" class="w-full p-2 border rounded @error('roll_no') border-red-500 @enderror">
                @error('roll_no') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Class</label>
                <select name="class_room_id" class="w-full p-2 border rounded @error('class_room_id') border-red-500 @enderror">
                    <option value="">Choose Class_Room</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ old('class_room_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
                @error('class_room_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full p-2 border rounded @error('email') border-red-500 @enderror">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-1">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob') }}" class="w-full p-2 border rounded @error('dob') border-red-500 @enderror">
                @error('dob') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Upload Image</label>
                <input type="file" name="image" class="w-full p-2 border rounded bg-white">
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Save</button>
        </form>
    </div>
</body>
</html>