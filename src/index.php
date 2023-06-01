<?php include_once('assets/messages.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/resources/favicon-512x512.png">
        <link rel="stylesheet" href="/assets/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>♥TOMBA CLUB!♥</title>
    </head>
    <body>
        <div class="bar"><bar1><bar2></bar2><bar3></bar3></bar1></div>
        <div id="tomba-gif"><img src="/assets/img/fm.gif"></div>
        <img src="/assets/img/TcL.png" width="500" height="500">
        <p>
            Welcome to the TOMBA CLUB website on the interwebs!<br><br>
            Where do you want to go today?
        </p>
        <div class="marquee"><p><?= msg_format($messages[rand(0, count($messages)-1)]) ?></p></div>
        <menu>
            <a href="/wiki/Main_Page">
                <img src="/assets/img/wiki.png" width="460" height="290">
                Tomba Wiki!
            </a>
            <a href="/interviews.html">
                <img src="/assets/img/interview.png" width="460" height="290">
                Interviews
            </a>
            <a href="/merch.html">
                <img src="/assets/img/merch.png" width="460" height="290">
                Merch We Found
            </a>
            <!--
            <a href="#">
                <img src="/assets/img/faq.png" width="460" height="290">
                Frequently Asked Questions
            </a>
            -->
        </menu>
        <img src="/assets/img/uc.gif">
        <footer>
            <small>
                Tomba! &copy; 1997-2000 Whoopee Camp Co. Ltd.<br>
                &copy; 2023 TOMBA CLUB (Please don’t sue us, Tokuro!)
            </small>
        </footer>
        <script src="/assets/js/tomba.js"></script>
        <script src="/assets/js/marquee.js"></script>
    </body>
</html>
