<?php

namespace ApiPlatform\Core\Tests\Swagger\SchemaFormatter;

use ApiPlatform\Core\Metadata\Property\PropertyMetadata;
use ApiPlatform\Core\Swagger\SchemaFormatter\JsonApiSchemaFormatter;
use PHPUnit\Framework\TestCase;

class JsonApiSchemaFormatterTest extends TestCase
{
    public function testSupports()
    {
        $schemaFormatter = new JsonApiSchemaFormatter();
        $this->assertTrue($schemaFormatter->supports('application/vnd.api+json'));
    }

    public function testSupportsNotSupported()
    {
        $schemaFormatter = new JsonApiSchemaFormatter();
        $this->assertFalse($schemaFormatter->supports('application/jso'));
    }

    public function testBuildBaseSchemaFormat()
    {
        $schemaFormatter = new JsonApiSchemaFormatter();
        $this->assertEquals(
            [
                'data' => [
                    'type'       => 'object',
                    'properties' => [
                        'type'       => [
                            'type' => 'string',
                        ],
                        'id'         => [
                            'type' => 'integer',
                        ],
                        'attributes' => [
                            'type'       => 'object',
                            'properties' => [],
                        ],
                    ],
                ],
            ],
            $schemaFormatter->buildBaseSchemaFormat()
        );
    }

    public function testSetProperty()
    {
        $schemaFormatter = new JsonApiSchemaFormatter();
        $definitionSchema = new \ArrayObject([]);
        $normalizedPropertyName = 'test';
        $property = new \ArrayObject([
            'test' => 'foo',
        ]);
        $propertyMetadata = new PropertyMetadata();

        $definitionSchema['properties'] = $schemaFormatter->buildBaseSchemaFormat();
        $schemaFormatter->setProperty($definitionSchema, $normalizedPropertyName, $property, $propertyMetadata);

        $this->assertEquals(
            new \ArrayObject([
                'properties' => [
                    'data' => [
                        'type'       => 'object',
                        'properties' => [
                            'type'       => [
                                'type' => 'string',
                            ],
                            'id'         => [
                                'type' => 'integer',
                            ],
                            'attributes' => [
                                'type'       => 'object',
                                'properties' => [
                                    'test' => new \ArrayObject([
                                        'test' => 'foo',
                                    ]),
                                ],
                            ],
                        ],
                    ],
                ],
            ]),
            $definitionSchema
        );
    }
}