<!DOCTYPE html>
<html>
<head>
    <title>{{ Setting('website_name') }}</title>
    <style>
        body, html {
    margin: 0;
    padding-top: 30px;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container img {
    width: 100%;
    /*height: 100%;*/
}
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('coming_soon.jpg') }}" alt="Coming Soon">
    </div>
</body>
</html>
