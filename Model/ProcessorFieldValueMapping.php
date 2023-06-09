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
        Psr\Log\LoggerInterface,
        Magento\Framework\Model\Context,
        Magento\Framework\Registry,
        Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface;

    class ProcessorFieldValueMap
    extends AbstractModel
    implements ProcessorInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Psr\Log\LoggerInterface $logger
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            LoggerInterface $logger,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);
            $this->_logger = $logger;
        }

        /**
         * {@inheritdoc}
         */
        public function processDataArray(array $dataArray): array
        {
            foreach($dataArray as $rowData)
            {
                foreach($rowData as $fieldName => $fieldValue)
                {

                }
            }

            return $dataArray;
        }

        /**
         * Logger property
         *
         * @access protected
         *
         * @var \Psr\Log\LoggerInterface $_logger
         */
        private $_logger;

        /**
         * Gets Logger
         *
         * @access protected
         *
         * @return \Psr\Log\LoggerInterface
         */
        protected function getLogger(): LoggerInterface
        {
            return $this->_logger;
        }

        /**
         * FieldValue
         */
        protected function getFieldValues(): array
        {

        }
    }
?>