<!DOCTYPE html>
<html>
    <head><title>test</title></head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css">
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <style>
        .panorama{
            width:100%;
            height: 50px;
        }
    </style>
    <body>
        <div id="panorama" class="panorama"></div>
        <form action="/pages/login/login.php">
            <input type="submit" value="login">
        </form>
    </body>
    <script>
    pannellum.viewer("panorama", {
        "type": "equirectangular",
        "panorama": "./360_image.jpg",
        "autoLoad": true
    });
    </script>
</html>
