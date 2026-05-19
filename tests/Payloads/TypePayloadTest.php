<?php

namespace ScoutElastic\Tests\Payloads;

use ScoutElastic\Payloads\TypePayload;
use ScoutElastic\Tests\AbstractTestCase;
use ScoutElastic\Tests\Dependencies\Model;

class TypePayloadTest extends AbstractTestCase
{
    use Model;

    public function testDefault()
    {
        $model = $this->mockModel();
        $payload = new TypePayload($model);

        $this->assertSame(
            [
                'index' => 'test',
            ],
            $payload->get()
        );
    }

    public function testSet()
    {
        $indexConfigurator = $this->mockIndexConfigurator([
            'name' => 'foo',
        ]);

        $model = $this->mockModel([
            'searchable_as' => 'bar',
            'index_configurator' => $indexConfigurator,
        ]);

        $payload = (new TypePayload($model))
            ->set('index', 'test_index')
            ->set('body', []);

        $this->assertSame(
            [
                'index' => 'foo',
                'body' => [],
            ],
            $payload->get()
        );
    }
}
