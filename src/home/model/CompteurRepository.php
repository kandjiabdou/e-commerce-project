<?php
interface CompteurRepository {
  public function getCount(): int;

  public function incrementCount(): void;
}
