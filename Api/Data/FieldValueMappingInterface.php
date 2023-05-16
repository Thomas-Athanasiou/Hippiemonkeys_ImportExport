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

    namespace Hippiemonkeys\ImportExport\Api\Data;

    use Hippiemonkeys\Core\Api\Data\ModelInterface;

    /**
     * @api
     */
    interface FieldValueMappingInterface
    extends ModelInterface
    {
        /**
         * Gets Source Value
         *
         * @access public
         *
         * @return string
         */
        function getSourceValue(): string;

        /**
         * Sets Source Value
         *
         * @access public
         *
         * @param string $sourceValue
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface
         */
        function setSourceValue(string $sourceValue): FieldValueMappingInterface;

        /**
         * Gets Destination Value
         *
         * @access public
         *
         * @return string
         */
        function getDestinationValue(): string;

        /**
         * Sets Destination Value
         *
         * @access public
         *
         * @param string $destinationValue
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface
         */
        function setDestinationValue(string $destinationValue): FieldValueMappingInterface;

        /**
         * Gets Field Mapping
         *
         * @access public
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface
         */
        function getFieldMapping(): FieldMappingInterface;

        /**
         * Sets Field Mapping
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface $fieldMapping
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface
         */
        function setFieldMapping(FieldMappingInterface $fieldMapping): FieldValueMappingInterface;
    }
?>