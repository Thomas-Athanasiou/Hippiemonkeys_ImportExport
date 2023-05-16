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

    use Magento\Framework\Api\SearchResultsInterface;

    /**
     * @api
     */
    interface FieldValueSearchResultInterface
    extends SearchResultsInterface
    {
        /**
         * Gets collection of Field Value Mapping items
         *
         * @access public
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface[]
         */
        function getItems();

        /**
         * Sets collection of Field Value Mapping items
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface[] $fieldValueMappings
         *
         * @return Hippiemonkeys\ImportExport\Api\Data\FieldValueSearchResultInterface
         */
        function setItems(array $fieldValueMappings);
    }
?>