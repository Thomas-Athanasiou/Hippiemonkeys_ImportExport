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

    namespace Hippiemonkeys\ImportExport\Model\Spi;

    use Hippiemonkeys\ImportExport\Api\Data\ValueMappingInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Value Mapping Resource interface
     */
    interface ValueMappingResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_CODE = 'code',
            FIELD_STORE_ID = 'store_id',
            FIELD_ATTRIBUTE_ID = 'attribute_id';

        /**
         * Saves Value Mapping data
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\ValueMappingInterface $valueMapping
         *
         * @return $this
         */
        function saveValueMapping(ValueMappingInterface $valueMapping): ValueMappingResourceInterface;

        /**
         * Loads a Value Mapping by its Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\ValueMappingInterface $valueMapping
         * @param mixed $id
         *
         * @return $this
         */
        function loadValueMappingById(ValueMappingInterface $valueMapping, $id): ValueMappingResourceInterface;

        /**
         * Deletes the Value Mapping
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\ValueMappingInterface $valueMapping
         *
         * @return bool
         */
        function deleteValueMapping(ValueMappingInterface $valueMapping): bool;
    }
?>