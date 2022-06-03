<?php
require_once __DIR__ . '/CompteurRepository.php';

class FileCompteurRepository implements CompteurRepository {
  private $FILE_NAME = __DIR__ . '/../../../data/count.json';

  public function __construct() {
    if(!file_exists($this->FILE_NAME)) {
      file_put_contents($this->FILE_NAME, 0);
    }
  }

  public function getCount(): int {
    return (int) file_get_contents($this->FILE_NAME);
  }

  public function incrementCount(): void {
    file_put_contents($this->FILE_NAME, $this->getCount() + 1);
  }
}
