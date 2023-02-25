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

    use Hippiemonkeys\Core\Api\Data\ModelInterface,
        Magento\ImportExport\Model\Import\AbstractSource;

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
         * Updates Source Data
         *
         * @access public
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterface
         */
        function updateData(): SourceInterface;

        /**
         * Gets Import Source Instance with the required parameters set
         *
         * @access public
         *
         * @return \Magento\ImportExport\Model\Import\AbstractSource
         */
        function getSource(): AbstractSource;
    }
?>