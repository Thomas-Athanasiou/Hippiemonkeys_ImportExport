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
        Hippiemonkeys\ImportExport\Api\Data\Source\SourceInterface,
        Hippiemonkeys\ImportExport\Api\Data\Source\SourceSearchResultInterface;

    /**
     * @api
     */
    interface SourceRepositoryInterface
    {
        /**
         * Gets Source from the persitent storage by its Id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterface
         */
        function getById($id): SourceInterface;

        /**
         * Gets Source from the persitent storage by its Code
         *
         * @access public
         *
         * @param string $code
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterface
         */
        function getByCode(string $code): SourceInterface;

        /**
         * Gets list by Search Criteria
         *
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): SourceSearchResultInterface;

        /**
         * Saves Source to the persitent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterface $source
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterface
         */
        function save(SourceInterface $source): SourceInterface;

        /**
         * Deletes Source from the persitent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterface $source
         *
         * @return bool
         */
        function delete(SourceInterface $source): bool;
    }
?>