<?php

namespace Tests\Feature\Http\Controllers;

trait LoginUser
{
    public function setUpLoginUser(): void
    {
        $this->login();
    }
}
