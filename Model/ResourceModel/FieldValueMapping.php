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
        Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface,
        Hippiemonkeys\ImportExport\Model\Spi\FieldValueMappingResourceInterface;

    class FieldValueMapping
    extends AbstractResource
    implements FieldValueMappingResourceInterface
    {
        /**
         * {@inheritdoc}
         */
        public function saveFieldValueMapping(FieldValueMappingInterface $fieldValueMapping): FieldValueMappingResourceInterface
        {
            return $this->saveModel($fieldValueMapping);
        }

        /**
         * {@inheritdoc}
         */
        public function loadFieldValueMappingById(FieldValueMappingInterface $fieldValueMapping, $id): FieldValueMappingResourceInterface
        {
            return $this->loadModel($fieldValueMapping, $id, static::FIELD_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteFieldValueMapping(FieldValueMappingInterface $fieldValueMapping): bool
        {
            return $this->deleteModel($fieldValueMapping);
        }
    }
?>