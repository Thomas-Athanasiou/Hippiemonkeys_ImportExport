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

    namespace Hippiemonkeys\ImportExport\Api\Data\Source;

    use Hippiemonkeys\ImportExport\Api\Data\SourceSearchResultInterface;

    /**
     * @api
     */
    interface CsvSearchResultInterface
    extends SourceSeachResultInterface
    {
        /**
         * Gets collection of Import items
         *
         * @access public
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\Source\CsvInterfaceInterface[]
         */
        function getItems();

        /**
         * Sets collection of Import items
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\Source\CsvInterfaceInterface[] $csvs
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\ImportSearchResultInterface
         */
        function setItems(array $csvs);
    }
?>