<?php
/**
 * Класс реализует комплексную арифметику
 *
 * Общие параметры методов:
 * @param object $complex1
 * @param numeric $complex1->x Действительная часть первого числа
 * @param numeric $complex1->y Мнимая часть первого числа
 *
 * @param object $complex2
 * @param numeric $complex2->x Действительная часть второго числа
 * @param numeric $complex2->y Мнимая часть второго числа
 *
 * Возвращаемый результат:
 * @param object $complex
 * @param numeric $complex->x Действительная часть результата
 * @param numeric $complex->y Мнимая часть результата
 *
 * Возвращаемый результат если ошибка параметров:
 * @param object $complex
 * @param numeric $complex->errorCode - Код ошибки
 *  1 - не верные параметры
 *
 * Методы:
 * add (object $complex1, object $complex2) - Сложение
 * sub(object $complex1, object $complex2)  - Вычитание
 * mult(object $complex1, object $complex2) - Умножение
 * div(object $complex1, object $complex2)  - Деление
 *
 * toStr(object $complex) - для строкового представления комплексного числа
 */
class ComplexArithmetic {

    /**
     * Сложение
     * (x1 + iy1) + (x2 + iy2) = (x1 + x2) + i(y1 + y2)
     * @param object $complex1
     * @param object $complex2
     * @return object
     */
    public function add($complex1, $complex2){
        $result = new stdClass();

        // Проверка на корректность
        $isNumberCorrect1 = $this->isCorrect($complex1);
        $isNumberCorrect2 = $this->isCorrect($complex2);

        if ($isNumberCorrect1 && $isNumberCorrect2) {

            $result->x = $complex1->x + $complex2->x;
            $result->y = $complex1->y + $complex2->y;
            $result->errorCode = 0;

        } else {
            $result->errorCode = 1;
        }

        return $result;
    }

    /**
     * Вычитание
     * (x1 + iy1) + (x2 + iy2) = (x1 - x2) + i(y1 - y2)
     * @param object $complex1
     * @param object $complex2
     * @return object
     */
    public function sub($complex1, $complex2){
        $result = new stdClass();

        // Проверка на корректность
        $isNumberCorrect1 = $this->isCorrect($complex1);
        $isNumberCorrect2 = $this->isCorrect($complex2);

        if ($isNumberCorrect1 && $isNumberCorrect2) {

            $result->x = $complex1->x - $complex2->x;
            $result->y = $complex1->y - $complex2->y;
            $result->errorCode = 0;

        } else {
            $result->errorCode = 1;
        }

        return $result;
    }

    /**
     * Умножение
     * (x1 + iy1)(x2 + iy2) = x1x2 − y1y2 + (x1y2 + x2y1)i
     * @param object $complex1
     * @param object $complex2
     * @return object
     */
    public function mult($complex1, $complex2){
        $result = new stdClass();

        // Проверка на корректность
        $isNumberCorrect1 = $this->isCorrect($complex1);
        $isNumberCorrect2 = $this->isCorrect($complex2);

        if ($isNumberCorrect1 && $isNumberCorrect2) {

            $result->x = $complex1->x * $complex2->x
                - $complex1->y * $complex2->y;

            $result->y = $complex1->x * $complex2->y
                + $complex2->x * $complex1->y;

            $result->errorCode = 0;

        } else {
            $result->errorCode = 1;
        }

        return $result;
    }

    /**
     * Деление
     * (x1x2 + y1y2) / (x2x2 + y2y2) + (y1x2 − x1y2) / (x2x2 + y2y2) i
     * @param object $complex1
     * @param object $complex2
     * @return object
     */
    public function div($complex1, $complex2){
        $result = new stdClass();

        // Проверка на корректность
        $isNumberCorrect1 = $this->isCorrect($complex1);
        $isNumberCorrect2 = $this->isCorrect($complex2);

        // Проверка на знаменатель === 0
        $isNoZeroDenominator = true;
        if ($complex2->x * $complex2->x
            + $complex2->y * $complex2->y === 0){
            $isNoZeroDenominator = false;
        }

        if (
            $isNumberCorrect1
            && $isNumberCorrect2
            && $isNoZeroDenominator
        ) {

            $result->x = (
                    $complex1->x * $complex2->x
                    + $complex1->y * $complex2->y
                ) / (
                    $complex2->x * $complex2->x
                    + $complex2->y * $complex2->y
                )
            ;

            $result->y = (
                    $complex1->y * $complex2->x
                    - $complex1->x * $complex2->y
                ) / (
                    $complex2->x * $complex2->x
                    + $complex2->y * $complex2->y
                )
            ;

            $result->errorCode = 0;

        } else {
            $result->errorCode = 1;
        }

        return $result;
    }

    /**
     * Для строкового представления комплексного числа
     * @param object $complex
     * @return string
     */
    public function toStr($complex): string
    {
        if (
            (isset($complex->errorCode))
            &&($complex->errorCode > 0)
        ) {
            return "Error code = {$complex->errorCode}";
        } else {
            $result = '';

            // Если действительная часть не равна нулю
            if ($complex->x !== 0){
                $result .= $complex->x;

                // '+' обязателен
                if ($complex->y > 0) {
                    $result .= '+' . $complex->y;
                }

                if ($complex->y < 0) {
                    $result .= $complex->y;
                }
            } else {

                // '+' необязателен
                if ($complex->y !== 0) {
                    $result .= $complex->y;
                }
            }

            // Если мнимая часть не равна нулю, то дописываем 'i'
            if ($complex->y !== 0) {
                $result .= 'i';
            }

            // Если обе части равны нулю, то и результат равен нулю
            if (
                ($complex->x === 0)
                && ($complex->y === 0)
            ) {
                $result = '0';
            }

            return $result;
        }
    }

    /**
     * Проверка на полноту параметров
     * @param object $complex
     * @return bool
     */
    private function isCorrect($complex) :bool
    {
        $result = false;

        if (
            (isset($complex->x)) && (is_numeric($complex->x))
            &&(isset($complex->y)) && (is_numeric($complex->y))
        ){
            $result = true;
        }

        return $result;
    }

}