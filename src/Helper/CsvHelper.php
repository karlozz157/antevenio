<?php

namespace Antevenio\Helper;

class CsvHelper
{
    /**
     * @const string
     */
    const WRITE_MODE = 'w';

    /**
     * @var array $columnNames
     */
    protected $columnNames = [];

    /**
     * @var string $filename
     */
    protected $filename;

    /**
     * @var array $rows
     */
    protected $rows = [];

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @param array $columnNames
     *
     * @return $this
     */
    public function setColumnNames(array $columnNames = [])
    {
        $this->columnNames = $columnNames;

        return $this;
    }

    /**
     * @param array $row
     *
     * @return $this
     */
    public function addRow(array $row = [])
    {
        $this->rows[] = $row;

        return $this;
    }

    /**
     * @return void
     */
    public function save()
    {
        $file = fopen($this->filename, self::WRITE_MODE);

        if ($this->columnNames) {
            fputcsv($file, $this->columnNames);
        }

        foreach ($this->rows as $row) {
            fputcsv($file, $row);
        }

        fclose($file);
    }
}
