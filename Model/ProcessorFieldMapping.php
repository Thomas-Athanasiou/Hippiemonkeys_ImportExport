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
        Hippiemonkeys\ImportExport\Api\FieldMappingRepositoryInterface;

    class ProcessorFieldMapping
    extends ProcessorAbstract
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Psr\Log\LoggerInterface $logger
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
        public function processDataArray(array $dataArray): array
        {
            foreach ($this->getFieldMappingRepository()->getListByProcessor($this)->getItems() as $fieldMapping)
            {
                $sourceColumnName = $fieldMapping->getCode();
                $destinationColumnName = $fieldMapping->getAttribute()->getAttributeCode();
                foreach ($dataArray as &$row)
                {
                    if(isset($row[$sourceColumnName]))
                    {
                        $row[$destinationColumnName] = $row[$sourceColumnName];
                        unset($row[$sourceColumnName]);
                    }
                }
            }

            return $dataArray;
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