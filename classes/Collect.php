<?php

namespace Classes;

class Collect
{
    /**
     * @var array
     */
    public array $param;

    /**
     * Collect constructor.
     * @param array|self $param.
     * @return self
     */
    public function Collect(self|array $param): self
    {
        $this->param = $param instanceOf self
            ? $param->getParam()
            : $param;

        return $this;
    }

    /**
     * Returns parameter.
     * @return array
     */
    public function getParam(): array
    {
        return $this->param;
    }

    public function flatten($depth = null): array
    {
        return flatten($this->param, $depth);
    }
}
