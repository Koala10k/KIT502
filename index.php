<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <?php include 'common_refer.php'; ?>
        <title>Index</title>
        <script>
            $(document).ready(function (){
            $("#cur_time").text(new Date().toLocaleString());
            setInterval(function(){$("#cur_time").text(new Date().toLocaleString())}, 1000);
            $('#cssmenu li:eq(0)').addClass('active');
});
        </script>
    </head>
    <body>
        <h1 id="index">Online Survey</h1>
        <?php include 'menu.php'; ?>
        <p>Introduction comes here</p>
        <div id="cur_time"></div>
    </body>
</html>
