<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Get Coordinates from City Name</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="text-center text-primary mb-4">Get Coordinates from City Name</h1>

                        <!-- City form -->
                        <form action="{{ route('getCityName') }}" method="POST" class="mb-4">
                            @csrf <!-- CSRF Token -->
                            <div class="mb-3">
                                <label for="city" class="form-label">Enter City Name</label>
                                <input type="text" name="city" id="city" class="form-control"
                                    placeholder="Enter city name" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>

                        <!-- Display coordinates -->
                        @if (isset($coords))
                            <div class="alert alert-success">
                                <h4 class="alert-heading">Given Address:</h4>
                                <p>{{ $city }}</p>
                                <hr>
                                <h4 class="alert-heading">Coordinates:</h4>
                                <p>Latitude: <span id="latitude">{{ $locationLat }}</span></p>
                                <p>Longitude: <span id="longitude">{{ $locationLng }}</span></p>
                                <button class="btn btn-success w-100" onclick="copyCoordinates()">Copy
                                    Coordinates</button>
                            </div>
                        @elseif($errors->any())
                            <div class="alert alert-danger">
                                <h4 class="alert-heading">Error:</h4>
                                <p>{{ $errors->first() }}</p>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <h4 class="alert-heading">Notice:</h4>
                                <p>Latitude and Longitude not found for this address</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for copying coordinates -->
    <script>
        function copyCoordinates() {
            const latitude = document.getElementById('latitude').textContent;
            const longitude = document.getElementById('longitude').textContent;

            // Combine latitude and longitude into a single string
            const coordinates = `${latitude}, ${longitude}`;

            // Create a temporary input element
            const tempInput = document.createElement('input');
            tempInput.value = coordinates;
            document.body.appendChild(tempInput);

            // Select the text and copy it to the clipboard
            tempInput.select();
            document.execCommand('copy');

            // Remove the temporary input element
            document.body.removeChild(tempInput);

            // Notify the user
            alert('Coordinates copied to clipboard: ' + coordinates);
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
