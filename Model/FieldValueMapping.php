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

    namespace Hippiemonkeys\ImportExport\Api\Data;

    use Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface,
        Hippiemonkeys\ImportExport\Api\FieldMappingRepositoryInterface,
        Hippiemonkeys\ImportExport\Model\Spi\FieldValueMappingResourceInterface as ResourceInterface;

    /**
     * @api
     */
    class FieldValueMapping
    extends AbstractModel
    implements FieldValueMappingInterface
    {
        protected const FIELD_FIELD_MAPPING = 'field_mapping';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\ImportExport\Api\FieldMappingRepositoryInterface $fieldMappingRepository
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            FieldMappingRepositoryInterface $fieldMappingRepository,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);

            $this->_fieldMappingRepository = $fieldMappingRepository;
        }

        /**
         * {@inheritdoc}
         */
        public function getSourceValue(): string
        {
            return $this->getData(ResourceInterface::FIELD_SOURCE_VALUE);
        }

        /**
         * {@inheritdoc}
         */
        public function setSourceValue(string $sourceValue): self
        {
            return $this->setData(ResourceInterface::FIELD_SOURCE_VALUE, $sourceValue);
        }

        /**
         * {@inheritdoc}
         */
        public function getDestinationValue(): string
        {
            return $this->getData(ResourceInterface::FIELD_DESTINATION_VALUE);
        }

        /**
         * {@inheritdoc}
         */
        public function setDestinationValue(string $destinationValue): self
        {
            return $this->setData(ResourceInterface::FIELD_DESTINATION_VALUE, $destinationValue);
        }

        /**
         * {@inheritdoc}
         */
        public function getFieldMapping(): FieldMappingInterface
        {
            $fieldMapping = $this->getData(static::FIELD_FIELD_MAPPING);

            if($fieldMapping === null)
            {
                $fieldMapping = $this->getFieldMappingRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_FIELD_MAPPING_ID)
                );
                $this->setData(static::FIELD_FIELD_MAPPING, $fieldMapping);
            }

            return $fieldMapping;
        }

        /**
         * {@inheritdoc}
         */
        public function setFieldMapping(FieldMappingInterface $fieldMapping): self
        {
            return $this->setData(ResourceInterface::FIELD_FIELD_MAPPING_ID, $fieldMapping->getId())->setData(static::FIELD_FIELD_MAPPING, $fieldMapping);
        }

        /**
         * Field Mapping Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\FieldMappingRepositoryInterface $_fieldMappingRepository
         */
        private $_fieldMappingRepository;

        /**
         * Gets Field Mapping Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\FieldMappingRepositoryInterface
         */
        protected function getFieldMappingRepository(): FieldMappingRepositoryInterface
        {
            return $this->_fieldMappingRepository;
        }
    }
?>