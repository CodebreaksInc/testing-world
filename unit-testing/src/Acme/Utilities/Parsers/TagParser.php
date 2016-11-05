<?php

namespace Acme\Utilities\Parsers;

class TagParser
{
    public function parse($tags, $delimiter = ",")
    {
        return preg_split("/\s?".preg_quote($delimiter)."\s?/", $tags);
    }
}
