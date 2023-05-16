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
        Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface,
        Hippiemonkeys\ImportExport\Model\Spi\FieldMappingResourceInterface;

    class FieldMapping
    extends AbstractResource
    implements FieldMappingResourceInterface
    {
        /**
         * {@inheritdoc}
         */
        public function saveFieldMapping(FieldMappingInterface $fieldMapping): FieldMappingResourceInterface
        {
            return $this->saveModel($fieldMapping);
        }

        /**
         * {@inheritdoc}
         */
        public function loadFieldMappingById(FieldMappingInterface $fieldMapping, $id): FieldMappingResourceInterface
        {
            return $this->loadModel($fieldMapping, $id, static::FIELD_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteFieldMapping(FieldMappingInterface $fieldMapping): bool
        {
            return $this->deleteModel($fieldMapping);
        }
    }
?>