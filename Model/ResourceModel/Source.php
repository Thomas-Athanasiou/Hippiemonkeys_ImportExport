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
        Hippiemonkeys\ImportExport\Api\Data\SourceInterface,
        Hippiemonkeys\ImportExport\Model\Spi\SourceResourceInterface;

    class Source
    extends AbstractResource
    implements SourceResourceInterface
    {
        /**
         * {@inheritdoc}
         */
        public function saveSource(SourceInterface $source): SourceResourceInterface
        {
            return $this->saveModel($source);
        }

        /**
         * {@inheritdoc}
         */
        public function loadSourceById(SourceInterface $source, $id): SourceResourceInterface
        {
            return $this->loadModelById($source, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function loadSourceByCode(SourceInterface $source, string $code): SourceResourceInterface
        {
            return $this->loadModel($source, $code, static::FIELD_CODE);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteSource(SourceInterface $source): bool
        {
            return $this->deleteModel($source);
        }
    }
?>