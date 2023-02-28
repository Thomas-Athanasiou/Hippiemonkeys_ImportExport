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

    namespace Hippiemonkeys\ImportExport\Api\Data;

    use Hippiemonkeys\Core\Api\Data\ModelInterface,
        Magento\Eav\Api\Data\AttributeInterface,
        Magento\Store\Api\Data\StoreInterface;

    /**
     * @api
     */
    interface FieldMappingInterface
    extends ModelInterface
    {
        /**
         * Gets Code
         *
         * @access public
         *
         * @return string
         */
        function getCode(): string;

        /**
         * Sets Code
         *
         * @access public
         *
         * @param string $Code
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface
         */
        function setCode(string $code): FieldMappingInterface;

        /**
         * Gets the Source the Field Mapping aplies for
         *
         * @access public
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterface
         */
        function getSource(): SourceInterface;

        /**
         * Sets the Source the Field Mapping aplies for
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterface $source
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface
         */
        function setSource(SourceInterface $source): FieldMappingInterface;

        /**
         * Gets the Store the Field Mapping aplies for
         *
         * @access public
         *
         * @return \Magento\Store\Api\Data\StoreInterface
         */
        function getStore(): StoreInterface;

        /**
         * Sets the Store the Field Mapping aplies for
         *
         * @access public
         *
         * @param \Magento\Store\Api\Data\StoreInterface $store
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface
         */
        function setStore(StoreInterface $store): FieldMappingInterface;

        /**
         * Gets the Attribute the Field Mapping aplies for
         *
         * @access public
         *
         * @return \Magento\Eav\Api\Data\AttributeInterface
         */
        function getAttribute(): AttributeInterface;

        /**
         * Sets the Attribute the Field Mapping aplies for
         *
         * @access public
         *
         * @param \Magento\Eav\Api\Data\AttributeInterface $store
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface
         */
        function setAttribute(AttributeInterface $attribute): FieldMappingInterface;
    }
?>