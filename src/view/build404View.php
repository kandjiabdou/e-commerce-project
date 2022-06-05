<?php

function build404View(): string
{
  return <<<HTML
    <div id="content" class="404page">
      <div class="container-fluid">
        <div class="row">
          <div class="not_found">
              <a href="/e-commerce-project/src">
                <img src="/e-commerce-project/src/assets/image/logo/logo.png" alt="logo">
              </a>
              
              <h2>page not found</h2>
              <h1 class="font-accent">4<span>0</span>4</h1>
              <p>The page requested couldn't be found - this could be due to a spelling error in the URL or a removed page.</p>
              <div class=""><a class="btn " href="/e-commerce-project/src">back to home page</a></div>
          </div>
        </div>
      </div>
    </div>
HTML;
}
