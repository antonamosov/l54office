<?php

namespace App\Classes;

class FilterContent
{
    const START = '{';
    const END = '}';

    const ACTION_WITHOUT_CHANGES = 'withoutChanges';
    const ACTION_TO_DATE = 'toDate';
    const ACTION_USE_CONFIG_FILE = 'useConfigFile';
    const ACTION_USE_CONFIG_FILE_FOR_LIST_VALUE = 'useConfigFileForListValue';
    const ACTION_USE_EXTERNAL_PRICE = 'useExternalPrice';

    private $columns;
    private $source;
    private $settings;
    private $option;
    private $column;
    private $externalVars;


    public function __construct(array $settings, array $columns, $source = '', array $externalVars = [])
    {
        $this->columns = $columns;
        $this->settings = $settings;
        $this->source = $source;
        $this->externalVars = $externalVars;
    }

    public function filter()
    {
        foreach ($this->settings as $option) {
            $this->replaceColumnInSource($option);
        }

        return $this->source;
    }

    public function setSource($source)
    {
        $this->source = $source;
    }

    private function replaceColumnInSource($option)
    {
        $this->option = $option;
        $this->column = $option['column'];
        $action = $this->howToReFormat();
        $valueOfColumn = $this->getNewValueForColumn($action);
        $this->updateColumnInSource($valueOfColumn);
    }
    
    private function updateColumnInSource($valueOfColumn)
    {
        $this->source = str_replace($this->getOriginalValueFromSource(), $valueOfColumn, $this->source);
    }

    private function getDefaultValueOfOption()
    {
        return $this->option['default'];
    }

    private function getOriginalValueFromSource()
    {
        return self::START . $this->option['name'] . self::END;
    }

    private function getConfigFileName()
    {
        return $this->option['config_name'];
    }

    private function getValueWithoutChanges()
    {
        if ($this->checkNeedToReplace()) {
            return isset($this->columns[$this->column]) ? $this->columns[$this->column] : $this->getDefaultValueOfOption();
        }
        else {
            return $this->getDefaultValueOfOption();
        }
    }

    private function checkNeedToReplace()
    {
        return $this->column ? true : false;
    }

    private function getNewValueChangedToDate()
    {
        return date('d/m/Y', strtotime($this->getValueWithoutChanges()));
    }

    private function getNewValueFromConfigFile()
    {
        return config($this->getConfigFileName() . "." . $this->getValueWithoutChanges());
    }

    private function getNewValueFromConfigFileForListColumn()
    {
        $values = explode(',', $this->getValueWithoutChanges());
        $value = [];
        foreach ($values as $key => $val) {
            $value[] = config($this->getConfigFileName() . "." . $val);
        }
        $value = implode(', ', $value);

        return $value;
    }

    private function getSessionPrice()
    {
        return isset($this->externalVars['price']) ? $this->externalVars['price'] : 0;
    }

    private function getNewValueForColumn($action)
    {
        switch ($action) {
            case self::ACTION_WITHOUT_CHANGES:
              $valueOfColumn = $this->getValueWithoutChanges();
              break;
            case self::ACTION_TO_DATE:
                $valueOfColumn = $this->getNewValueChangedToDate();
                break;
            case self::ACTION_USE_CONFIG_FILE:
                $valueOfColumn = $this->getNewValueFromConfigFile();
                break;
            case self::ACTION_USE_CONFIG_FILE_FOR_LIST_VALUE:
                $valueOfColumn = $this->getNewValueFromConfigFileForListColumn();
                break;
            case self::ACTION_USE_EXTERNAL_PRICE:
                $valueOfColumn = $this->getSessionPrice();
                break;
        }

        if (isset($valueOfColumn)) {
            return $valueOfColumn ? $valueOfColumn : $this->getDefaultValueOfOption();
        }
        else {
            return $this->getValueWithoutChanges();
        }
    }

    private function howToReFormat()
    {
        $option = $this->option;
        $howToReFormat = $option['re_format'];
        if ( ! $howToReFormat) {
            $action = self::ACTION_WITHOUT_CHANGES;
        }
        if ($howToReFormat) {
            if ($howToReFormat === 'date') {
                $action = self::ACTION_TO_DATE;
            }
            elseif ($howToReFormat === 'config') {
                $action = self::ACTION_USE_CONFIG_FILE;
            }
            elseif ($howToReFormat === 'config_multi') {
                $action = self::ACTION_USE_CONFIG_FILE_FOR_LIST_VALUE;
            }
            elseif (str_contains($howToReFormat, 'external_')) {
                $action = self::ACTION_USE_EXTERNAL_PRICE;
            }
        }

        return $action;
    }
}
