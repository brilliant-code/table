<?php

namespace BrilliantCode\Table\Sources;

use BrilliantCode\Table\Helpers\Arr;

final class HtmlSource extends Source
{
    /** @var array */
    private $header;

    /** @var array */
    private $rows;

    public function setHeader(array $items): self
    {
        if ($items !== []) {
            $this->header = el('tr', Arr::mapIntoElements($items, 'th'));
        }

        return $this;
    }

    public function addRow(array $items): self
    {
        $this->rows[] = el('tr', Arr::mapIntoElements($items, 'td'));

        return $this;
    }

    public function render($options = []): string
    {
        return el('table', $options,
            el('thead', $this->header).
            el('tbody', $this->rows)
        );
    }
}
