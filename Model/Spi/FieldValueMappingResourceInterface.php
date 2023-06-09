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

    namespace Hippiemonkeys\ImportExport\Model\Spi;

    use Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Value Mapping Resource interface
     */
    interface FieldValueMappingResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_SOURCE_VALUE = 'source_value',
            FIELD_DESTINATION_VALUE = 'destination_value',
            FIELD_FIELD_MAPPING_ID = 'field_mapping_id';

        /**
         * Saves Field Value Mapping data
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface $FieldValueMapping
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\FieldValueMappingResourceInterface
         */
        function saveFieldValueMapping(FieldValueMappingInterface $FieldValueMapping): FieldValueMappingResourceInterface;

        /**
         * Loads a Value Mapping by its Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface $FieldValueMapping
         * @param mixed $id
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\FieldValueMappingResourceInterface
         */
        function loadFieldValueMappingById(FieldValueMappingInterface $FieldValueMapping, $id): FieldValueMappingResourceInterface;

        /**
         * Deletes the Value Mapping
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface $FieldValueMapping
         *
         * @return bool
         */
        function deleteFieldValueMapping(FieldValueMappingInterface $FieldValueMapping): bool;
    }
?>