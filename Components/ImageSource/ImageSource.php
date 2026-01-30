<?php

declare(strict_types=1);

namespace Sitegeist\Kaleidoscope\Cpx\Components\ImageSource;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Core\Bootstrap;
use Neos\Media\Domain\Model\ImageInterface;
use PackageFactory\PHPComponentEngine as _;
use Sitegeist\Kaleidoscope\Domain\AssetImageSource;
use Sitegeist\Kaleidoscope\Domain\DummyImageSource;
use Sitegeist\Kaleidoscope\Domain\ImageSourceInterface;
use Sitegeist\Kaleidoscope\ValueObjects\Factory\ImageSourceFactory;
use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;

#[Flow\Proxy(false)]
final readonly class ImageSource
{

    public function __construct(
        public ImageSourceInterface $source,
    ) {
    }

    public static function create(
        ?string $alt = null,
        ?string $title = null,
        ?int $width = null,
        ?int $height = null,
        ?string $backgroundColor = null,
        ?string $foregroundColor = null,
        ?string $text = null,
    ): self {
        $imageSourceObject = new DummyImageSource(
            null,
            $title,
            $alt,
            $width,
            $height,
            $backgroundColor,
            $foregroundColor,
            $text,
            true,
        );

        return new self($imageSourceObject);
    }
}
