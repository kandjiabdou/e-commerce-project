<?php

interface UserRepository
{
  public function checkUserExistence(string $username, string $password): bool;

  public function isUserNameExist(string $username);

  public function createUser($firstName, $lastName, $username, $password): void;
}
