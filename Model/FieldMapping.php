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
        Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface,
        Hippiemonkeys\ImportExport\Model\Spi\FieldMappingResourceInterface as ResourceInterface,
        Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface,
        Magento\Store\Api\StoreRepositoryInterface,
        Magento\Eav\Api\AttributeRepositoryInterface;

    class FieldMapping
    extends AbstractModel
    implements FieldMappingInterface
    {
        protected const
            FIELD_SOURCE = 'source';

            protected const
            FIELD_ENTITY = 'entity';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface $sourceRepository
         * @param \Magento\Store\Api\StoreRepositoryInterface $storeRepository
         * @param \Magento\Eav\Api\AttributeRepositoryInterface $attributeRepository
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            SourceRepositoryInterface $sourceRepository,
            StoreRepositoryInterface $storeRepository,
            AttributeRepositoryInterface $attributeRepository,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);

        }

        /**
         * {@inheritdoc}
         */
        public function getCode(): string
        {
            return $this->getData(ResourceInterface::FIELD_CODE);
        }

        /**
         * {@inheritdoc}
         */
        public function setCode(string $code): FieldMappingInterface
        {
            return $this->setData(ResourceInterface::FIELD_CODE, $code);
        }

        /**
         * {@inheritdoc}
         */
        public function getSource(): SourceInterface
        {
            $source = $this->getData(static::FIELD_SOURCE);

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
        public function setSource(SourceInterface $source): FieldMappingInterface
        {

        }

        /**
         * {@inheritdoc}
         */
        public function getStore(): StoreInterface
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
        public function setStore(StoreInterface $store): FieldMappingInterface
        {

        }

        /**
         * {@inheritdoc}
         */
        public function getAttribute(): AttributeInterface
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
        public function setAttribute(AttributeInterface $attribute): FieldMappingInterface
        {

        }

        /**
         * Source Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface $_sourceRepository
         */
        private $_sourceRepository;

        /**
         * Gets Source Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface
         */
        protected function getSourceRepository(): SourceRepositoryInterface
        {
            return $this->_sourceRepository;
        }

        /**
         * Source Repository property
         *
         * @access private
         *
         * @var \Magento\Store\Api\StoreRepositoryInterface $_sourceRepository
         */
        private $_sourceRepository;

        /**
         * Gets Source Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface
         */
        protected function getSourceRepository(): SourceRepositoryInterface
        {
            return $this->_sourceRepository;
        }


        * @param \Magento\Store\Api\StoreRepositoryInterface $storeRepository
        * @param \Magento\Eav\Api\AttributeRepositoryInterface $attributeRepository


        StoreRepositoryInterface $storeRepository,
        AttributeRepositoryInterface $attributeRepository,
    }
?>