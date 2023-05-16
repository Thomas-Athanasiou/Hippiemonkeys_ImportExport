Import Product Entity → Magento\CatalogImportExport\Model\Import\Product\Type\AbstractType
Import Proccess Entity → Magento\CatalogImportExport\Model\Import\Product
 - See saveProductEntity()
 - See updateProductEntity()
 -> set Source
? Import Data Provider / Factory → Magento\ImportExport\Model\Import\Source\Csv
? Import Data Provider / Factory → Magento\ImportExport\Model\ResourceModel\Import\Data


Import process:
1. saveBunch() at \Magento\ImportExport\Model\ResourceModel\Import\Data
2. Use the IDS from saveBunch() to \Magento\ImportExport\Model\Import, with ->setData();
3. Run the import process at \Magento\ImportExport\Model\Import->importSource