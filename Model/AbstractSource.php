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
        Hippiemonkeys\ImportExport\Model\Import\Adapter,
        Hippiemonkeys\ImportExport\Api\Data\SourceInterface,
        Hippiemonkeys\ImportExport\Model\Spi\SourceResourceInterface as ResourceInterface,
        Magento\Framework\Registry,
        Magento\Framework\Model\Context,
        Magento\Framework\Filesystem\Directory\WriteInterface as DirectoryWriteInterface,
        Magento\Framework\Module\Dir as ModuleDirectory,
        Magento\Framework\Filesystem,
        Magento\Framework\Filesystem\DriverPool,
        Magento\Framework\Filesystem\File\ReadInterface,
        Magento\Framework\Filesystem\File\WriteInterface;

    abstract class AbstractSource
    extends AbstractModel
    implements SourceInterface
    {
        protected const
            FIELD_SOURCE = 'source',

            FILE_NAME_FORMAT = 'import_%s.%s',

            MODULE_NAME = 'Hippiemonkeys_ImportExport',
            MODULE_IMPORT_DIR = 'Import';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Magento\Framework\Module\Dir $moduleDirectory
         * @param \Magento\Framework\Filesystem $filesystem
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            ModuleDirectory $moduleDirectory,
            Filesystem $filesystem,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);

            $this->_moduleDirectory = $moduleDirectory;
            $this->_filesystem = $filesystem;
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
        public function setCode(string $code): SourceInterface
        {
            return $this->setData(ResourceInterface::FIELD_CODE, $code);
        }

        /**
         * {@inheritdoc}
         */
        public function updateData(): self
        {
            $this->getDirectory()->writeFile(
                $this->getFilename(),
                $this->arrayToCsv($this->getDestinationArray(), ',', '', '"', "\n")
            );

            return $this;
        }

        /**
         * Gets Destination Array
         *
         * @access protected
         *
         * @return array
         */
        protected function getDestinationArray(): array
        {
            return $this->createDestinationArrayFromSourceArray($this->getSourceArray());
        }

        /**
         * {@inheritdoc}
         */
        public function getSourceFile(): ReadInterface
        {
            return $this->getData(ResourceInterface::FIELD_SOURCE_FILE_LOCATION);
        }

        /**
         * {@inheritdoc}
         */
        public function setSourceFile(ReadInterface $sourceFile): SourceInterface
        {
            return $this->setData(ResourceInterface::FIELD_SOURCE_FILE_LOCATION, $sourceFile->getFileName());
        }

        /**
         * {@inheritdoc}
         */
        public function getDestinationFile(): WriteInterface
        {

        }

        /**
         * {@inheritdoc}
         */
        public function setDestinationFile(WriteInterface $destinationFile): SourceInterface
        {

        }

        /**
         * Gets Source Array
         *
         * @abstract
         *
         * @access protected
         *
         * @return array
         */
        abstract protected function getSourceArray(): array;

        /**
         * {@inheritdoc}
         */
        public function getImportSource(): AbstractSource
        {
            return Adapter::factory(
                $this->getType(),
                $this->getDirectory(),
                $this->getFilename()
            );
        }

        /**
         * Gets Type
         *
         * @access protected
         *
         * @return string
         */
        protected function getType(): string
        {
            return $this->getData(ResourceInterface::FIELD_TYPE);
        }

        /**
         * Sets Type
         *
         * @access public
         *
         * @param string $type
         *
         * @return \Hippiemonkeys\ImportExport\Model\Source
         */
        protected function setType(string $type): self
        {
            return $this->setData(ResourceInterface::FIELD_TYPE, $type);
        }


        /**
         * Gets Directory
         *
         * @access protected
         *
         * @return \Magento\Framework\Filesystem\Directory\WriteInterface
         */
        protected function getDirectory(): DirectoryWriteInterface
        {
            return $this->getFilesystem()->getDirectoryWrite(
                \sprintf(
                    '^%s/%s',
                    $this->getModuleDirectory()->getDir(static::MODULE_NAME),
                    static::MODULE_IMPORT_DIR
                ),
                DriverPool::FILE
            );
        }

        /**
         * Module Directory property
         *
         * @access private
         *
         * @var \Magento\Framework\Module\Dir $_moduleDirectory
         */
        private $_moduleDirectory;

        /**
         * Gets Module Directory
         *
         * @access protected
         *
         * @return  \Magento\Framework\Module\Dir
         */
        protected function getModuleDirectory(): ModuleDirectory
        {
            return $this->_moduleDirectory;
        }

        /**
         * Filesystem property
         *
         * @access private
         *
         * @var \Magento\Framework\Filesystem $_filesystem
         */
        private $_filesystem;

        /**
         * Gets Filesystem
         *
         * @access protected
         *
         * @return  \Magento\Framework\Filesystem
         */
        protected function getFilesystem(): Filesystem
        {
            return $this->_filesystem;
        }

        /**
         * Gets File Name
         *
         * @access protected
         *
         * @return string
         */
        protected function getFilename(): string
        {
            return \sprintf(
                static::FILE_NAME_FORMAT,
                $this->getCode(),
                $this->getType()
            );
        }

        /**
         * Converts the input array to a csv string representation
         *
         * @access protected
         *
         * @param array[] $inputArray
         */
        protected function arrayToCsv(array $array, string $delimiter, string $enclosure, string $escape, string $endOfLine)
        {
            $filePointer = fopen('php://memory', 'r+b');
            fputcsv($filePointer, $array, $delimiter, $enclosure, $escape, $endOfLine);
            rewind($filePointer);
            $data = rtrim(stream_get_contents($filePointer), "\n");
            fclose($filePointer);
            return $data;
        }
    }
?>