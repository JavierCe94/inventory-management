<?php

namespace Inventory\Management\Infrastructure\Service\File;

use Inventory\Management\Domain\Model\File\ImageCanNotUploadException;
use Inventory\Management\Domain\Service\Util\GenerateCharacters;
use Inventory\Management\Domain\Model\File\UploadFile as UploadFileI;

class UploadFile implements UploadFileI
{
    private $generateCharacters;

    public function __construct(GenerateCharacters $generateCharacters)
    {
        $this->generateCharacters = $generateCharacters;
    }

    /**
     * @throws ImageCanNotUploadException
     */
    public function execute(array $file, string $urlFile): string
    {
        $numberOfCharacters = 20;
        $generatedName = $this->generateCharacters->execute($numberOfCharacters);
        $filmImageName = $generatedName.'.'.$this->extensionImage($file);
        list($width, $height) = getimagesize($file['tmp_name']);
        $tn = imagecreatetruecolor($width, $height);
        if ('image/png' === $file['type']) {
            $image = imageCreateFromPng($file['tmp_name']);
        } else {
            $image = imageCreateFromJpeg($file['tmp_name']);
        }
        imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height);
        $url = __DIR__.'/../../../../public/uploads/'.$urlFile.$filmImageName;
        if ('image/png' === $file["type"]) {
            $isUpload = imagepng($tn, $url);
        } else {
            $isUpload = imagejpeg($tn, $url, 100);
        }
        if (false === $isUpload) {
            throw new ImageCanNotUploadException();
        }

        return $filmImageName;
    }

    private function extensionImage($fileTypeImage): string
    {
        $extension = "jpg";
        if ('image/png' === $fileTypeImage['type']) {
            $extension = "png";
        }

        return $extension;
    }
}
