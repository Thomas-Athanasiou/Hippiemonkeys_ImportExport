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

    use Psr\Log\LoggerInterface,
        Magento\Framework\Model\Context,
        Magento\Framework\Registry;

    class ProcessorComposite
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
         * @param \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface[] $processors
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            LoggerInterface $logger,
            array $processors,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);
            $this->_logger = $logger;
            $this->_processors = $processors;
        }

        /**
         * {@inheritdoc}
         */
        public function processDataArray(array $dataArray): array
        {
            foreach ($this->getProcessors() as $processor)
            {
                $dataArray = $processor->processDataArray($dataArray);
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
         * Processors property
         *
         * @access protected
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface[] $_processors
         */
        private $_processors;

        /**
         * Gets Processors
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface[]
         */
        protected function getProcessors(): array
        {
            return $this->_processors;
        }
    }
?>