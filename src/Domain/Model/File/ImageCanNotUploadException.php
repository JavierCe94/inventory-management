<?php

namespace Inventory\Management\Domain\Model\File;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class ImageCanNotUploadException extends NotFoundException
{
    public function message(): string
    {
        return 'No se ha podido subir la imagen';
    }
}
