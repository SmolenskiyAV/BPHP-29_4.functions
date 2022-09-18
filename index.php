<?php
declare(strict_types=1);    // Эта декларация распространяется на данный файл

const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;

$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
];

$items = [];

function  totalListPrint (?array $items, bool $delListMarker = false): void {   // функция отображения всего списка покупок

    if ($delListMarker) {  // отображение списка покупок при выполнении операции "Удалить товар"
        echo 'Текущий список покупок:' . PHP_EOL;
        echo implode("\n", $items) . "\n";
    } else {
        if (count($items)) {  // отображение списка покупок при выполнении остальных операций
            $supportText = 'Ваш список покупок: ' . PHP_EOL;
            $result_list = implode("\n", $items) . "\n";
            echo $supportText . "\n" . $result_list . PHP_EOL;
        } else {
            $supportText = 'Ваш список покупок пуст.' . PHP_EOL;
            echo $supportText . "\n";
        }
    }
    echo "***** \n";
}

function add(): string {
    echo "Введите название товара для добавления в список: \n> ";
    return trim(fgets(STDIN));
}

function del(array $items): array {
    totalListPrint($items, true);

    echo 'Введение название товара для удаления из списка:' . PHP_EOL . '> ';
    $itemName = trim(fgets(STDIN));

    if (in_array($itemName, $items, true) !== false) {
        while (($key = array_search($itemName, $items, true)) !== false) {
            unset($items[$key]);
        }
    }
    return $items;
}

function prnt (array $items): void {
    totalListPrint($items);
    echo 'Всего ' . count($items) . ' позиций. '. PHP_EOL;
    echo 'Нажмите enter для продолжения';
    fgets(STDIN);
}

do {
    system('clear');
//    system('cls'); // windows

    do {

        totalListPrint($items);

        echo 'Выберите операцию для выполнения: ' . PHP_EOL;
        if ((count($items) !== 0) && (!array_key_exists(2, $operations))) {   // Проверить, есть ли товары в списке?
            $tepmVar = OPERATION_DELETE . '. Удалить товар из списка покупок.';
            array_splice($operations, 2, 0, $tepmVar);
        }

        if ((count($items) === 0) && (array_key_exists(2, $operations))) {  // Если в списке нет товаров, то не отображать пункт про удаление товаров
            unset($operations[2]);
        }

        echo implode(PHP_EOL, $operations) . PHP_EOL . '> ';
        $operationNumber = trim(fgets(STDIN));

        if (!array_key_exists($operationNumber, $operations)) {
            system('clear');

            if ($operationNumber === '2') {  // Если нет товаров в списке, то сказать об этом и попросить ввести другую операцию
                echo '!!! Нет объектов для удаления. Выберите другую операцию!' . PHP_EOL;
            } else {
                echo '!!! Неизвестный номер операции, повторите попытку.' . PHP_EOL;
            }
        }

    } while (!array_key_exists($operationNumber, $operations));

    echo 'Выбрана операция: '  . $operations[$operationNumber] . PHP_EOL;

    switch ($operationNumber) {
        case OPERATION_ADD:
            $items[] = add();
            break;

        case OPERATION_DELETE:
            $items = del($items);
            break;

        case OPERATION_PRINT:
            prnt($items);
            break;
    }

    echo "\n ----- \n";
} while ($operationNumber > 0);

echo 'Программа завершена' . PHP_EOL;