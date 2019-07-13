<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 11/03/2019
 * Time: 11:31 PM
 */

namespace App\Traits;


trait Position
{
    public static function bootPosition()
    {
        self::created(function ($model) {
            $where = isset($model->client_id) ? ['client_id' => $model->client_id] : null;
            $model->position = self::lastPosition($where) + 1;
            $model->update();
        });
        self::deleted(function ($model) {
            $where = isset($model->client_id) ? ['client_id' => $model->client_id] : null;
            self::resortItems($where);
        });
    }

    static function resortItems($model)
    {
        foreach (self::orderedItems($model) as $key => $item)
        {
            $item->position = $key + 1;
            $item->update();
        }
    }

    static function lastPosition($where): int
    {
        $last = self::lastElement($where);
        return $last->position ?? 0;
    }

    static function lastElement($where)
    {
        if($where) return self::where(key($where), value($where))->orderByDesc('position')->first();
        return self::orderByDesc('position')->first();
    }
    static function orderedItems($where)
    {
        if($where) return self::where(key($where), value($where))->orderBy('position')->get();
        return self::orderBy('position')->get();
    }
    static function getPositionsArray()
    {
        $positions = [];
        foreach (request('positions') as $position => $id) {
            if ($id) $positions[(int) $id] = (int) $position + 1;
        }
        return $positions;
    }
    static function getPositionsIDs()
    {
        $positions = self::getPositionsArray();
        return array_keys($positions);
    }
    static function getPositionsItems($where)
    {
        $IDs = self::getPositionsIDs();
        if($where) return self::where(key($where), value($where))->whereIn('id', $IDs)->get();
        return self::whereIn('id', $IDs)->get();
    }
    static function updatePositionByRequest($where = null)
    {
        $items = self::getPositionsItems($where);
        $positions = self::getPositionsArray($where);
        foreach ($items as $item) {
            foreach ($positions as $id => $position)
            {
                if($item->id == $id) {
                    $item->position = $position;
                    $item->update();
                }
            }

        }
    }
}