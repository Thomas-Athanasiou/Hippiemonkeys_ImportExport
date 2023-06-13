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
        Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface,
        Hippiemonkeys\ImportExport\Api\Data\SourceInterface,
        Hippiemonkeys\ImportExport\Api\Data\SourceInterfaceFactory,
        Hippiemonkeys\ImportExport\Model\Spi\SourceResourceInterface as ResourceInterface,
        Hippiemonkeys\ImportExport\Api\Data\SourceSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\ImportExport\Api\Data\SourceSearchResultInterfaceFactory as SearchResultInterfaceFactory;

    class SourceRepository
    implements SourceRepositoryInterface
    {
        /**
         * Id cache
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\SourceInterface[] $_idCache
         */
        private $_idCache;

        /**
         * Code cache
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\SourceInterface[] $_codeCache
         */
        private $_codeCache;

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Model\Spi\SourceResourceInterface $resource
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterfaceFactory $sourceFactory
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceSearchResultInterfaceFactory $searchResultFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         */
        public function __construct(
            ResourceInterface $resource,
            SourceInterfaceFactory $sourceFactory,
            SearchResultInterfaceFactory $searchResultFactory,
            CollectionProcessorInterface $collectionProcessor
        )
        {
            $this->_resource = $resource;
            $this->_sourceFactory = $sourceFactory;
            $this->_searchResultFactory = $searchResultFactory;
            $this->_collectionProcessor = $collectionProcessor;
        }

        /**
         * {@inheritdoc}
         *
         * @throws \Hippiemonkeys\ImportExport\Exception\NoSuchEntityException
         */
        public function getById($id) : SourceInterface
        {
            $source = $this->_idCache[$id] ?? null;
            if($source === null)
            {
                $source = $this->getSourceFactory()->create();
                $this->getResource()->loadSourceById($source, $id);
                if ($source->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Source with Id "%1" that was requested doesn\'t exist. Verify the source and try again', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $source;
                    $this->_codeCache[$source->getCode()] = $source;
                }
            }
            return $source;
        }

        /**
         * {@inheritdoc}
         *
         * @throws \Hippiemonkeys\ImportExport\Exception\NoSuchEntityException
         */
        public function getByCode(string $code) : SourceInterface
        {
            $source = $this->_codeCache[$code] ?? null;
            if($source === null)
            {
                $source = $this->getSourceFactory()->create();
                $this->getResource()->loadSourceByCode($source, $code);
                $id = $source->getId();
                if ($id === null)
                {
                    throw new NoSuchEntityException(
                        __('The Source with Code "%1" that was requested doesn\'t exist. Verify the Source and try again', $code)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $source;
                    $this->_codeCache[$code] = $source;
                }
            }
            return $source;
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
        public function save(SourceInterface $source) : SourceInterface
        {
            $this->_idCache[$source->getId()] = $source;
            $this->_codeCache[$source->getCode()] = $source;
            $this->getResource()->saveSource($source);
            return $source;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(SourceInterface $source) : bool
        {
            unset($this->_idCache[$source->getId()]);
            unset($this->_codeCache[$source->getCode()]);
            return $this->getResource()->deleteSource($source);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Model\Spi\SourceResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\SourceResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Source Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\SourceInterfaceFactory $_sourceFactory
         */
        private $_sourceFactory;

        /**
         * Gets Source Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterfaceFactory
         */
        protected function getSourceFactory(): SourceInterfaceFactory
        {
            return $this->_sourceFactory;
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
         * @var \Hippiemonkeys\ImportExport\Api\Data\SourceSearchResultInterfaceFactory $_searchResultFactory
         */
        private $_searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory(): SearchResultInterfaceFactory
        {
            return $this->_searchResultFactory;
        }
    }
?>