<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Inteligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_ImportExport
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\ImportExport\Api\Data;

    use Hippiemonkeys\Core\Api\Data\ModelInterface;

    /**
     * @api
     */
    interface JobInterface
    extends ModelInterface
    {
        /**
         * Executes the import process
         *
         * @access public
         */
        function execute(): void;

        /**
         * Gets Job Code
         *
         * @access public
         *
         * @return string
         */
        function getCode(): string;

        /**
         * Gets Entity
         *
         * @access public
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\EntityInterface
         */
        function getEntity(): EntityInterface;

        /**
         * Sets Entity
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\EntityInterface $entity
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobInterface
         */
        function setEntity(EntityInterface $entity): JobInterface;

        /**
         * Gets Source
         *
         * @access public
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterface
         */
        function getSource(): SourceInterface;

        /**
         * Sets Source
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterface $source
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobInterface
         */
        function setSource(SourceInterface $source): JobInterface;
    }
?>