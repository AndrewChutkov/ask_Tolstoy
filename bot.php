<?php

include 'buttons.php';
include 'texts/quotes.php';

$data = json_decode(file_get_contents('php://input'),true);
$text = $data['message']['text'];
$callback_data = $data['callback_query']['data'];

file_put_contents( 'file.txt', print_r($data, true), FILE_APPEND);

define('TOKEN', 'TOKEN');

$keyboard = [
    [
        ['text' => $future_button],
        ['text' => $work_button],
        ['text' => $love_button],

    ],
    [
        ['text' => $health_button],
        ['text' => $friendship_button],
        ['text' => $money_button],

    ],
    [
        ['text' => $relaxation_button],
        ['text' => $self_development_button],
        ['text' => $live_button],
    ],
    [
        ['text' => $family_button],
        ['text' => $childhood_button],
        ['text' => $happiness_button],
    ],
];



// Функция вызова методов API
function sendTelegram($method, $response)
{
    $ch = curl_init('https://api.telegram.org/bot' . TOKEN . '/' . $method);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $res = curl_exec($ch);
    curl_close($ch);

    return $res;
}

switch ($text) {
    case '/start':
        if ($text = '/start' and $data['message']['from']['id'] == '218314749') {
            sendTelegram(
                'sendMessage',
                array(
                    'chat_id' => $data['message']['chat']['id'],
                    'text' => file_get_contents(__DIR__ . '/texts/start.txt'),
                    'reply_markup' => json_encode([
                        'resize_keyboard' => true,
                        'keyboard' => [
                            [
                                ['text' => $future_button],
                                ['text' => $work_button],
                                ['text' => $love_button],

                            ],
                            [
                                ['text' => $health_button],
                                ['text' => $friendship_button],
                                ['text' => $money_button],

                            ],
                            [
                                ['text' => $relaxation_button],
                                ['text' => $self_development_button],
                                ['text' => $live_button],
                            ],
                            [
                                ['text' => $family_button],
                                ['text' => $childhood_button],
                                ['text' => $happiness_button],
                            ],
                            [
                                ['text' => 'Статистика']
                            ]
                        ]
                    ])
                )
            );
        } else {
            $count_start = file_get_contents(__DIR__ . '/stats/start_button.txt');
            $count_start = (int)$count_start + 1;
            file_put_contents(__DIR__ . '/stats/start_button.txt', print_r($count_start, true));
            sendTelegram(
                'sendMessage',
                array(
                    'chat_id' => $data['message']['chat']['id'],
                    'text' => file_get_contents(__DIR__ . '/texts/start.txt'),
                    'reply_markup' => json_encode([
                        'resize_keyboard' => true,
                        'keyboard' => $keyboard
                        ])
                )
            );
        }
            break;

    case 'Статистика':
        if ($text = 'Статистика' and $data['message']['from']['id'] == '218314749') {

            $count_start = file_get_contents(__DIR__ . '/stats/start_button.txt');
            $count_future = file_get_contents(__DIR__ . '/stats/future_button.txt');
            $count_work = file_get_contents(__DIR__ . '/stats/work_button.txt');
            $count_love = file_get_contents(__DIR__ . '/stats/love_button.txt');
            $count_health = file_get_contents(__DIR__ . '/stats/health_button.txt');
            $count_friendship = file_get_contents(__DIR__ . '/stats/friendship_button.txt');
            $count_money = file_get_contents(__DIR__ . '/stats/money_button.txt');
            $count_relaxation = file_get_contents(__DIR__ . '/stats/relaxation_button.txt');
            $count_self_development = file_get_contents(__DIR__ . '/stats/self_development_button.txt');
            $count_live = file_get_contents(__DIR__ . '/stats/live_button.txt');
            $count_family = file_get_contents(__DIR__ . '/stats/family_button.txt');
            $count_childhood = file_get_contents(__DIR__ . '/stats/childhood_button.txt');
            $count_happiness = file_get_contents(__DIR__ . '/stats/happiness_button.txt');

            sendTelegram(
                'sendMessage',
                array(
                    'chat_id' => $data['message']['chat']['id'],
                    'text' => '/start: ' .  $count_start . PHP_EOL .
                        $future_button . ': '  . $count_future . PHP_EOL .
                        $work_button . ': '  . $count_work . PHP_EOL .
                        $love_button . ': '  . $count_love . PHP_EOL .
                        $health_button . ': '  . $count_health . PHP_EOL .
                        $friendship_button . ': '  . $count_friendship . PHP_EOL .
                        $money_button . ': '  . $count_money . PHP_EOL .
                        $relaxation_button . ': '  .  $count_relaxation . PHP_EOL .
                        $self_development_button . ': '  . $count_self_development . PHP_EOL .
                        $live_button . ': '  . $count_live . PHP_EOL .
                        $family_button . ': '  . $count_family . PHP_EOL .
                        $childhood_button . ': '  . $count_childhood . PHP_EOL .
                        $happiness_button . ': '  . $count_happiness . PHP_EOL

                )
            );
        }
        break;

        case $future_button;
            $count_future = file_get_contents(__DIR__ . '/stats/future_button.txt');
            $count_future = (int)$count_future + 1;
            file_put_contents(__DIR__ . '/stats/future_button.txt', print_r($count_future, true));
            sendTelegram(
                'sendMessage',
                array(
                    'chat_id' => $data['message']['chat']['id'],
                    'text' => $future[(array_rand($future))],
                )
            );
            break;

    case $work_button;
        $count_work = file_get_contents(__DIR__ . '/stats/work_button.txt');
        $count_work = (int)$count_work + 1;
        file_put_contents(__DIR__ . '/stats/work_button.txt', print_r($count_work, true));
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => $work[(array_rand($work))],
            )
        );
        break;

    case $love_button;
        $count_love = file_get_contents(__DIR__ . '/stats/love_button.txt');
        $count_love = (int)$count_love + 1;
        file_put_contents(__DIR__ . '/stats/love_button.txt', print_r($count_love, true));
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => $love[(array_rand($love))],
            )
        );
        break;

    case $health_button;
        $count_health = file_get_contents(__DIR__ . '/stats/health_button.txt');
        $count_health = (int)$count_health + 1;
        file_put_contents(__DIR__ . '/stats/health_button.txt', print_r($count_health, true));
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => $health[(array_rand($health))],
            )
        );
        break;

    case $friendship_button;
        $count_friendship = file_get_contents(__DIR__ . '/stats/friendship_button.txt');
        $count_friendship = (int)$count_friendship + 1;
        file_put_contents(__DIR__ . '/stats/friendship_button.txt', print_r($count_friendship, true));
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => $friendship[(array_rand($friendship))],
            )
        );
        break;

    case $money_button;
        $count_money = file_get_contents(__DIR__ . '/stats/money_button.txt');
        $count_money = (int)$count_money + 1;
        file_put_contents(__DIR__ . '/stats/money_button.txt', print_r($count_money, true));
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => $money[(array_rand($money))],
            )
        );
        break;

    case $relaxation_button;
        $count_relaxation = file_get_contents(__DIR__ . '/stats/relaxation_button.txt');
        $count_relaxation = (int)$count_relaxation + 1;
        file_put_contents(__DIR__ . '/stats/relaxation_button.txt', print_r($count_relaxation, true));
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => $relaxation[(array_rand($relaxation))],
            )
        );
        break;


    case $self_development_button;
        $count_self_development = file_get_contents(__DIR__ . '/stats/self_development_button.txt');
        $count_self_development = (int)$count_self_development + 1;
        file_put_contents(__DIR__ . '/stats/self_development_button.txt', print_r($count_self_development, true));
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => $self_development[(array_rand($self_development))],
            )
        );
        break;

    case $live_button;
        $count_live = file_get_contents(__DIR__ . '/stats/live_button.txt');
        $count_live = (int)$count_live + 1;
        file_put_contents(__DIR__ . '/stats/live_button.txt', print_r($count_live, true));
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => $live[(array_rand($live))],
            )
        );
        break;

    case $family_button;
        $count_family = file_get_contents(__DIR__ . '/stats/family_button.txt');
        $count_family = (int)$count_family + 1;
        file_put_contents(__DIR__ . '/stats/family_button.txt', print_r($count_family, true));
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => $family[(array_rand($family))],
            )
        );
        break;

    case $childhood_button;
        $count_childhood = file_get_contents(__DIR__ . '/stats/childhood_button.txt');
        $count_childhood = (int)$count_childhood + 1;
        file_put_contents(__DIR__ . '/stats/childhood_button.txt', print_r($count_childhood, true));
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => $childhood[(array_rand($childhood))],
            )
        );
        break;

    case $happiness_button;
        $count_happiness = file_get_contents(__DIR__ . '/stats/happiness_button.txt');
        $count_happiness = (int)$count_happiness + 1;
        file_put_contents(__DIR__ . '/stats/happiness_button.txt', print_r($count_happiness, true));
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => $happiness[(array_rand($happiness))],
            )
        );
        break;

    default:
        sendTelegram(
            'sendMessage',
            array(
                'chat_id' => $data['message']['chat']['id'],
                'text' => file_get_contents(__DIR__ . '/texts/plug.txt'),
            )
        );
        break;
}
