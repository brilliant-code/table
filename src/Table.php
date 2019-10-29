<?php

namespace BrilliantCode\Table;

use BrilliantCode\Table\Sources\{CsvSource, HtmlSource, Source};
use Exception;

abstract class Table
{
    /** @var array */
    protected $renderOptions = [];

    abstract function query(): array;

    public function columns(): array
    {
        return [];
    }

    public function sources(): array
    {
        return [CsvSource::class, HtmlSource::class];
    }

    abstract function handle(Source $sourceClass);

    public function display($sourceClass): string
    {
        foreach ($this->query() as $key => $value){
            $this->{$key} = $value;
        }

        if (!in_array($sourceClass, $this->sources())){
            throw new Exception("Source $sourceClass does not exist in sources method");
        }

        /** @var $source Source */
        $source = new $sourceClass;
        $source->setHeader($this->columns());
        return $this->handle($source)->render($this->renderOptions);
    }
}
