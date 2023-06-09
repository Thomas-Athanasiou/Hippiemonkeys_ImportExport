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
        Magento\Framework\Filesystem,
        Magento\Framework\App\Filesystem\DirectoryList,
        Magento\Framework\Model\Context,
        Magento\Framework\Registry,
        Magento\ImportExport\Model\Import,
        Magento\ImportExport\Model\Import\Adapter,
        Magento\ImportExport\Model\Import\AbstractSource,
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface,
        Hippiemonkeys\ImportExport\Api\ProcessorRepositoryInterface,
        Hippiemonkeys\ImportExport\Api\Data\JobInterface,
        Hippiemonkeys\ImportExport\Model\Spi\JobResourceInterface as ResourceInterface,
        Hippiemonkeys\ImportExport\Api\Data\SourceInterface,
        Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface;

    class Job
    extends AbstractModel
    implements JobInterface
    {
        protected const
            IMPORT_ADAPTER_TYPE = 'csv',

            IMPORT_CSV_SEPARATOR = Import::FIELD_FIELD_SEPARATOR,
            IMPORT_CSV_ENCLOSURE = '"',
            IMPORT_CSV_ESCAPE = '\\',
            IMPORT_CSV_EOL = "\n",
            IMPORT_FILE_FORMAT = 'hippiemonkeys-import-%s.' . self::IMPORT_ADAPTER_TYPE,

            FIELD_SOURCE = 'source',
            FIELD_PROCESSOR = 'processor';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface $sourceRepository
         * @param \Hippiemonkeys\ImportExport\Api\ProcessorRepositoryInterface $processorRepository
         * @param \Magento\ImportExport\Model\Import $import
         * @param \Psr\Log\LoggerInterface $logger
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            SourceRepositoryInterface $sourceRepository,
            ProcessorRepositoryInterface $processorRepository,
            Import $import,
            Filesystem $filesystem,
            LoggerInterface $logger,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);
            $this->_sourceRepository = $sourceRepository;
            $this->_processorRepository = $processorRepository;
            $this->_import = $import;
            $this->_filesystem = $filesystem;
            $this->_logger = $logger;
        }

        /**
         * {@inheritdoc}
         *
         * @todo process validation
         */
        public function execute(): void
        {
            $logger = $this->getLogger();
            $import = $this->getImport();
            $import->setEntity($this->getEntityTypeCode());

            $importValidationResult = $import->validateSource(
                $this->getImportSource(
                    $this->getProcessor()->processDataArray(
                        $this->getSource()->getDataArray()
                    ),
                    self::IMPORT_CSV_SEPARATOR
                )
             );

            if($importValidationResult)
            {
                $import->setData(Import::FIELD_IMPORT_IDS, implode(',', $import->getValidatedIds()));
                if($import->importSource())
                {
                    $logger->critical(__('Import Completed Successfully'));
                }
                else
                {
                    $logger->critical(__('Import Failed'));
                }
            }
            else
            {
                $logger->critical(__('Import Validation Failed'));
            }
        }

        /**
         * {@inheritdoc}
         */
        public function getCode(): string
        {
            return $this->getData(ResourceInterface::FIELD_CODE);
        }

        /**
         * {@inheritdoc}
         */
        public function getEntityTypeCode(): string
        {
            return $this->getData(ResourceInterface::FIELD_ENTITY_TYPE_CODE);
        }

        /**
         * {@inheritdoc}
         */
        public function setEntityTypeCode(string $entityTypeCode): self
        {
            return $this->setData(ResourceInterface::FIELD_ENTITY_TYPE_CODE, $entityTypeCode);
        }

        /**
         * {@inheritdoc}
         */
        public function getBehavior(): string
        {
            return $this->getData(ResourceInterface::FIELD_BEHAVIOR);
        }

        /**
         * {@inheritdoc}
         */
        public function setBehavior(string $behavior): self
        {
            return $this->setData(ResourceInterface::FIELD_BEHAVIOR, $behavior);
        }

        /**
         * {@inheritdoc}
         */
        public function getValidationStrategy(): string
        {
            return $this->getData(ResourceInterface::FIELD_VALIDATION_STRATEGY);
        }

        /**
         * {@inheritdoc}
         */
        public function setValidationStrategy(string $validationStrategy): self
        {
            return $this->setData(ResourceInterface::FIELD_VALIDATION_STRATEGY, $validationStrategy);
        }

        /**
         * {@inheritdoc}
         */
        public function getAllowedErrorCount(): int
        {
            return (int) $this->getData(ResourceInterface::FIELD_ALLOWED_ERROR_COUNT);
        }

        /**
         * {@inheritdoc}
         */
        public function setAllowedErrorCount(int $allowedErrorCount): self
        {
            return $this->setData(ResourceInterface::FIELD_ALLOWED_ERROR_COUNT, $allowedErrorCount);
        }

        /**
         * {@inheritdoc}
         */
        public function getSource(): SourceInterface
        {
            $source = $this->getData(static::FIELD_SOURCE);

            if ($source === null)
            {
                $source = $this->getSourceRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_SOURCE_ID)
                );
                $this->setData(static::FIELD_SOURCE, $source);
            }

            return $source;
        }

        /**
         * {@inheritdoc}
         */
        public function setSource(SourceInterface $source): JobInterface
        {
            return $this->setData(ResourceInterface::FIELD_SOURCE_ID, $source->getId())->setData(static::FIELD_SOURCE, $source);
        }

        /**
         * Gets Processor
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\ProcessorInterface
         */
        public function getProcessor(): ProcessorInterface
        {
            $processor = $this->getData(static::FIELD_PROCESSOR);

            if ($processor === null)
            {
                $processor = $this->getSourceRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_PROCESSOR_ID)
                );
                $this->setData(static::FIELD_PROCESSOR, $processor);
            }

            return $processor;
        }

        /**
         * {@inheritdoc}
         */
        public function setProcessor(ProcessorInterface $processor): JobInterface
        {
            return $this->setData(ResourceInterface::FIELD_PROCESSOR_ID, $processor->getId())->setData(static::FIELD_PROCESSOR, $processor);
        }

        /**
         * Source Repository property
         *
         * @access protected
         *
         * @var \Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface $_sourceRepository
         */
        private $_sourceRepository;

        /**
         * Gets Source Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface
         */
        protected function getSourceRepository(): SourceRepositoryInterface
        {
            return $this->_sourceRepository;
        }

        /**
         * Processor Repository property
         *
         * @access protected
         *
         * @var \Hippiemonkeys\ImportExport\Api\ProcessorRepositoryInterface $_processorRepository
         */
        private $_processorRepository;

        /**
         * Gets Processor Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\ProcessorRepositoryInterface
         */
        protected function getProcessorRepository(): ProcessorRepositoryInterface
        {
            return $this->_processorRepository;
        }

        /**
         * Import property
         *
         * @access protected
         *
         * @var \Magento\ImportExport\Model\Import $_import
         */
        private $_import;

        /**
         * Gets Import
         *
         * @access protected
         *
         * @return \Magento\ImportExport\Model\Import
         */
        protected function getImport(): Import
        {
            return $this->_import;
        }

        /**
         * Filesystem property
         *
         * @access protected
         *
         * @var \Magento\Framework\Filesystem $_filesystem
         */
        private $_filesystem;

        /**
         * Gets Filesystem
         *
         * @access protected
         *
         * @return \Magento\Framework\Filesystem
         */
        protected function getFilesystem(): Filesystem
        {
            return $this->_filesystem;
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
         * Gets Import Source
         *
         * @access protected
         *
         * @return \Magento\ImportExport\Model\Import\AbstractSource
         */
        protected function getImportSource(array $data, string $options): AbstractSource
        {
            $fileName = sprintf(self::IMPORT_FILE_FORMAT, $this->getCode());

            $directory = $this->getFilesystem()->getDirectoryWrite(DirectoryList::TMP);
            $directory->openFile($fileName)->writeCsv(
                $data,
                self::IMPORT_CSV_SEPARATOR,
                self::IMPORT_CSV_ENCLOSURE
            );

            return Adapter::factory(self::IMPORT_ADAPTER_TYPE, $directory->getAbsolutePath(null), $fileName, $options);
        }
    }
?>