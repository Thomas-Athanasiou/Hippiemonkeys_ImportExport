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

    namespace Hippiemonkeys\ImportExport\Api\Data\Source;

    use Hippiemonkeys\ImportExport\Api\Data\SourceInterface;

    /**
     * @api
     */
    interface CsvInterface
    extends SourceInterface
    {
        /**
         * Gets Separator
         *
         * @access public
         *
         * @return string
         */
        function getSeparator(): string;

        /**
         * Sets Separator
         *
         * @access public
         *
         * @param string $separator
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\Source\CsvInterface
         */
        function setSeparator(string $separator): CsvInterface;

        /**
         * Gets Enclosure
         *
         * @access public
         *
         * @return string
         */
        function getEnclosure(): string;

        /**
         * Sets Enclosure
         *
         * @access public
         *
         * @param string $enclosure
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\Source\CsvInterface
         */
        function setEnclosure(string $enclosure): CsvInterface;

        /**
         * Gets Escape
         *
         * @access public
         *
         * @return string
         */
        function getEscape(): string;

        /**
         * Sets Escape
         *
         * @access public
         *
         * @param string $escape
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\Source\CsvInterface
         */
        function setEscape(string $escape): CsvInterface;
    }
?>