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

    namespace Hippiemonkeys\ImportExport\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractTableResource as AbstractResource,
        Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface,
        Hippiemonkeys\ImportExport\Model\Spi\ProcessorResourceInterface;

    class Processor
    extends AbstractResource
    implements ProcessorResourceInterface
    {
        /**
         * {@inheritdoc}
         */
        public function saveProcessor(ProcessorInterface $processor): ProcessorResourceInterface
        {
            return $this->saveModel($processor);
        }

        /**
         * {@inheritdoc}
         */
        public function loadProcessorById(ProcessorInterface $processor, $id): ProcessorResourceInterface
        {
            return $this->loadModelById($processor, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function loadProcessorByCode(ProcessorInterface $processor, string $code): ProcessorResourceInterface
        {
            return $this->loadModel($processor, $code, self::FIELD_CODE);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteProcessor(ProcessorInterface $processor): bool
        {
            return $this->deleteModel($processor);
        }
    }
?>