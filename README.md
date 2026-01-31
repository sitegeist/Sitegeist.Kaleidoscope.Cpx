# Sitegeist.Kaleidoscope.Cpx

> Adapter package that integrates PackageFactory.ComponentEngine with Sitegeist.Kaleidoscpope

!!! Everything in here is an experiment !!!

## Usage 

Render image-tag

```
from "Sitegeist.Kaleidoscope.Cpx/ImageSource/ImageSource.cpx" import { ImageSource }
from "Sitegeist.Kaleidoscope.Cpx/Image/Image.cpx" import { Image }
from "Sitegeist.Kaleidoscope.Cpx/Source/Source.cpx" import { Source }

export component TextImage {
    imageSource: ImageSource
    content: string

    render <div>
        {content}
        <Image
          imageSource={imageSource} width={300} height={null} format={null}
          srcset="300w, 400w, 500w" sizes="50%" loading={null}         
          alt="" title="" class=""
          />      
    </div>
}
```

Render a picture-tag

```
from "Sitegeist.Kaleidoscope.Cpx/ImageSource/ImageSource.cpx" import { ImageSource }
from "Sitegeist.Kaleidoscope.Cpx/Image/Image.cpx" import { Image }
from "Sitegeist.Kaleidoscope.Cpx/Source/Source.cpx" import { Source }

export component TextImage {
    imageSource: ImageSource
    content: string

    render 
      <picture>
          <Image
              imageSource={imageSource} width={300} height={null} format={null}
              srcset="300w, 400w, 500w" sizes="50%" loading={null}         
              alt="" title="" class=""
              />
          <Source
              imageSource={imageSource} format="webp"
              srcset="1x, 2x" sizes={null}             
              width={300} height={null} type={null} media="stuff"
              />
          <Source
              imageSource={imageSource} format="webp"
              srcset="1x, 2x" sizes={null}             
              width={300} height={null} type={null} media="stuff"
              />
        </picture>
    </div>
}
```

The class `\Sitegeist\Kaleidoscope\Cpx\Components\ImageSource\ImageSourceFactory` allows to 
create image-sources for ImagesInterfaces, ImageSoureProxies and DummyImages.

## License

see [LICENSE](./LICENSE)
