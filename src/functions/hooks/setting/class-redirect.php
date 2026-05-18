<?php

namespace hooks\setting;

use hooks\Hook_Interface;

class Redirect implements Hook_Interface
{
    public function addAction(): void
    {
        add_action('template_redirect', array($this, 'contact_redirect_step_1'));
        add_action('template_redirect', array($this, 'order_redirect_step_1'));
    }

    public function contact_redirect_step_1()
    {
        if (is_page('contact') && !isset($_GET['step'])) {
            wp_redirect(home_url('/contact/?step=1'));
            exit();
        }
    }
    public function order_redirect_step_1()
    {
        if (is_page('order') && !isset($_GET['step'])) {
            wp_redirect(home_url('/order/?step=1'));
            exit();
        }
    }
}