<?php $json = json_decode(file_get_contents('https://tomba.club/w/api.php?action=parse&page=Tomba_Wiki:TombaClubCard_Information&prop=text&formatversion=2&format=json'), true); ?>
<?php
function replace_youtube_urls($text) {
    $pattern = '/\(\(youtube:([a-zA-Z0-9_-]+)\)\)/i';
    
    $text = preg_replace_callback($pattern, function ($matches) {
        $video_id = $matches[1];
        return '
            <iframe
                width="560"
                height="315"
                src="https://www.youtube-nocookie.com/embed/'.$video_id.'"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        ';
    }, $text);

    return $text;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/resources/favicon-512x512.png">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="/assets/css/pages.css">
        <link rel="stylesheet" href="/assets/css/wiki.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>#TombaClubCard - ♥TOMBA CLUB!♥</title>
    </head>
    <body class="page-form">
        <div class="bar"><bar1><bar2></bar2><bar3></bar3></bar1></div>
        <div id="tomba-gif"><img src="/assets/img/fm.gif"></div>
        
        <h1>Tomba Club Card</h1>
        <h2>#TombaClubCard</h2>
        <?= replace_youtube_urls($json['parse']['text']) ?>
        <p>
            <a href="/">Back to Index</a>
        </p>
        <footer>
            <small>
                Tomba! &copy; 1997-2000 Whoopee Camp Co. Ltd.<br>
                &copy; 2023 TOMBA CLUB (Please don’t sue us, Tokuro!)
            </small>
        </footer>
        <script src="/assets/js/tomba.js"></script>
    </body>
</html>
