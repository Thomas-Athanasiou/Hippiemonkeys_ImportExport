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

    namespace Hippiemonkeys\ImportExport\Model;

    use Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\ImportExport\Api\Data\EntityInterface,
        Magento\ImportExport\Model\Import\Entity\Factory as EntityFactory,
        Magento\ImportExport\Model\Import\AbstractEntity,
        Hippiemonkeys\ImportExport\Model\Spi\EntityResourceInterface as ResourceInterface,
        Magento\ImportExport\Model\Import\ConfigInterface as ImportConfigInterface;

    class Entity
    extends AbstractModel
    implements EntityInterface
    {
        protected const
            FIELD_ENTITY = 'entity';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Magento\ImportExport\Model\Import\ConfigInterface $importConfig
         * @param \Magento\ImportExport\Model\Import\Entity\Factory $entityFactory
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            ImportConfigInterface $importConfig,
            EntityFactory $entityFactory,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);
            $this->_importConfig = $importConfig;
            $this->_entityFactory = $entityFactory;
        }

        /**
         * {@inheritdoc}
         */
        public function getBehavior(): string
        {
            return $this->getData(ResourceInterface::FIELD_BEHAVIOR);
        }

        /**
         * {@inheritdoc}
         */
        public function setBehavior(string $behavior): EntityInterface
        {
            return $this->setData(ResourceInterface::FIELD_BEHAVIOR, $behavior);
        }

        /**
         * {@inheritdoc}
         */
        public function getValidationStrategy(): string
        {
            return $this->getData(ResourceInterface::FIELD_VALIDATION_STRATEGY);
        }

        /**
         * {@inheritdoc}
         */
        public function setValidationStrategy(string $validationStrategy): EntityInterface
        {
            return $this->setData(ResourceInterface::FIELD_VALIDATION_STRATEGY, $validationStrategy);
        }

        /**
         * {@inheritdoc}
         */
        public function getAllowedErrorCount(): int
        {
            return (int) $this->getData(ResourceInterface::FIELD_ALLOWED_ERROR_COUNT);
        }

        /**
         * {@inheritdoc}
         */
        public function setAllowedErrorCount(int $allowedErrorCount): EntityInterface
        {
            return $this->setData(ResourceInterface::FIELD_ALLOWED_ERROR_COUNT, $allowedErrorCount);
        }

        /**
         * {@inheritdoc}
         *
         * @todo fields_enclosure
         * @todo import_file
         * @todo import_images_file_dir
         * @todo import_image_archive
         */
        public function configureEntity(): EntityInterface
        {
            $this->getEntity()->setParameters(
                [
                    'behavior' => $this->getBehavior(),
                    'allowed_error_count' => $this->getAllowedErrorCount(),
                    'validation_strategy' => $this->getValidationStrategy()
                ]
            );

            return $this;
        }

        /**
         * Gets Entity Type Code
         *
         * @access protected
         *
         * @return string
         */
        protected function getEntityTypeCode(): string
        {
            return $this->getData(ResourceModel::FIELD_ENTITY_TYPE_CODE);
        }

        /**
         * Sets Entity Type Code
         *
         * @access protected
         *
         * @param string $entityTypeCode
         *
         * @return \Hippiemonkeys\ImportExport\Model\Entity
         */
        protected function setEntityTypeCode(string $entityTypeCode): Entity
        {
            return $this->setData(ResourceModel::FIELD_ENTITY_TYPE_CODE, $entityTypeCode);
        }

        /**
         * {@inheritdoc}
         */
        public function getEntity(): AbstractEntity
        {
            $entity = $this->getData(static::FIELD_ENTITY);

            if($entity === null)
            {
                $entity = $this->getEntityFactory()->create(
                    $this->getImportConfig()->getEntities() [$this->getEntityTypeCode()]['model']
                );
                $this->setData(static::FIELD_ENTITY, $entity);
            }

            return $entity;
        }

        /**
         * {@inheritdoc}
         */
        public function setEntity(AbstractEntity $entity): EntityInterface
        {
            return $this->setEntityTypeCode($entity->getEntityTypeCode())->setData(static::FIELD_ENTITY, $entity);
        }

        /**
         * Import Config property
         *
         * @access private
         *
         * @var \Magento\ImportExport\Model\Import\ConfigInterface $_importConfig
         */
        private $_importConfig;

        /**
         * Gets Import Config
         *
         * @access protected
         *
         * @return \Magento\ImportExport\Model\Import\ConfigInterface
         */
        protected function getImportConfig(): ImportConfigInterface
        {
            return $this->_importConfig;
        }

        /**
         * Entity Factory property
         *
         * @access private
         *
         * @var \Magento\ImportExport\Model\Import\Entity\Factory $_entityFactory
         */
        private $_entityFactory;

        /**
         * Gets Entity Factory
         *
         * @access protected
         *
         * @return \Magento\ImportExport\Model\Import\Entity\Factory
         */
        protected function getEntityFactory(): EntityFactory
        {
            return $this->_entityFactory;
        }
    }
?>