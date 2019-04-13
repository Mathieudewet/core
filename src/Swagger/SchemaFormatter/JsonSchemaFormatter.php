<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Core\Swagger\SchemaFormatter;

use ApiPlatform\Core\Metadata\Property\PropertyMetadata;

class JsonSchemaFormatter implements SchemaFormatterInterface
{
    public function supports(string $mimeType)
    {
        return 'application/json' === $mimeType;
    }

    public function getProperties()
    {
        return [];
    }

    public function setProperty(
        \ArrayObject $definitionSchema,
        $normalizedPropertyName,
        \ArrayObject $property,
        PropertyMetadata $propertyMetadata
    ) {
        $definitionSchema['properties'][$normalizedPropertyName] = $property;
    }
}
