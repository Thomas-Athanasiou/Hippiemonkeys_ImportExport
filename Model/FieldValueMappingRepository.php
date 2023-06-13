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

    use Magento\Framework\Api\SearchCriteriaInterface,
        Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface,
        Hippiemonkeys\ImportExport\Exception\NoSuchEntityException,
        Hippiemonkeys\ImportExport\Api\FieldValueMappingRepositoryInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterfaceFactory,
        Hippiemonkeys\ImportExport\Model\Spi\FieldValueMappingResourceInterface as ResourceInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingSearchResultInterfaceFactory as SearchResultInterfaceFactory;

    class FieldValueMappingRepository
    implements FieldValueMappingRepositoryInterface
    {
        /**
         * Id cache
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterface[] $_idCache
         */
        private $_idCache;

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Model\Spi\FieldValueMappingResourceInterface $resource
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterfaceFactory $fieldValueMappingFactory
         * @param \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingSearchResultInterfaceFactory $searchResultFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         */
        public function __construct(
            ResourceInterface $resource,
            FieldValueMappingInterfaceFactory $fieldValueMappingFactory,
            SearchResultInterfaceFactory $searchResultFactory,
            CollectionProcessorInterface $collectionProcessor
        )
        {
            $this->_resource = $resource;
            $this->_fieldValueMappingFactory = $fieldValueMappingFactory;
            $this->_searchResultFactory = $searchResultFactory;
            $this->_collectionProcessor = $collectionProcessor;
        }

        /**
         * {@inheritdoc}
         *
         * @throws \Hippiemonkeys\ImportExport\Exception\NoSuchEntityException
         */
        public function getById($id) : FieldValueMappingInterface
        {
            $fieldValueMapping = $this->_idCache[$id] ?? null;
            if($fieldValueMapping === null)
            {
                $fieldValueMapping = $this->getFieldValueMappingFactory()->create();
                $this->getResource()->loadFieldValueMappingById($fieldValueMapping, $id);
                if ($fieldValueMapping->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Field Value Mapping with Id "%1" that was requested doesn\'t exist. Verify the Field Value Mapping and try again', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $fieldValueMapping;
                }
            }

            return $fieldValueMapping;
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
        public function save(FieldValueMappingInterface $fieldValueMapping) : FieldValueMappingInterface
        {
            $this->_idCache[$fieldValueMapping->getId()] = $fieldValueMapping;
            $this->getResource()->saveFieldValueMapping($fieldValueMapping);
            return $fieldValueMapping;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(FieldValueMappingInterface $fieldValueMapping) : bool
        {
            unset($this->_idCache[$fieldValueMapping->getId()]);
            return $this->getResource()->deleteFieldValueMapping($fieldValueMapping);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Model\Spi\FieldValueMappingResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\FieldValueMappingResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Field Value Mapping Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterfaceFactory $_fieldValueMappingFactory
         */
        private $_fieldValueMappingFactory;

        /**
         * Gets Field Value Mapping Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingInterfaceFactory
         */
        protected function getFieldValueMappingFactory(): FieldValueMappingInterfaceFactory
        {
            return $this->_fieldValueMappingFactory;
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
         * @var \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingSearchResultInterfaceFactory $_searchResultFactory
         */
        private $_searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\FieldValueMappingSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory(): SearchResultInterfaceFactory
        {
            return $this->_searchResultFactory;
        }
    }
?>