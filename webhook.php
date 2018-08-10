<?php
/**
 * Created by PhpStorm.
 * User: XiaoLin
 * Date: 2018-08-10
 * Time: 1:55 PM
 */

$data = json_decode(file_get_contents("php://input"),true);
if (empty($data) || !isset($data['inline_query'])) die;

error_log(json_encode($data));
$data = $data['inline_query'];

$blue_url = 'https://sg-api.xiaolin.in/meow/blue.php?text=' . urlencode($data['query']);
$pink_url = 'https://sg-api.xiaolin.in/meow/pink.php?text=' . urlencode($data['query']);

if ($data['query'] == '') $blue_url = 'https://sg-api.xiaolin.in/meow/image/blue.png';
if ($data['query'] == '') $pink_url = 'https://sg-api.xiaolin.in/meow/image/pink.png';

$result = [
    [
        'type' => 'photo',
        'id' => 'blue_meow',
        'title' => '蓝喵',
        'photo_url' => $blue_url,
        'thumb_url' => $blue_url,
    ],
    [
        'type' => 'photo',
        'id' => 'pink_meow',
        'title' => '粉喵',
        'photo_url' => $pink_url,
        'thumb_url' => $pink_url,
    ],
];

error_log(json_encode($result));

file_get_contents("https://api.telegram.org/bot<token>/answerInlineQuery?inline_query_id={$data['id']}&results=" . urlencode(json_encode($result)));