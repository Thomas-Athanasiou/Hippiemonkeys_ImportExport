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

    use Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Field Mapping Resource interface
     */
    interface FieldMappingResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_CODE = 'code',
            FIELD_SOURCE_ID = 'source_id',
            FIELD_STORE_ID = 'store_id',
            FIELD_ATTRIBUTE_CODE = 'attribute_code',
            FIELD_ATTRIBUTE_ENTITY_TYPE_ID = 'attribute_entity_type_id';

        /**
         * Saves Field Mapping data
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface $fieldMapping
         *
         * @return $this
         */
        function saveFieldMapping(FieldMappingInterface $fieldMapping): FieldMappingResourceInterface;

        /**
         * Loads a Field Mapping by its Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface $fieldMapping
         * @param mixed $id
         *
         * @return $this
         */
        function loadFieldMappingById(FieldMappingInterface $fieldMapping, $id): FieldMappingResourceInterface;

        /**
         * Deletes the Field Mapping
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface $fieldMapping
         *
         * @return bool
         */
        function deleteFieldMapping(FieldMappingInterface $fieldMapping): bool;
    }
?>