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

    use Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Processor Resource interface
     */
    interface ProcessorResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_CODE = 'code';

        /**
         * Saves Processor data
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface $processor
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\ProcessorResourceInterface
         */
        function saveProcessor(ProcessorInterface $processor): ProcessorResourceInterface;

        /**
         * Loads a Processor by its Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface $processor
         * @param mixed $id
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\ProcessorResourceInterface
         */
        function loadProcessorById(ProcessorInterface $processor, $id): ProcessorResourceInterface;

        /**
         * Loads a Processor by its Code
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface $processor
         * @param string $code
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\ProcessorResourceInterface
         */
        function loadProcessorByCode(ProcessorInterface $processor, string $code): ProcessorResourceInterface;

        /**
         * Deletes the Processor
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface $processor
         *
         * @return bool
         */
        function deleteProcessor(ProcessorInterface $processor): bool;
    }
?>