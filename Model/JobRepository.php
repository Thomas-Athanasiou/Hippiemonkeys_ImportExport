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
        Hippiemonkeys\ImportExport\Api\JobRepositoryInterface,
        Hippiemonkeys\ImportExport\Api\Data\JobInterface,
        Hippiemonkeys\ImportExport\Api\Data\JobInterfaceFactory,
        Hippiemonkeys\ImportExport\Model\Spi\JobResourceInterface as ResourceInterface,
        Hippiemonkeys\ImportExport\Api\Data\JobSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\ImportExport\Api\Data\JobSearchResultInterfaceFactory as SearchResultInterfaceFactory;

    class JobRepository
    implements JobRepositoryInterface
    {
        /**
         * Id cache
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\JobInterface[] $_idCache
         */
        private $_idCache;

        /**
         * Code cache
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\JobInterface[] $_codeCache
         */
        private $_codeCache;

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Model\Spi\JobResourceInterface $resource
         * @param \Hippiemonkeys\ImportExport\Api\Data\JobInterfaceFactory $jobFactory
         * @param \Hippiemonkeys\ImportExport\Api\Data\JobSearchResultInterfaceFactory $searchResultFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         */
        public function __construct(
            ResourceInterface $resource,
            JobInterfaceFactory $jobFactory,
            SearchResultInterfaceFactory $searchResultFactory,
            CollectionProcessorInterface $collectionProcessor
        )
        {
            $this->_resource = $resource;
            $this->_jobFactory = $jobFactory;
            $this->_searchResultFactory = $searchResultFactory;
            $this->_collectionProcessor = $collectionProcessor;
        }

        /**
         * {@inheritdoc}
         *
         * @throws \Hippiemonkeys\ImportExport\Exception\NoSuchEntityException
         */
        public function getById($id) : JobInterface
        {
            $job = $this->_idCache[$id] ?? null;
            if($job === null)
            {
                $job = $this->getJobFactory()->create();
                $this->getResource()->loadJobById($job, $id);
                if ($job->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Job with Id "%1" that was requested doesn\'t exist. Verify the job and try again', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $job;
                    $this->_codeCache[$job->getCode()] = $job;
                }
            }
            return $job;
        }

        /**
         * {@inheritdoc}
         *
         * @throws \Hippiemonkeys\ImportExport\Exception\NoSuchEntityException
         */
        public function getByCode(string $code) : JobInterface
        {
            $job = $this->_codeCache[$code] ?? null;
            if($job === null)
            {
                $job = $this->getJobFactory()->create();
                $this->getResource()->loadJobByCode($job, $code);
                $id = $job->getId();
                if ($id === null)
                {
                    throw new NoSuchEntityException(
                        __('The Job with Code "%1" that was requested doesn\'t exist. Verify the Job and try again', $code)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $job;
                    $this->_codeCache[$code] = $job;
                }
            }
            return $job;
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
        public function save(JobInterface $job) : JobInterface
        {
            $this->_idCache[$job->getId()] = $job;
            $this->_codeCache[$job->getCode()] = $job;
            $this->getResource()->saveJob($job);
            return $job;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(JobInterface $job) : bool
        {
            unset($this->_idCache[$job->getId()]);
            unset($this->_codeCache[$job->getCode()]);
            return $this->getResource()->deleteJob($job);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Model\Spi\JobResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\JobResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Job Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\JobInterfaceFactory $_jobFactory
         */
        private $_jobFactory;

        /**
         * Gets Job Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobInterfaceFactory
         */
        protected function getJobFactory(): JobInterfaceFactory
        {
            return $this->_jobFactory;
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
         * @var \Hippiemonkeys\ImportExport\Api\Data\JobSearchResultInterfaceFactory $_searchResultFactory
         */
        private $_searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory(): SearchResultInterfaceFactory
        {
            return $this->_searchResultFactory;
        }
    }
?>