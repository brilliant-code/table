<?php

namespace BrilliantCode\Table\Sources;

abstract class Source
{
    protected $content;

    abstract function setHeader(array $items);

    abstract function addRow(array $items);

    abstract function render(): string;
}
