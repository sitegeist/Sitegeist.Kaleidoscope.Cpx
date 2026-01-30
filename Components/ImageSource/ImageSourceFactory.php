<?php

declare(strict_types=1);

namespace Sitegeist\Kaleidoscope\Cpx\Components\ImageSource;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\ObjectManagement\ObjectManager;
use Neos\Media\Domain\Model\ImageInterface;
use Sitegeist\Kaleidoscope\Domain\AssetImageSource;
use Sitegeist\Kaleidoscope\Domain\ImageSourceInterface;

final class ImageSourceFactory
{
    #[Flow\Inject]
    protected ObjectManager $objectManager;

    protected ?\Sitegeist\Kaleidoscope\Cpx\Components\ImageSource\ImageSourceFactory $imageSourceFactory = null;

    public function tryCreateForImageSourceProxy(\Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy $proxy): ?ImageSource
    {
        if ($this->imageSourceFactory === null) {
            $this->imageSourceFactory = $this->objectManager->get(ImageSourceFactory::class);
        }
        $imageSourceObject = $this->imageSourceFactory->tryCreateFromProxy($proxy);
        if ($imageSourceObject instanceof ImageSourceInterface) {
            return new ImageSource($imageSourceObject);
        }
        return null;
    }

    public function createForImageSourceInterface(ImageSourceInterface $imageSource): ImageSource
    {
        return new ImageSource($imageSource);
    }

    public function createForImageInterface(ImageInterface $image, string $alt, string $title): ImageSource
    {
        $imageSourceObject = new AssetImageSource(
            $image,
            $title,
            $alt,
            true
        );
        return new ImageSource($imageSourceObject);
    }
}
