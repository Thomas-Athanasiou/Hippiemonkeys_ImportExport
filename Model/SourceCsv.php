<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_ImportExport
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\ImportExport\Model;

    class SourceCsv
    extends AbstractSource
    {
        private const TYPE = 'csv';

        /**
         * {@inheritdoc}
         */
        public function getType(): string
        {
            return self::TYPE;
        }

        /**
         * {@inheritdoc}
         */
        public function getDataArray(): array
        {
            $separator = $this->getSeparator();
            $enclosure = $this->getEnclosure();
            $escape = $this->getEscape();

            $csv = array_map(
                function (string $csvRowString) use ($separator, $enclosure, $escape): array
                {
                    return str_getcsv($csvRowString, $separator, $enclosure, $escape);
                },
                explode($this->getEol(), $this->getDataString())
            );

            return $this->formatCsvToAssociativeArray($csv);
        }

        /**
         * Formats Csv to Associative Array
         *
         * @access protected
         *
         * @param array $csv
         *
         * @return array
         */
        protected function formatCsvToAssociativeArray(array $csv): array
        {
            $rowKeys = array_keys($csv);
            $rowKeyIndex = 0;

            $columnMap = [];

            foreach ($csv[$rowKeys[$rowKeyIndex++]] as $columnIndex => $columnName)
            {
                $columnMap[$columnIndex] = $columnName;
            }

            $result = [];

            $rowKeyCount = count($rowKeys);
            while($rowKeyIndex < $rowKeyCount)
            {
                $row = $csv[$rowKeys[$rowKeyIndex]];
                $result[$rowKeyIndex] = [];
                foreach ($row as $columnIndex => $value)
                {
                    $result[$rowKeyIndex][$columnMap[$columnIndex]] = $value;
                }

                $rowKeyIndex++;
            }

            return $result;
        }
    }
?>