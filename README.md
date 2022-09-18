# Задание 1: традиционное знакомство с документацией

Правильно создавать и использовать функции — это очень важный навык. Если вы будете понимать все особенности
декларирований функций, это поможет вам разобраться в основах объектно-ориентированного программирования,
которые мы рассмотрим немного позже.

Традиционно в рамках домашней работы уделите, пожалуйста, 15 минут знакомству с разделами
документации. Основная цель — понимать, где найти необходимую информацию, когда она вам понадобится.

Обратите внимание, что в официальной документации примеры даны в стиле PHP5 без строгой типизации,
а про строгую типизацию говорится в отдельных разделах. Это сделано временно для поддержки обратной совместимости.
Но мы рекомендуем сразу привыкать использовать типизированные аргументы и
результат работы функции вместе с использованием декларацией `declare(strict_types=1);` в начале каждого
файла, сразу после открывающегося тега `<?php`.

* [Функции, определяемые пользователем](https://www.php.net/manual/ru/functions.user-defined.php)
  и все подразделы в правом меню.

Все упоминания объектов в этом разделе пока можно пропустить, об этом мы поговорим позже.

В задании не надо ничего отправлять на проверку, но ознакомление с этой документацией поможет в дальнейшей работе с PHP.

# Задание 2: рефакторинг кода

## Описание
Зачастую когда начинаешь писать код, сложно сразу продумать грамотную архитектуру и приходится
писать как получится, а потом улучшать — рефакторить код. Или же, придя в новый проект, надо разобраться с чужим кодом и улучшить его.

## Техническое задание
Есть файл [basket.php](./basket.php), в котором решена задача для хранения списка покупок.
Если запустить этот файл `php basket.php`, то можно будет добавлять новые записи и удалять
уже ненужные.

В этом коде есть неприятные моменты:
1. Дублирующийся код. Например, вывод всего списка покупок на экран и запрос данных от пользователя.
2. Два вложенных цикла и вложенные switch-case с вложенными условиями, которые делают код
   сложным для восприятия.

Необходимо упростить структуру, вынеся дублирующиеся и вложенные конструкции в отдельные функции.
В отдельных функциях должны оказаться:
* участок кода, выводящий список покупок на экран и запрашивающий следующее действие;
* все действия, находящиеся внутри `case`.

В результате основной код должен быть сокращён примерно до такого вида:
```php
<?php

// объявление констант и переменных
// объявление созданных функций 

do {
    $operationNumber = вызовФункции(...);

    echo 'Выбрана операция: '  . $operations[$operationNumber] . PHP_EOL;

    switch ($operationNumber) {
        case OPERATION_ADD:
            вызовФункции(...);
            break;

        case OPERATION_DELETE:
            вызовФункции(...);
            break;

        case OPERATION_PRINT:
            вызовФункции(...);
            break;
    }

    echo "\n ----- \n";
} while ($operationNumber > 0);

echo 'Программа завершена' . PHP_EOL;

```

Дополнительно обратите внимание:
1. Постарайтесь, чтобы внутри созданных вами функций не было дублирующихся возможностей, а именно вывода всего списка на экран.
1. Включите строгий режим для этого файла.
1. Аргументы всех функций должны быть типизированы.
1. Результаты всех функций должны быть типизированы. 


# Задание 3: улучшение менеджера списка покупок

Улучшите менеджер списка покупок из предыдущего задания:
* добавьте возможность изменять название товаров,
* добавьте возможность добавлять количество каждого товара.

При этом необходимо весь новый код размещать в функциях.
