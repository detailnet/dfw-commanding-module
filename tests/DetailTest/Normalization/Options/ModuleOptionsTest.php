<?php

namespace DetailTest\Commanding\Options;

class ModuleOptionsTest extends OptionsTestCase
{
    /**
     * @var \Detail\Commanding\Options\ModuleOptions
     */
    protected $options;

    protected function setUp()
    {
        $this->options = $this->getOptions(
            'Detail\Commanding\Options\ModuleOptions',
            array(
                'getNormalizer',
                'setNormalizer',
                'getJobBuilder',
                'setJobBuilder',
            )
        );
    }

    public function testNormalizerCanBeSet()
    {
        $normalizer = 'Some\Normalizer\Class';

        $this->assertNull($this->options->getNormalizer());

        $this->options->setNormalizer($normalizer);

        $this->assertEquals($normalizer, $this->options->getNormalizer());
    }
}
