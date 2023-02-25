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

    namespace Hippiemonkeys\ImportExport\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractTableResource as AbstractResource,
        Hippiemonkeys\ImportExport\Api\Data\ValueMappingInterface,
        Hippiemonkeys\ImportExport\Model\Spi\ValueMappingResourceInterface;

    class ValueMapping
    extends AbstractResource
    implements ValueMappingResourceInterface
    {
        /**
         * {@inheritdoc}
         */
        public function saveValueMapping(ValueMappingInterface $valuemapping): ValueMappingResourceInterface
        {
            return $this->saveModel($valuemapping);
        }

        /**
         * {@inheritdoc}
         */
        public function loadValueMappingById(ValueMappingInterface $valuemapping, $id): ValueMappingResourceInterface
        {
            return $this->loadModel($valuemapping, $id, static::FIELD_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteValueMapping(ValueMappingInterface $valuemapping): bool
        {
            return $this->deleteModel($valuemapping);
        }
    }
?>