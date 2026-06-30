<?php

namespace hooks;

/**
 * Setting 配下のフッククラスが満たすべき契約
 */
interface Hook_Interface
{
    public function addAction(): void;
}
