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
        Hippiemonkeys\ImportExport\Api\Data\ProcessorSearchResultInterface;

    /**
     * @api
     */
    interface ProcessorRepositoryInterface
    {
        /**
         * Gets Processor from the persistent storage by its Id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface
         */
        function getById($id): ProcessorInterface;

        /**
         * Gets list by Search Criteria
         *
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\ProcessorSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): ProcessorSearchResultInterface;

        /**
         * Saves Processor to the persistent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface $processor
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface
         */
        function save(ProcessorInterface $processor): ProcessorInterface;

        /**
         * Deletes Processor from the persistent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface $processor
         *
         * @return bool
         */
        function delete(ProcessorInterface $processor): bool;
    }
?>