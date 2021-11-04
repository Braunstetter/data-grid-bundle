<?php

namespace Braunstetter\DataGridBundle;

use Braunstetter\DataGridBundle\Contracts\GridConfigBuilderInterface;
use Braunstetter\DataGridBundle\Contracts\GridFactoryInterface;
use Braunstetter\DataGridBundle\Contracts\GridTypeInterface;
use InvalidArgumentException;

class GridConfigBuilder implements GridConfigBuilderInterface
{
    private string $name;
    private GridTypeInterface $type;
    private array $options;
    private GridFactoryInterface $gridFactory;
    private iterable $data;
    protected array $fields;

    /**
     * Creates an empty form configuration.
     *
     * @param string|null $name The form name
     *
     * @throws InvalidArgumentException if the data class is not a valid class or if
     *                                  the name contains invalid characters
     */
    public function __construct(?string $name, array $options = [])
    {
        self::validateName($name);

        $this->name = (string)$name;
        $this->options = $options;
    }

    public function getGridConfig(): GridConfigBuilder
    {
        // This method should be idempotent, so clone the builder
        return clone $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param GridTypeInterface $type
     */
    public function setType(GridTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * @return GridTypeInterface
     */
    public function getType(): GridTypeInterface
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return GridFactoryInterface
     */
    public function getGridFactory(): GridFactoryInterface
    {
        return $this->gridFactory;
    }

    /**
     * @param GridFactoryInterface $gridFactory
     * @return GridConfigBuilder
     */
    public function setGridFactory(GridFactoryInterface $gridFactory): GridConfigBuilder
    {
        $this->gridFactory = $gridFactory;
        return $this;
    }

    /**
     * Validates whether the given variable is a valid form name.
     *
     * @throws InvalidArgumentException if the name contains invalid characters
     *
     * @internal
     */
    final public static function validateName(?string $name)
    {
        if (!self::isValidName($name)) {
            throw new InvalidArgumentException(sprintf('The name "%s" contains illegal characters. Names should start with a letter, digit or underscore and only contain letters, digits, numbers, underscores ("_"), hyphens ("-") and colons (":").', $name));
        }
    }

    /**
     * Returns whether the given variable contains a valid form name.
     *
     * A name is accepted if it
     *
     *   * is empty
     *   * starts with a letter, digit or underscore
     *   * contains only letters, digits, numbers, underscores ("_"),
     *     hyphens ("-") and colons (":")
     */
    final public static function isValidName(?string $name): bool
    {
        return '' === $name || null === $name || preg_match('/^[a-zA-Z0-9_][a-zA-Z0-9_\-:]*$/D', $name);
    }

    /**
     * @param iterable $data
     * @return GridConfigBuilder
     */
    public function setData(iterable $data): GridConfigBuilder
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return iterable
     */
    public function getData(): iterable
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

}