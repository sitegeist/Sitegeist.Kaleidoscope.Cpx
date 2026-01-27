<?php

declare(strict_types=1);

namespace Sitegeist\Kaleidoscope\Cpx\Components\Image;

use PackageFactory\ComponentEngine as _;
use Sitegeist\Kaleidoscope\Cpx\Components\ImageSource\ImageSource;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Image implements _\ComponentInterface
{
    private function __construct(
        private string $src,
        private ?string $srcset,
        private ?string $sizes,
        private ?string $alt,
        private ?string $title,
        private ?int $width,
        private ?int $height,
        private ?string $class,
        private ?string $loading,
    ) {
    }

    public static function create(
        ImageSource $imageSource,
        ?string $srcset,
        ?string $sizes,
        ?string $alt,
        ?string $title,
        ?int $width,
        ?int $height,
        ?string $format,
        ?string $class,
        ?string $loading
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
        }

        return new self(
            src: $imageSourceObject->src(),
            srcset: $srcset ? $imageSourceObject->srcset($srcset): null,
            sizes: $sizes,
            alt: $alt,
            title: $title,
            width: $width,
            height: $height,
            class: $class,
            loading: $loading,
        );
    }

    public function render(): string
    {
        $sizes = (($temp = $this->sizes) === null ? '' : ' sizes="' . _\Util::escapeAttributeValue($temp) . '"');
        $src = (($temp = $this->src) === null ? '' : ' src="' . _\Util::escapeAttributeValue($temp) . '"');
        $srcset = (($temp = $this->srcset) === null ? '' : ' srcset="' . _\Util::escapeAttributeValue($temp) . '"');
        $loading = (($temp = $this->loading) === null ? '' : ' loading="' . _\Util::escapeAttributeValue($temp) . '"');
        return '<img '. $src . $srcset . $loading . $sizes . (($temp = $this->alt) === null ? '' : ' alt="' . _\Util::escapeAttributeValue($temp) . '"') . '' . (($temp = $this->title) === null ? '' : ' title="' . _\Util::escapeAttributeValue($temp) . '"') . '' . (($temp = $this->width) === null ? '' : ' width="' . $temp . '"') . '' . (($temp = $this->height) === null ? '' : ' height="' . $temp . '"') . '' . (($temp = $this->class) === null ? '' : ' class="' . _\Util::escapeAttributeValue($temp) . '"') . ' />';
    }
}
