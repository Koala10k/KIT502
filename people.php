<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <?php include 'common_refer.php'; ?>
        <title>People</title>
        <script>
            $(document).ready(function () {
                $('#cssmenu li:eq(1)').addClass('active');
                $('div.people').on('click', function () {
                    alert($(this).index());
                    switch ($(this).index()) {
                        case 0:
                            $('div.info').css({"background-color": "red"});
                            break;
                        case 1:
                            $('div.info').css({"background-color": "green"});
                            break;
                        case 2:
                            $('div.info').css({"background-color": "blue"});
                            break;
                    }
                })
            });
        </script>
    </head>
    <body>
        <h1 id="people">People</h1>
        <?php include 'menu.php'; ?>
        <div>
        <div class="people"><img alt="Bart_Simpson" src="./res/Bart_Simpson.png" /></div>
        <div class="people"><img alt="Marge_Simpson" src="./res/Lisa_Simpson.png" /></div>
        <div class="people"><img alt="Homer_Simpson" src="./res/Homer_Simpson.png" /></div>
        <div class="info"></div>
        </div>
    </body>
</html>
