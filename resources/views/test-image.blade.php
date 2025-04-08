<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Test</title>
</head>
<body>
    <h1>Testing Image Display</h1>
    
    <h2>Direct Image Path</h2>
    <img src="{{ asset('storage/livestock/IO9KRJYJZ76R1RFAg8jitniX55QzDluS6Xzm1kzj.jpg') }}" alt="Test Image" style="max-width: 300px;">
    
    <h2>Storage Path</h2>
    <p>Storage Path: {{ storage_path('app/public/livestock/IO9KRJYJZ76R1RFAg8jitniX55QzDluS6Xzm1kzj.jpg') }}</p>
    
    <h2>Public Path</h2>
    <p>Public Path: {{ public_path('storage/livestock/IO9KRJYJZ76R1RFAg8jitniX55QzDluS6Xzm1kzj.jpg') }}</p>
    
    <h2>Asset URL</h2>
    <p>Asset URL: {{ asset('storage/livestock/IO9KRJYJZ76R1RFAg8jitniX55QzDluS6Xzm1kzj.jpg') }}</p>
</body>
</html>
