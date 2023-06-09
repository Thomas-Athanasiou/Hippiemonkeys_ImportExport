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

    namespace Hippiemonkeys\ImportExport\Model;

    use Magento\Framework\Api\SearchCriteriaBuilder,
        Magento\Framework\Api\SearchCriteriaInterface,
        Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface,
        Hippiemonkeys\ImportExport\Exception\NoSuchEntityException,
        Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface,
        Hippiemonkeys\ImportExport\Api\FieldMappingRepositoryInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterfaceFactory,
        Hippiemonkeys\ImportExport\Model\Spi\FieldMappingResourceInterface as ResourceInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldMappingSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldMappingSearchResultInterfaceFactory as SearchResultInterfaceFactory;

    class FieldMappingRepository
    implements FieldMappingRepositoryInterface
    {
        /**
         * Id cache
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterface[] $_idCache
         */
        private $_idCache;

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Model\Spi\FieldMappingResourceInterface $resource
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterfaceFactory $fieldMappingFactory
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldMappingSearchResultInterfaceFactory $searchResultFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         */
        public function __construct(
            ResourceInterface $resource,
            FieldMappingInterfaceFactory $fieldMappingFactory,
            SearchResultInterfaceFactory $searchResultFactory,
            CollectionProcessorInterface $collectionProcessor,
            SearchCriteriaBuilder $searchCriteriaBuilder
        )
        {
            $this->_resource = $resource;
            $this->_fieldMappingFactory = $fieldMappingFactory;
            $this->_searchResultFactory = $searchResultFactory;
            $this->_collectionProcessor = $collectionProcessor;
            $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        }

        /**
         * {@inheritdoc}
         *
         * @throws \Hippiemonkeys\ImportExport\Exception\NoSuchEntityException
         */
        public function getById($id) : FieldMappingInterface
        {
            $fieldMapping = $this->_idCache[$id] ?? null;
            if($fieldMapping === null)
            {
                $fieldMapping = $this->getFieldMappingFactory()->create();
                $this->getResource()->loadFieldMappingById($fieldMapping, $id);
                if ($fieldMapping->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Field Mapping with Id "%1" that was requested doesn\'t exist. Verify the Field Mapping and try again', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $fieldMapping;
                }
            }
            return $fieldMapping;
        }

        /**
         * {@inheritdoc}
         */
        public function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * {@inheritdoc}
         */
        public function getListByProcessor(ProcessorInterface $processor): SearchResultInterface
        {
            $processorId = $processor->getId();
            $searchCriteriaBuilder = $this->getSearchCriteriaBuilder();
            $fieldMappings = $this->getList(
                $searchCriteriaBuilder
                    ->addFilter(ResourceInterface::FIELD_PROCESSOR_ID, $processorId, 'eq')
                    ->setPageSize(1)
                    ->create()
            )->getItems();

            $searchCriteriaBuilder->setPageSize(null);

            $fieldMapping = reset($fieldMappings);
            if($fieldMapping === false)
            {
                throw new NoSuchEntityException(
                    __('The Field Mapping with Code Id "%1" and Tracker Code "%2" that was requested doesn\'t exist. Verify the Field Mapping and try again', $processorId)
                );
            }
            return $fieldMapping;
        }

        /**
         * {@inheritdoc}
         */
        public function save(FieldMappingInterface $fieldMapping) : FieldMappingInterface
        {
            $this->_idCache[$fieldMapping->getId()] = $fieldMapping;
            $this->getResource()->saveFieldMapping($fieldMapping);
            return $fieldMapping;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(FieldMappingInterface $fieldMapping) : bool
        {
            unset($this->_idCache[$fieldMapping->getId()]);
            return $this->getResource()->deleteFieldMapping($fieldMapping);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Model\Spi\FieldMappingResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\FieldMappingResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * FieldMapping Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterfaceFactory $_fieldMappingFactory
         */
        private $_fieldMappingFactory;

        /**
         * Gets FieldMapping Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldMappingInterfaceFactory
         */
        protected function getFieldMappingFactory(): FieldMappingInterfaceFactory
        {
            return $this->_fieldMappingFactory;
        }

        /**
         * Collection Processor property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $_collectionProcessor
         */
        private $_collectionProcessor;

        /**
         * Gets Collection Processor
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
         */
        protected function getCollectionProcessor() : CollectionProcessorInterface
        {
            return $this->_collectionProcessor;
        }

        /**
         * Search Result Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\FieldMappingSearchResultInterfaceFactory $_searchResultFactory
         */
        private $_searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldMappingSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory(): SearchResultInterfaceFactory
        {
            return $this->_searchResultFactory;
        }

        /**
         * Search Criteria Builder property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\SearchCriteriaBuilder $_searchCriteriaBuilder
         */
        private $_searchCriteriaBuilder;

        /**
         * Gets Search Criteria Builder
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\SearchCriteriaBuilder
         */
        protected function getSearchCriteriaBuilder(): SearchCriteriaBuilder
        {
            return $this->_searchCriteriaBuilder;
        }
    }
?>