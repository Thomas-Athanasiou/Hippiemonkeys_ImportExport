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

    namespace Hippiemonkeys\ImportExport\Model;

    use Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface,
        Hippiemonkeys\ImportExport\Model\Spi\FieldMappingResourceInterface as ResourceInterface,
        Hippiemonkeys\ImportExport\Api\Data\SourceInterface,
        Hippiemonkeys\ImportExport\Api\ProcessorRepositoryInterface,
        Magento\Framework\Registry,
        Magento\Framework\Model\Context,
        Magento\Store\Api\Data\StoreInterface,
        Magento\Store\Api\StoreRepositoryInterface,
        Magento\Eav\Api\Data\AttributeInterface,
        Magento\Eav\Api\AttributeRepositoryInterface;

    class FieldMapping
    extends AbstractModel
    implements FieldMappingInterface
    {
        protected const
            FIELD_SOURCE = 'source',
            FIELD_STORE = 'store',
            FIELD_ATTRIBUTE = 'attribute';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\ImportExport\Api\ProcessorRepositoryInterface $processorRepository
         * @param \Magento\Store\Api\StoreRepositoryInterface $storeRepository
         * @param \Magento\Eav\Api\AttributeRepositoryInterface $attributeRepository
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            ProcessorRepositoryInterface $processorRepository,
            StoreRepositoryInterface $storeRepository,
            AttributeRepositoryInterface $attributeRepository,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);

            $this->_processorRepository = $processorRepository;
            $this->_storeRepository = $storeRepository;
            $this->_attributeRepository = $attributeRepository;
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
        public function setCode(string $code): self
        {
            return $this->setData(ResourceInterface::FIELD_CODE, $code);
        }

        /**
         * {@inheritdoc}
         */
        public function getSource(): SourceInterface
        {
            $source = $this->getData(static::FIELD_SOURCE);

            if($source === null)
            {
                $source = $this->getProcessorRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_SOURCE_ID)
                );
                $this->setData(static::FIELD_STORE, $source);
            }

            return $source;
        }

        /**
         * {@inheritdoc}
         */
        public function setSource(SourceInterface $source): self
        {
            return $this->setData(ResourceInterface::FIELD_SOURCE_ID, $source->getId())->setData(static::FIELD_SOURCE, $source);
        }

        /**
         * {@inheritdoc}
         */
        public function getStore(): StoreInterface
        {
            $store = $this->getData(static::FIELD_STORE);

            if($store === null)
            {
                $store = $this->getStoreRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_ID)
                );
                $this->setData(static::FIELD_STORE, $store);
            }

            return $store;
        }

        /**
         * {@inheritdoc}
         */
        public function setStore(StoreInterface $store): self
        {
            return $this->setData(ResourceInterface::FIELD_STORE_ID, $store->getId())
                ->setData(static::FIELD_STORE, $store);
        }

        /**
         * {@inheritdoc}
         */
        public function getAttribute(): AttributeInterface
        {
            $attribute = $this->getData(static::FIELD_ATTRIBUTE);

            if($attribute === null)
            {
                $attribute = $this->getAttributeRepository()->get(
                    $this->getData(ResourceInterface::FIELD_ATTRIBUTE_ENTITY_TYPE_ID),
                    $this->getData(ResourceInterface::FIELD_ATTRIBUTE_CODE)
                );
                $this->setData(static::FIELD_ATTRIBUTE, $attribute);
            }

            return $attribute;
        }

        /**
         * {@inheritdoc}
         */
        public function setAttribute(AttributeInterface $attribute): self
        {
            return $this->setData(ResourceInterface::FIELD_ATTRIBUTE_ENTITY_TYPE_ID, $attribute->getEntityTypeId())
                ->setData(ResourceInterface::FIELD_ATTRIBUTE_CODE, $attribute->getAttributeCode())
                ->setData(static::FIELD_ATTRIBUTE, $attribute);
        }

        /**
         * Source Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\ProcessorRepositoryInterface $_processorRepository
         */
        private $_processorRepository;

        /**
         * Gets Source Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\ProcessorRepositoryInterface
         */
        protected function getProcessorRepository(): ProcessorRepositoryInterface
        {
            return $this->_processorRepository;
        }

        /**
         * Store Repository property
         *
         * @access private
         *
         * @var \Magento\Store\Api\StoreRepositoryInterface $_storeRepository
         */
        private $_storeRepository;

        /**
         * Gets Store Repository
         *
         * @access protected
         *
         * @return \Magento\Store\Api\StoreRepositoryInterface
         */
        protected function getStoreRepository(): StoreRepositoryInterface
        {
            return $this->_storeRepository;
        }

        /**
         * Attribute Repository property
         *
         * @access private
         *
         * @var \Magento\Eav\Api\AttributeRepositoryInterface $_attributeRepository
         */
        private $_attributeRepository;

        /**
         * Gets Attribute Repository
         *
         * @access protected
         *
         * @return \Magento\Eav\Api\AttributeRepositoryInterface
         */
        protected function getAttributeRepository(): AttributeRepositoryInterface
        {
            return $this->_attributeRepository;
        }
    }
?>