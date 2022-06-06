<?php

function buildMessageView($error): string{
  $er = $error['title'];
  $mes = $error['message'];
  return <<<HTML
    <div class="row justify-content-center">
      $er : $mes;
    </div>
HTML;
}
