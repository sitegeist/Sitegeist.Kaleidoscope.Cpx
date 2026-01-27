<?php

declare(strict_types=1);

namespace Sitegeist\Kaleidoscope\Cpx\Components\Source;

use PackageFactory\ComponentEngine as _;
use Sitegeist\Kaleidoscope\Cpx\Components\ImageSource\ImageSource;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Source implements _\ComponentInterface
{
    private function __construct(
        private ?string $srcset,
        private ?string $sizes,
        private ?int $width,
        private ?int $height,
        private ?string $type,
        private ?string $media,
    ) {
    }

    public static function create(
        ImageSource $imageSource,
        ?string $srcset,
        ?string $sizes,
        ?int $width,
        ?int $height,
        ?string $format,
        ?string $type,
        ?string $media,
    ): self {
        $imageSourceObject = $imageSource->source;

        if ($width && $height) {
            $imageSourceObject = $imageSourceObject->withDimensions($width, $height);
        } elseif ($width) {
            $imageSourceObject = $imageSourceObject->withWidth($width);
        } elseif ($height) {
            $imageSourceObject = $imageSourceObject->withHeight($height);
        }

        if ($format) {
            $imageSourceObject = $imageSourceObject->withFormat($format);
            if ($type == null) {
                $type = 'image/' . $format;
            }
        }

        return new self(
            srcset: $srcset ? $imageSourceObject->srcset($srcset): null,
            sizes: $sizes,
            width: $width,
            height: $height,
            type: $type,
            media: $media,
        );
    }

    public function render(): string
    {
        $type = (($temp = $this->type) === null ? '' : ' type="' . _\Util::escapeAttributeValue($temp) . '"');
        $media = (($temp = $this->media) === null ? '' : ' media="' . _\Util::escapeAttributeValue($temp) . '"');
        $srcset = (($temp = $this->srcset) === null ? '' : ' srcset="' . _\Util::escapeAttributeValue($temp) . '"');
        $sizes = (($temp = $this->sizes) === null ? '' : ' sizes="' . _\Util::escapeAttributeValue($temp) . '"');
        return '<source '. $srcset . $type . $media . $sizes . (($temp = $this->width) === null ? '' : ' width="' . $temp . '"') . '' . (($temp = $this->height) === null ? '' : ' height="' . $temp . '"') . ' />';
    }
}
