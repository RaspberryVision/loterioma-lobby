<?php declare(strict_types=1);

namespace App\Helper;

use App\Abstraction\ArrayableInterface;
use App\Helper\ArrayHelper;
use function array_keys;
use function call_user_func;
use function in_array;
use function is_array;
use function is_callable;
use function json_decode;
use function serialize;
use function unserialize;

/**
 * Serializable trait
 * implements method for interfaces: Serializable, JsonSerializable and ArrayableInterface
 *
 * DON'T TOUCH! IT'S MAGIC.
 *
 * @see https://www.php.net/manual/en/class.serializable.php
 * @see https://www.php.net/manual/en/class.jsonserializable.php
 */
trait SerializableTrait
{
    /**
     * Return object's representation as array possible to serialize by json_encode()
     * @see https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @see https://www.php.net/manual/en/serializable.serialize.php
     * @return string
     */
    public function serialize(): string
    {
        return serialize($this->toArray());
    }

    /**
     * @see https://www.php.net/manual/en/serializable.unserialize.php
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $unserializedArray = unserialize($serialized);
        $map               = $this->getSerializationMap();

        foreach ($unserializedArray as $serializationKey => $fieldData) { //a bit weird/confusing - i know...
            if (!in_array($serializationKey, array_keys($map))) {
                continue;
            }
            if (!is_array($map[$serializationKey])) {
                $this->{$map[$serializationKey]} = $fieldData;
                continue;
            }
            $fieldName = array_keys($map[$serializationKey])[0];
            $fieldType = $map[$serializationKey][$fieldName];
            if (is_callable($fieldType)) {
                $fieldType = $fieldType($unserializedArray);
            }
            $this->{$fieldName} = call_user_func([$fieldType, 'createFromArray'], $fieldData);
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $result = [];
        foreach ($this->getSerializationMap() as $key => $value) {
            $fieldName    = is_array($value) ? array_keys($value)[0] : $value;
            $result[$key] = $this->{$fieldName} instanceof ArrayableInterface
                ? $this->{$fieldName}->toArray()
                : $this->{$fieldName};
        }

        return ArrayHelper::removeEmpties($result);
    }

    /**
     * Creates object and fills it data from raw, non-serialized array,
     * @param array $array
     * @return self
     */
    public static function createFromArray(array $array): self
    {
        $instance = new static;
        $instance->unserialize(serialize($array));

        return $instance;
    }

    /**
     * @param string $json
     * @return self
     */
    public static function createFromJson(string $json): self
    {
        return static::createFromArray(json_decode($json, true));
    }

    /**
     * Serialization map
     *
     * Returns array with named keys in pairs: {key} => {fieldName}, for scalar/array fields.
     * For fields contain object, array's row should look: {key} => ['{fieldName}' => {fieldType|callback}].
     *
     * where:
     * {key} is a name of serialization key,
     * {fieldName} is name of object's property whose value is serialized with given key.
     * {fieldType} is string repesentation of field class name, for example: stdClass::class
     * {callback} is callable function to lazy load a type class name, for example from abstract factory.
     *
     * <example>
     * <code>
     *     return [
     *         'field_a' => 'fieldA',
     *         'field_b' => ['fieldB' => stdClass::class],
     *         'field_c' => ['fieldB' => function(array $unserializedArray) {
     *              if ($unserializedArray == 'abc') {
     *                  return SomeType::class;
     *              }
     *
     *              return DefaultType:: class;
     *          }]
     * </code>
     * where `$unserializedArray` is  result of unserialize() function with argument from unserialize() method's input
     * </example>
     *
     * @return array
     */
    abstract protected function getSerializationMap(): array;
}
