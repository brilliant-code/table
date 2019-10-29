<?php

namespace BrilliantCode\Table\Sources;

use League\Csv\Writer;

final class CsvSource extends Source
{
    /** @var Writer */
    private $writer;

    public function __construct()
    {
        $this->writer = Writer::createFromPath('php://temp', 'r+');
    }

    public function setHeader(array $items): self
    {
        return $this->addRow($items);
    }

    public function addRow(array $items): self
    {
        $this->writer->insertOne($items);
        return $this;
    }

    public function render(): string
    {
        return $this->writer->getContent();
    }
}
