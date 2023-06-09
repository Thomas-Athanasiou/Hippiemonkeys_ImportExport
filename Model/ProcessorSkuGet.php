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

    use Magento\Framework\Model\Context,
        Magento\Framework\Registry,
        Magento\Framework\Api\SearchCriteriaBuilder,
        Magento\Framework\Api\Search\FilterBuilder,
        Magento\Framework\Api\Search\FilterGroupBuilder,
        Hippiemonkeys\Core\Api\Helper\ConfigInterface,
        Magento\Catalog\Api\ProductRepositoryInterface;

    class ProcessorSkuSearch
    extends ProcessorAbstract
    {
        protected const CONFIG_ATTRIBUTE_SEPARATOR = ',';


        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Psr\Log\LoggerInterface $logger
         * @param \Hippiemonkeys\ImportExport\Api\ConfigInterface $config
         * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         * @param \Magento\Framework\Api\Search\FilterGroupBuilder $filterGroupBuilder
         * @param \Magento\Framework\Api\Search\FilterBuilder $filterBuilder
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            ConfigInterface $config,
            ProductRepositoryInterface $productRepository,
            SearchCriteriaBuilder $searchCriteriaBuilder,
            FilterGroupBuilder $filterGroupBuilder,
            FilterBuilder $filterBuilder,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);
            $this->_config = $config;
            $this->_productRepository = $productRepository;
            $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
            $this->_filterGroupBuilder = $filterGroupBuilder;
            $this->_filterBuilder = $filterBuilder;
        }

        /**
         * {@inheritdoc}
         */
        public function processDataArray(array $dataArray): array
        {
            $searchAttributeCodes = explode(
                self::CONFIG_ATTRIBUTE_SEPARATOR,
                $this->getConfig()->getSkuSearchFields()
            );

            $searchCriteriaBuilder = $this->getSearchCriteriaBuilder();

            foreach ($dataArray as &$row)
            {

            }

            return $dataArray;
        }

        /**
         * Config property
         *
         * @access private
         *
         * @var \Hippiemonkeys\Core\Api\Helper\ConfigInterface $_config
         */
        private $_config;


        /**
         * Gets Config
         *
         * @access protected
         *
         * @return \Hippiemonkeys\Core\Api\Helper\ConfigInterface
         */
        protected function getConfig(): ConfigInterface
        {
            return $this->_config;
        }

        /**
         * Product Repository property
         *
         * @access private
         *
         * @var \Magento\Catalog\Api\ProductRepositoryInterface $_productRepository
         */
        private $_productRepository;


        /**
         * Gets Product Repository
         *
         * @access protected
         *
         * @return \Magento\Catalog\Api\ProductRepositoryInterface
         */
        protected function getProductRepository(): ProductRepositoryInterface
        {
            return $this->_productRepository;
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

        /**
         * Filter Group Builder property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\Search\FilterGroupBuilder $_filterGroupBuilder
         */
        private $_filterGroupBuilder;

        /**
         * Gets Search Criteria Builder
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\Search\FilterGroupBuilder
         */
        protected function getFilterGroupBuilder(): FilterGroupBuilder
        {
            return $this->_filterGroupBuilder;
        }

        /**
         * Filter Builder property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\Search\FilterBuilder $_filterBuilder
         */
        private $_filterBuilder;

        /**
         * Gets Filter Builder
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\Search\FilterBuilder
         */
        protected function getFilterBuilder(): FilterBuilder
        {
            return $this->_filterBuilder;
        }
    }
?>