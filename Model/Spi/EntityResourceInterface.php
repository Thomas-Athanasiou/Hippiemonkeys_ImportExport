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

    namespace Hippiemonkeys\ImportExport\Model\Spi;

    use Hippiemonkeys\ImportExport\Api\Data\EntityInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Entity Resource interface
     */
    interface EntityResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_ENTITY_TYPE_CODE = 'entity_type_code',
            FIELD_BEHAVIOR = 'behavior',
            FIELD_VALIDATION_STRATEGY = 'validation_strategy',
            FIELD_ALLOWED_ERROR_COUNT = 'allowed_error_count';

        /**
         * Saves Entity data
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\EntityInterface $entity
         *
         * @return $this
         */
        function saveEntity(EntityInterface $entity): EntityResourceInterface;

        /**
         * Loads a Entity by its Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\EntityInterface $entity
         * @param mixed $id
         *
         * @return $this
         */
        function loadEntityById(EntityInterface $entity, $id): EntityResourceInterface;

        /**
         * Deletes the Entity
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\EntityInterface $entity
         *
         * @return bool
         */
        function deleteEntity(EntityInterface $entity): bool;
    }
?>