<?php

namespace CLITable;

/**
 * Creates static table
 *
 * @author Nicolas Hohm
 */
class Table
{

    const DEFAULT_COL_SIZE = 40;

    /**
     * Table data
     *
     * @var \ArrayObject
     */
    protected $data;

    /**
     * Col width for every column
     *
     * @var int
     */
    protected $colSize = self::DEFAULT_COL_SIZE;

    public function __construct($colSize = self::DEFAULT_COL_SIZE) {
        $this->data = new \ArrayObject();
        $this->colSize = $colSize;
    }

    /**
     * Col size in char for every column
     *
     * @param int $size
     */
    public function setColSize($size) {
        $this->colSize = $size;
        return $this;
    }

    public function getColSize(Column $col) {
        return $col->hasSize() ? $col->getSize() : $this->colSize;
    }

    public function addColumn(Column $column) {
        $this->data->append($column);
        return $this;
    }

    /**
     * Print the table
     */
    public function printTable() {

        $this->printHeadline();

        // Go for it

        do {

            $valid = false;
            $output = '| ';

            foreach ($this->data AS $col) {

                $iterator = $col->getIterator();
                $colSize  = $this->getColSize($col);

                if ($iterator->valid()) {
                    $output .= sprintf('%-'.$colSize.'.'.$colSize.'s', $iterator->current());
                    $valid = true;
                } else {
                    $output .= str_pad('-', $colSize);
                }

                $iterator->next();

                $output .= ' | ';

            }

            if ($valid)
                echo $output, PHP_EOL;

        } while ($valid);

        echo '|', str_repeat('-', $this->rowSize-2), '|', PHP_EOL;

        return $this;

    }

    protected function printHeadline() {

        $rowSize = 2;
        echo '| ';

        foreach ($this->data AS $col) {
            $rowSize += 3 + $size = $this->getColSize($col);
            printf('%-'.$size.'.'.$size.'s | ', $col->getTitle());
        }

        $this->rowSize = $rowSize-1;

        echo PHP_EOL, '|', str_repeat('-', $this->rowSize-2), '|', PHP_EOL;

        return $this;

    }

}