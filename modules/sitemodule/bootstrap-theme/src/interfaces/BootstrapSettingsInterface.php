<?php
namespace Ryssbowh\BootstrapTheme\interfaces;

interface BootstrapSettingsInterface
{
    /**
     * Name getter
     * 
     * @return string
     */
    public function getName(): string;

    /**
     * Handle getter
     * 
     * @return string
     */
    public function getHandle(): string;
}