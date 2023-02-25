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

    namespace Hippiemonkeys\ImportExport\Api;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingSearchResultInterface;

    /**
     * @api
     */
    interface FieldValueMappingRepositoryInterface
    {
        /**
         * Gets Field Value Mapping from the persitent storage by its Id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface
         */
        function getById($id): FieldValueMappingInterface;

        /**
         * Gets list by Search Criteria
         *
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): FieldValueMappingSearchResultInterface;

        /**
         * Saves Field Value Mapping to the persitent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface $FieldValueMapping
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface
         */
        function save(FieldValueMappingInterface $FieldValueMapping): FieldValueMappingInterface;

        /**
         * Deletes Field Value Mapping from the persitent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface $FieldValueMapping
         *
         * @return bool
         */
        function delete(FieldValueMappingInterface $FieldValueMapping): bool;
    }
?>