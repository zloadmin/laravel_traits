<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 26/03/2019
 * Time: 1:10 PM
 */

namespace App\Traits;


use App\Client;

trait HasClient
{
    public function scopeClient($query, Client $client)
    {
        return $query->where('client_id', $client->id);
    }
    public function scopeClients($query)
    {
        $client = Client::getCurrent();
        return $query->where('client_id', $client->id);
    }
}