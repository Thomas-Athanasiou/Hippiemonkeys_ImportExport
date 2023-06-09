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

    namespace Hippiemonkeys\ImportExport\Api\Data;

    use Hippiemonkeys\Core\Api\Data\ModelInterface;

    /**
     * @api
     */
    interface SourceInterface
    extends ModelInterface
    {
        /**
         * Gets Code
         *
         * @access public
         *
         * @return string
         */
        function getCode(): string;

        /**
         * Sets Code
         *
         * @access public
         *
         * @param string $code
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterface
         */
        function setCode(string $code): SourceInterface;

        /**
         * Gets Type
         *
         * @access public
         *
         * @return string
         */
        function getType(): string;

        /**
         * Gets Resource Locator
         *
         * @access public
         *
         * @return string
         */
        function getResourceLocator(): string;

        /**
         * Sets Source File
         *
         * @access public
         *
         * @return string
         */
        function setResourceLocator(string $resourceLocator): SourceInterface;

        /**
         * Gets Data Array
         *
         * @access public
         *
         * @return array
         */
        function getDataArray(): array;
    }
?>