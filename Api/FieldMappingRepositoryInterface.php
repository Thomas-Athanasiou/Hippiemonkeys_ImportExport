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

    namespace Hippiemonkeys\ImportExport\Api;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldMappingSearchResultInterface;

    /**
     * @api
     */
    interface FieldMappingRepositoryInterface
    {
        /**
         * Gets Field Mapping from the persistent storage by its Id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface
         */
        function getById($id): FieldMappingInterface;

        /**
         * Gets list by Search Criteria
         *
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldMappingSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): FieldMappingSearchResultInterface;

        /**
         * Gets list by Processor
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface $processor
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldMappingSearchResultInterface
         */
        function getListByProcessor(ProcessorInterface $processor): FieldMappingSearchResultInterface;

        /**
         * Saves Field Mapping to the persistent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface $FieldMapping
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface
         */
        function save(FieldMappingInterface $FieldMapping): FieldMappingInterface;

        /**
         * Deletes Field Mapping from the persistent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface $FieldMapping
         *
         * @return bool
         */
        function delete(FieldMappingInterface $FieldMapping): bool;
    }
?>