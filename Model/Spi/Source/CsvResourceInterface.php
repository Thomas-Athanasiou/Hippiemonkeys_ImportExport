<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Inteligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_ImportExport
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\ImportExport\Model\Spi\Source;

    use Hippiemonkeys\ImportExport\Api\Data\Source\CsvInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Csv Resource interface
     */
    interface CsvResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_CODE = 'code';

        /**
         * Saves Csv data
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\CsvInterface $job
         *
         * @return $this
         */
        function saveCsv(CsvInterface $job): CsvResourceInterface;

        /**
         * Loads a Csv by its Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\CsvInterface $job
         * @param mixed $id
         *
         * @return $this
         */
        function loadCsvById(CsvInterface $job, $id): CsvResourceInterface;

        /**
         * Loads a Csv by its Code
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\CsvInterface $job
         * @param string $code
         *
         * @return $this
         */
        function loadCsvByCode(CsvInterface $job, string $code): CsvResourceInterface;

        /**
         * Deletes the Csv
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\CsvInterface $job
         *
         * @return bool
         */
        function deleteCsv(CsvInterface $job): bool;
    }
?>