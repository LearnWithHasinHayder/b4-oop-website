<?php

/**
 * Base abstract class for all page sections.
 * 
 * This class handles:
 * 1. Data injection via constructor
 * 2. Visibility logic (encapsulation)
 * 3. Enforcing a render contract (polymorphism)
 */
abstract class Section
{
    protected $data;
    protected $visible;

    /**
     * @param array $data The data specific to this section from the JSON file
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        // Default to true if 'visible' key is missing, otherwise use the value
        $this->visible = $data['visible'] ?? true;
    }

    /**
     * Determines if the section should be rendered.
     * 
     * @return bool
     */
    public function shouldRender(): bool
    {
        return $this->visible === true;
    }

    /**
     * The public method called by the main application.
     * It handles the visibility check so the calling code doesn't have to.
     */
    public function render(): void
    {
        if ($this->shouldRender()) {
            $this->renderContent();
        }
    }

    /**
     * Abstract method that child classes must implement to output their specific HTML.
     */
    abstract protected function renderContent(): void;
}
