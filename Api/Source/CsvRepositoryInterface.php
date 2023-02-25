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

    namespace Hippiemonkeys\ImportExport\Api\Source;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Hippiemonkeys\ImportExport\Api\Data\Source\CsvInterface,
        Hippiemonkeys\ImportExport\Api\Data\Source\CsvSearchResultInterface;

    /**
     * @api
     */
    interface CsvRepositoryInterface
    {
        /**
         * Gets Csv from the persitent storage by its Id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\CsvInterface
         */
        function getById($id): CsvInterface;

        /**
         * Gets list by Search Criteria
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\ZoneInterface $zone
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\ZoneCsvRelationSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): CsvSearchResultInterface;

        /**
         * Saves Csv to the persitent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\CsvInterface $csv
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\CsvInterface
         */
        function save(CsvInterface $csv): CsvInterface;

        /**
         * Deletes Csv from the persitent storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\CsvInterface $csv
         *
         * @return bool
         */
        function delete(CsvInterface $csv): bool;
    }
?>