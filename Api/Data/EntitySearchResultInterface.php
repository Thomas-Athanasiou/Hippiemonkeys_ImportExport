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
    interface EntitySearchResultInterface
    extends SearchResultsInterface
    {
        /**
         * Gets collection of Entity items
         *
         * @access public
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterface[]
         */
        function getItems();

        /**
         * Sets collection of Entity items
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterface[] $entities
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\EntitySearchResultInterface
         */
        function setItems(array $entities);
    }
?>