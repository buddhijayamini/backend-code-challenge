<?php

namespace App\Http\Controllers;

use App\Service\OwnerServiceInterface;
use Illuminate\Http\Response;

class GroupByOwnersController extends Controller
{
    public function index(OwnerServiceInterface $ownerServiceInterface)
    {
        return $ownerServiceInterface->getChallenge4();
    }
}
