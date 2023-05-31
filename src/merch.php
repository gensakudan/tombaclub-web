<?php $json = json_decode(file_get_contents('https://tomba.club/w/api.php?action=parse&page=List_of_Tomba_promotional_goodies&prop=text&formatversion=2&format=json'), true); ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/resources/favicon-512x512.png">
        <link rel="stylesheet" href="/assets/style.css">
        <link rel="stylesheet" href="/assets/wiki.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Merch We Found - ♥TOMBA CLUB!♥</title>
    </head>
    <body>
        <div class="bar"><bar1><bar2></bar2><bar3></bar3></bar1></div>
        <div id="tomba-gif"><img src="/assets/img/fm.gif"></div>
        <img src="/assets/img/merch.png" width="460" height="290">
        <h1>Merch We Found</h1>
        <?= $json['parse']['text'] ?>
        <p>
        <a href="/wiki/List_of_Tomba_promotional_goodies">See this page on the Wiki</a><br><br>
            <a href="/">Back to Index</a>
        </p>
        <img src="/assets/img/uc.gif">
        <footer>
            <small>
                Tomba! &copy; 1997-2000 Whoopee Camp Co. Ltd.<br>
                &copy; 2023 TOMBA CLUB (Please don’t sue us, Tokuro!)
            </small>
        </footer>
        <script src="/assets/tomba.js"></script>
    </body>
</html>
