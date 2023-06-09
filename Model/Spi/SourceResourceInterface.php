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

    namespace Hippiemonkeys\ImportExport\Model\Spi;

    use Hippiemonkeys\ImportExport\Api\Data\SourceInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Source Resource interface
     */
    interface SourceResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_CODE = 'code',
            FIELD_TYPE = 'type',
            FIELD_SOURCE_FILE_LOCATION = 'resource_locator';

        /**
         * Saves Source data
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterface $source
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\SourceResourceInterface
         */
        function saveSource(SourceInterface $source): SourceResourceInterface;

        /**
         * Loads a Source by its Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterface $source
         * @param mixed $id
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\SourceResourceInterface
         */
        function loadSourceById(SourceInterface $source, $id): SourceResourceInterface;

        /**
         * Loads a Source by its Code
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterface $source
         * @param string $code
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\SourceResourceInterface
         */
        function loadSourceByCode(SourceInterface $source, string $code): SourceResourceInterface;

        /**
         * Deletes the Source
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterface $source
         *
         * @return bool
         */
        function deleteSource(SourceInterface $source): bool;
    }
?>