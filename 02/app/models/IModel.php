<?php

namespace App\Models;

interface IModel
{
    /**
     * Данный метод должен вернуть имя таблицы
     *
     * @return string
     */
    public function getTableName(): string;
}