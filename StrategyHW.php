<?php

//Стратегия: есть интернет-магазин по продаже носков. Необходимо реализовать возможность
//оплаты различными способами (Qiwi, Яндекс, WebMoney). Разница лишь в обработке запроса
//на оплату и получение ответа от платёжной системы. В интерфейсе функции оплаты
//достаточно общей суммы товара и номера телефона.

interface PayStrategyInterface
{
    public function pay($unit);
}

class QiwiPayStrategy implements PayStrategyInterface
{

    public function pay($unit)
    {
    $this ->pay($unit);
        echo "pay with Qiwi";
    }

}

class YandexPayStrategy implements PayStrategyInterface
{

    public function pay($unit)
    {
        $this ->pay($unit);
        echo "pay with Yandex";
    }

}

class WebMoneyPayStrategy implements PayStrategyInterface
{

    public function pay($unit)
    {
        $this ->pay($unit);
        echo "pay with WebMoney";
    }

}


class PaymentService
{
    protected PayStrategyInterface $PayStrategy;


    public function __construct(PayStrategyInterface $PayStrategy)
    {
        $this->PayStrategy = $PayStrategy;
    }

    public function run(array $units)
    {
        foreach ($units as $unit) {
            $this->PayStrategy->pay(($unit['quantity']) * $unit['price'] . $unit['address']);
        }
    }

}

$PayService = new PaymentService(
    new QiwiPayStrategy()
);

$PayService->run([]);
var_dump($PayService);

echo "Strategy\n";