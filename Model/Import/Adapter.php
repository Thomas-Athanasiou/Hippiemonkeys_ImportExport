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

    namespace Hippiemonkeys\ImportExport\Model\Import;

    use Magento\ImportExport\Model\Import\Adapter as ParentAdapter;

    class Adapter
    extends ParentAdapter
    {
        /**
         * {@inheritdoc}
         *
         * @todo add support for xml files
         */
        public static function factory($type, $directory, $source, $options = null)
        {
            return parent::factory($type, $directory, $source, $options);
        }
    }
?>