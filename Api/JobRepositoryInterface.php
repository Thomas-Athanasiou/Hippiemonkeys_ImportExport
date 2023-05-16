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
        Hippiemonkeys\ImportExport\Api\Data\JobInterface,
        Hippiemonkeys\ImportExport\Api\Data\JobSearchResultInterface;

    /**
     * @api
     */
    interface JobRepositoryInterface
    {
        /**
         * Gets Job from the persitent storage by its Id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobInterface
         */
        function getById($id): JobInterface;

        /**
         * Gets list by Search Criteria
         *
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): JobSearchResultInterface;

        /**
         * Saves Job to the persitent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\JobInterface $job
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobInterface
         */
        function save(JobInterface $job): JobInterface;

        /**
         * Deletes Job from the persitent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\JobInterface $job
         *
         * @return bool
         */
        function delete(JobInterface $job): bool;
    }
?>