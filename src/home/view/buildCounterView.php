<?php

function buildCounterView(int $count): string
{
  return <<<HTML
    <div class="card">
      <div class="card-body">
        <h4 class="text-center">Le site a été visité $count fois</h4>
      </div>
    </div>
HTML;
}
