<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <h1>Election Results</h1>

    <!-- Display success message if available -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Form to upload new election result -->
    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required>
        <button type="submit">Upload Election Result</button>
    </form>

    <!-- Latest result display -->
    <div class="w3-row w3-container" style="display: flex; height: 100vh;">
        <!-- Latest result display on the left side -->
        @if ($latestResult)
        <div style="flex: 3; padding: 20px; position: relative;">
            <h2>Latest Result</h2>
            <img src="{{ asset('images/' . $latestResult->image_path) }}" alt="Latest Election Result" style="width:100%; height:100%; object-fit:contain;">
            <div style="position: absolute; top: 10px; right: 10px; background: rgba(0, 0, 0, 0.7); color: white; padding: 5px; border-radius: 5px;">
                {{ $latestResult->created_at->format('Y-m-d H:i:s') }}
            </div>
        </div>
        @endif

        <div style="flex: 1; padding: 20px; overflow-y: auto; height: 100vh;">
            <h2>Previous Results</h2>
            <div class="previous-results" style="display: flex; flex-direction: column; gap: 20px;">
                @foreach ($previousResults as $result)
                <div style="position: relative;">
                    <img src="{{ asset('images/' . $result->image_path) }}" alt="Election Result" style="width:150px; height:150px; object-fit:cover; cursor:pointer;" onclick="openModal('{{ asset('images/' . $result->image_path) }}', '{{ $result->created_at->format('Y-m-d h:i:s') }}')">
                    <div style="position: absolute; top: 5px; right: 5px; background: rgba(0, 0, 0, 0.7); color: white; padding: 3px; border-radius: 5px;">
                        {{ $result->created_at->format('Y-m-d H:i:s') }}
                    </div>
                    <form action="/delete/{{ $result->id }}" method="POST" style="position: absolute; top: 5px; left: 5px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: red; color: white; border: none; padding: 5px; border-radius: 5px; cursor: pointer;">Delete</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>