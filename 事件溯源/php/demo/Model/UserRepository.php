<?php


namespace Model;


use Model\User;
use Ramsey\Uuid\Uuid;

interface UserRepository
{

    public function save(User $user): void;

    public function get(Uuid $uuid): ?User;

}
