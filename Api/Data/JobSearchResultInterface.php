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

    use Magento\Framework\Api\SearchResultsInterface;

    /**
     * @api
     */
    interface JobSearchResultInterface
    extends SearchResultsInterface
    {
        /**
         * Gets collection of Job items
         *
         * @access public
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobInterface[]
         */
        function getItems();

        /**
         * Sets collection of Import items
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\JobInterface[] $jobs
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobSearchResultInterface
         */
        function setItems(array $jobs);
    }
?>