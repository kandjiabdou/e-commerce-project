<?php

interface UserRepository
{
  public function checkUserExistence(string $username, string $password): bool;

  public function getUserByUsername(string $username);

  public function createUser($firstName, $lastName, $username, $password): void;
}
