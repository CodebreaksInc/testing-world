<?php

namespace spec\Acme\Utilities\Parsers;

use Acme\Utilities\Parsers\TagParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TagParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TagParser::class);
    }

    public function it_parse_a_string()
    {
    	$this->parse("pierre,papier,ciseaux")->shouldReturn(['pierre', 'papier', 'ciseaux']);
    }

    public function it_allows_custom_delimiter()
    {
    	$this->parse("pierre|papier|ciseaux", "|")->shouldReturn(['pierre', 'papier', 'ciseaux']);	
    }

    public function it_removes_spaces_before_and_after_delimiter()
    {
    	$this->parse("pierre| papier |ciseaux", "|")->shouldReturn(['pierre', 'papier', 'ciseaux']);
    	$this->parse("pierre papier  ciseaux", " ")->shouldReturn(['pierre', 'papier', 'ciseaux']);
    }
}
