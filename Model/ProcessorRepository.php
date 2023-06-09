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
        Hippiemonkeys\ImportExport\Api\ProcessorRepositoryInterface,
        Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface,
        Hippiemonkeys\ImportExport\Api\Data\ProcessorInterfaceFactory,
        Hippiemonkeys\ImportExport\Model\Spi\ProcessorResourceInterface as ResourceInterface,
        Hippiemonkeys\ImportExport\Api\Data\ProcessorSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\ImportExport\Api\Data\ProcessorSearchResultInterfaceFactory as SearchResultInterfaceFactory;

    class ProcessorRepository
    implements ProcessorRepositoryInterface
    {
        /**
         * Id cache
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface[] $_idCache
         */
        private $_idCache;

        /**
         * Code cache
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface[] $_codeCache
         */
        private $_codeCache;

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Model\Spi\ProcessorResourceInterface $resource
         * @param \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterfaceFactory $processorFactory
         * @param \Hippiemonkeys\ImportExport\Api\Data\ProcessorSearchResultInterfaceFactory $searchResultFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         */
        public function __construct(
            ResourceInterface $resource,
            ProcessorInterfaceFactory $processorFactory,
            SearchResultInterfaceFactory $searchResultFactory,
            CollectionProcessorInterface $collectionProcessor
        )
        {
            $this->_resource = $resource;
            $this->_processorFactory = $processorFactory;
            $this->_searchResultFactory = $searchResultFactory;
            $this->_collectionProcessor = $collectionProcessor;
        }

        /**
         * {@inheritdoc}
         *
         * @throws \Hippiemonkeys\ImportExport\Exception\NoSuchEntityException
         */
        public function getById($id) : ProcessorInterface
        {
            $processor = $this->_idCache[$id] ?? null;
            if($processor === null)
            {
                $processor = $this->getProcessorFactory()->create();
                $this->getResource()->loadProcessorById($processor, $id);
                if ($processor->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Processor with Id "%1" that was requested doesn\'t exist. Verify the processor and try again', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $processor;
                    $this->_codeCache[$processor->getCode()] = $processor;
                }
            }
            return $processor;
        }

        /**
         * {@inheritdoc}
         *
         * @throws \Hippiemonkeys\ImportExport\Exception\NoSuchEntityException
         */
        public function getByCode(string $code) : ProcessorInterface
        {
            $processor = $this->_codeCache[$code] ?? null;
            if($processor === null)
            {
                $processor = $this->getProcessorFactory()->create();
                $this->getResource()->loadProcessorByCode($processor, $code);
                $id = $processor->getId();
                if ($id === null)
                {
                    throw new NoSuchEntityException(
                        __('The Processor with Code "%1" that was requested doesn\'t exist. Verify the Processor and try again', $code)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $processor;
                    $this->_codeCache[$code] = $processor;
                }
            }
            return $processor;
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
        public function save(ProcessorInterface $processor) : ProcessorInterface
        {
            $this->_idCache[$processor->getId()] = $processor;
            $this->_codeCache[$processor->getCode()] = $processor;
            $this->getResource()->saveProcessor($processor);
            return $processor;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(ProcessorInterface $processor) : bool
        {
            unset($this->_idCache[$processor->getId()]);
            unset($this->_codeCache[$processor->getCode()]);
            return $this->getResource()->deleteProcessor($processor);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Model\Spi\ProcessorResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\ProcessorResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Processor Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterfaceFactory $_processorFactory
         */
        private $_processorFactory;

        /**
         * Gets Processor Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterfaceFactory
         */
        protected function getProcessorFactory(): ProcessorInterfaceFactory
        {
            return $this->_processorFactory;
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
         * @var \Hippiemonkeys\ImportExport\Api\Data\ProcessorSearchResultInterfaceFactory $_searchResultFactory
         */
        private $_searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\ProcessorSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory(): SearchResultInterfaceFactory
        {
            return $this->_searchResultFactory;
        }
    }
?>