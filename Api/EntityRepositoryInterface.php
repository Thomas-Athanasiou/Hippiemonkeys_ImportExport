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
        Hippiemonkeys\ImportExport\Api\Data\EntityInterface,
        Hippiemonkeys\ImportExport\Api\Data\EntitySearchResultInterface;

    /**
     * @api
     */
    interface EntityRepositoryInterface
    {
        /**
         * Gets Entity from the persitent storage by its Id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\EntityInterface
         */
        function getById($id): EntityInterface;

        /**
         * Gets list by Search Criteria
         *
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\EntitySearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): EntitySearchResultInterface;

        /**
         * Saves Entity to the persitent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\EntityInterface $entity
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\EntityInterface
         */
        function save(EntityInterface $entity): EntityInterface;

        /**
         * Deletes Entity from the persitent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\EntityInterface $entity
         *
         * @return bool
         */
        function delete(EntityInterface $entity): bool;
    }
?>