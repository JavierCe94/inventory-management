<?php

namespace Inventory\Management\Domain\Model\File;

interface UploadFile
{
    public function execute(array $file, string $urlFile): string;
}
