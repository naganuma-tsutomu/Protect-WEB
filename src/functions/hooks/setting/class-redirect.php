<?php

namespace hooks\setting;

use hooks\Hook_Interface;

class Redirect implements Hook_Interface
{
    private const REDIRECT_PAGES = ['contact', 'order'];

    public function addAction(): void
    {
        add_action('template_redirect', [$this, 'redirectToStep1']);
    }

    public function redirectToStep1(): void
    {
        foreach (self::REDIRECT_PAGES as $slug) {
            if (is_page($slug) && !isset($_GET['step'])) {
                wp_redirect(home_url("/{$slug}/?step=1"));
                exit();
            }
        }
    }
}
