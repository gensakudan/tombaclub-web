<?php $json = json_decode(file_get_contents('https://tomba.club/w/api.php?action=parse&page=Tomba_Wiki:TombaArt2023_Information&prop=text&formatversion=2&format=json'), true); ?>
<?php
$form_data = $_POST;
$form_step = isset($form_data['step']) ? $form_data['step'] : 'start';
$admin_code = isset($_GET['admin_code']) ? $_GET['admin_code'] : '';

function get_submissions_filename($backup = false) {
    if ($backup === false) {
        return 'data/tombaart2023_db.json';
    }
    return 'data/tombaart2023_db_'.date('Ymd_H').'.json';
}

function save_data_to_db($data) {
    $filename = get_submissions_filename();
    $submissions_data = ['submissions' => []];
    if (file_exists($filename)) {
        $submissions_data = json_decode(file_get_contents($filename), true);
    }
    $key = $data['submission_key'] ? $data['submission_key'] : uniqid('tomba', true);
    $submissions_data['submissions'][$key] = [
        'name' => $data['name'],
        'submission' => $data['submission'],
        'email' => $data['email'],
        'description' => $data['description'],
        'agree' => $data['agree'],
        'time' => date('c'),
    ];
    file_put_contents(get_submissions_filename(true), json_encode($submissions_data, JSON_PRETTY_PRINT));
    file_put_contents($filename, json_encode($submissions_data, JSON_PRETTY_PRINT));
}

if ($form_step === 'submit') {
    save_data_to_db($form_data);
}

function get_all_submissions() {
    $filename = get_submissions_filename();
    $submissions_data = ['submissions' => []];
    if (file_exists($filename)) {
        $submissions_data = json_decode(file_get_contents($filename), true);
    }
?>
    <div class="mw-parser-output">
        <table class="wikitable submission-form">
            <tbody>
                <tr>
                    <th colspan="5">All #TombaArt2023 Submissions</th>
                </tr>
                <?php
                if (count($submissions_data['submissions']) === 0) {
                    ?>
                        <tr>
                            <td colspan="5">None yet!</td>
                        </tr>
                    <?php
                }
                else {
                    ?>
                        <tr>
                            <th>Name</th>
                            <th>Submission</th>
                            <th>Email</th>
                            <th>Agreed</th>
                            <th>Time</th>
                        </tr>
                    <?php
                }
                foreach ($submissions_data['submissions'] as $id => $submission) {
                    ?>
                        <tr class="submission-overview">
                            <td><?= form_value('name', $submission, false) ?></td>
                            <?php
                            $link = form_value('submission', $submission, false);
                            ?>
                            <td><a href="<?= $link ?>"><?= $link; ?></a></td>
                            <td><?= form_value('email', $submission, false) ?></td>
                            <td><?= form_value('agree', $submission, false) === 'yes' ? '<div class="thumbsup">👍</div>' : '❌' ?></td>
                            <td><?= form_value('time', $submission, false) ?></td>
                        </tr>
                        <tr class="submission-overview">
                            <td class="preview multiline comments" colspan="6"><span class="prefix">Comments: </span><?= form_value('description', $submission, false) ?></td>
                        </tr>
                    <?php 
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
}

function form_value($key, $data = [], $use_attr = true) {
    if (!empty($data[$key])) {
        $value = htmlspecialchars($data[$key], ENT_QUOTES);
        if (!$use_attr) {
            return $value;
        }
        return 'value="'.$value.'"';
    }
    return '';
}
function get_submit_preview($data = []) {
?>
    <div class="mw-parser-output">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="name" <?= form_value('name', $data) ?> />
            <input type="hidden" name="submission" <?= form_value('submission', $data) ?> />
            <input type="hidden" name="email" <?= form_value('email', $data) ?> />
            <input type="hidden" name="description" <?= form_value('description', $data) ?> />
            <input type="hidden" name="agree" <?= form_value('agree', $data) ?> />
            <input type="hidden" name="submission_key" value="<?= uniqid('tomba', true) ?>" />
            <table class="wikitable submission-form">
                <tbody>
                    <tr>
                        <th colspan="2">#TombaArt2023 Submission Form</th>
                    </tr>
                    <tr>
                        <td colspan="2">Please preview your data and hit "submit" if it looks correct.</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td>
                            <div class="preview"><?= form_value('name', $data, false) ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Submission link:</td>
                        <td>
                            <div class="preview"><?= form_value('submission', $data, false) ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Email: <span class="sub">Optional</span></td>
                        <td>
                            <div class="preview"><?= form_value('email', $data, false) ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Comments: <span class="sub">Optional</span></td>
                        <td>
                            <div class="preview multiline"><?= trim(form_value('description', $data, false)) ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Agreed to terms:</td>
                        <td>
                            <div class="preview">
                                <?php
                                $agree = form_value('agree', $data, false);
                                if ($agree === 'yes') {
                                    print('
                                        I allow Tomba Club to display my work on the website, wiki and Discord server for the contest.<br />
                                        I retain all rights over the artwork I\'m submitting.
                                    ');
                                } else {
                                    print('
                                        No.
                                    ');
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <?php
                            $agree = form_value('agree', $data, false);
                            if ($agree === 'yes') {
                            ?>
                                <button type="submit" name="step" value="submit" class="final-submit">Looks good! Ship it! 🐷</button><br>
                            <?php
                            } else {
                            ?>
                                <div>Sorry. You need to agree to the terms in order to make a submission for the contest. Contact us on Discord if you have any concerns or questions.</div>
                            <?php
                            }
                            ?>
                            <button type="submit" name="step" value="edit">No wait! I need to change something!</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
<?php
}
function get_success_message($data = []) {
?>
    <div class="mw-parser-output">
        <p>You did it bro 😭</p>
    </div>
<?php
}
function get_submit_form($data = []) {
?>
<div class="mw-parser-output">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="step" value="preview" />
        <table class="wikitable submission-form">
            <tbody>
                <tr>
                    <th colspan="2">#TombaArt2023 Submission Form</th>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td>
                        <input type="text" name="name" required="required" <?= form_value('name', $data) ?> />
                    </td>
                </tr>
                <tr>
                    <td>Submission link:</td>
                    <td>
                        <input type="text" name="submission" required="required" <?= form_value('submission', $data) ?> />
                        <div class="sub">Post your submission on any site (Twitter, Mastodon, etc) and link it here.<br>If you want to post via Discord, please join the <a href="https://discord.gg/zx45UfVP5t">Tomba Club Discord</a> and post it there.</div>
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="email" <?= form_value('email', $data) ?> />
                        <div class="sub">Email address where we can contact you. If your art is posted on a social media site, this is optional as we will contact you there.</div>
                    </td>
                </tr>
                <tr>
                    <td>Comments:</td>
                    <td>
                        <textarea id="description" name="description"><?= form_value('description', $data, false) ?></textarea>
                        <div class="sub">Any additional things we should know, or things you'd like to mention.</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>
                            <input type="checkbox" name="agree" value="yes" <?= form_value('agree', $data) ?> required="required" />
                            I agree to let Tomba Club display my work on the website, wiki and Discord server for the contest.
                        </label>
                        <div class="sub">As submitter you retain all rights over your artwork.</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" name="step" value="preview">Preview submission</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<?php
}
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
        <title>#TombaArt2023 Contest - ♥TOMBA CLUB!♥</title>
    </head>
    <body class="page-form">
        <div class="bar"><bar1><bar2></bar2><bar3></bar3></bar1></div>
        <div id="tomba-gif"><img src="/assets/img/fm.gif"></div>
        
        <h1>Tomba Art Contest 2023</h1>
        <h2>#TombaArt2023</h2>
        <?= replace_youtube_urls($json['parse']['text']) ?>
        <?php
        if ($admin_code === 'imtherealtomba') {
            print(get_all_submissions());
        } else if ($form_step === 'preview') {
            print(get_submit_preview($form_data));
        } else if ($form_step === 'submit') {
            print(get_success_message($form_data));
        } else if ($form_step === 'start' || $form_step === 'edit') {
            print(get_submit_form($form_data));
        }
        ?>
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
