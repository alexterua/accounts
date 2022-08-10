<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\SimCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Nutnet\LaravelSms\SmsSender;

class IndexController extends Controller
{
    public function index()
    {

    }

    public function sendSms(int $account_id, SmsSender $smsSender)
    {
        $account = Account::find($account_id)->first();
        $name = $account->name;

        $numbers = [];

        foreach ($account->simCards as $simCard) {
            if ($simCard->is_active === SimCard::IS_ACTIVE) {
                // Предполагаю что номер телефона можно каким-то образом получить по полю iccid
                // Возможно в этом поле json объект, тогда примерно так:
                $numbers[] = json_decode($simCard->iccid)->phone;
            }
        }

        if (count($numbers) === 1) {
            // отправка сообщения на 1 номер
            $smsSender->send($numbers[0], "Здесь текст сообщений для ${$name}");
        } else {
            // отправка сообщения на несколько номеров
            $smsSender->sendBatch($numbers, "Здесь текст сообщений для ${$name}");
        }

        Log::info('Отправлено сообщение для ' . $name);
    }
}
