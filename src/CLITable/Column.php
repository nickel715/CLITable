<?php

namespace CLITable;

/**
 * Creates static table
 *
 * @author Nicolas Hohm
 */
class Column extends \ArrayObject {

    /**
     * Column title
     *
     * @var string
     */
    protected $title = '';

    /**
     * Column width
     *
     * @var int
     */
    protected $size = NULL;

    /**
     * Iterator object for printing
     *
     * @var \ArrayIterator
     */
    protected $staticIterrator;

    /**
     * Return static iterator
     *
     * @return \ArrayIterator
     */
    public function getIterator() {

        if (empty($this->staticIterrator)) {
            $className = $this->getIteratorClass();
            $this->staticIterrator = new $className($this);
        }

        return $this->staticIterrator;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setSize($size) {
        $this->size = $size;
        return $this;
    }

    public function getSize() {
        return $this->size;
    }

    public function hasSize() {
        return !empty($this->size);
    }

}
