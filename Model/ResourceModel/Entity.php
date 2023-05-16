<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_ImportExport
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\ImportExport\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractTableResource as AbstractResource,
        Hippiemonkeys\ImportExport\Api\Data\EntityInterface,
        Hippiemonkeys\ImportExport\Model\Spi\EntityResourceInterface;

    class Entity
    extends AbstractResource
    implements EntityResourceInterface
    {
        /**
         * {@inheritdoc}
         */
        public function saveEntity(EntityInterface $entity): EntityResourceInterface
        {
            return $this->saveModel($entity);
        }

        /**
         * {@inheritdoc}
         */
        public function loadEntityById(EntityInterface $entity, $id): EntityResourceInterface
        {
            return $this->loadModel($entity, $id, static::FIELD_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteEntity(EntityInterface $entity): bool
        {
            return $this->deleteModel($entity);
        }
    }
?>