<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image as SpatieImage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class RemoveFaces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $advertisement_image_id;

    /**
     * Create a new job instance.
     */
    public function __construct($advertisement_image_id)
    {
        $this->advertisement_image_id = $advertisement_image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $i = Image::find($this->advertisement_image_id);
        if (!$i) {
            return;
        }

        $srcPath = (storage_path('app/public/' . $i->path));
        $image = file_get_contents($srcPath);


        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->faceDetection($image);
        $faces=$response->getFaceAnnotations();

        foreach ($faces as $face) {
            $vertices=$face->getBoundingPoly()->getVertices();

            $bounds=[];
            foreach($vertices as $vertex){
                $bounds[]=[$vertex->getX(),$vertex->getY()];

            }

            $w=$bounds[2][0]-$bounds[0][0]; 
            $h=$bounds[2][1]-$bounds[0][1]; 

            $image=SpatieImage::load($srcPath);
            $image->watermark(base_path('resources/img/sunglasses.webp'))
                ->watermarkPosition('top-left')
                ->watermarkPadding($bounds[0][0],$bounds[0][1])
                ->watermarkWidth($w,Manipulations::UNIT_PIXELS)
                ->watermarkHeight($h,Manipulations::UNIT_PIXELS)
                ->watermarkFit(Manipulations::FIT_STRETCH);
                
            $image->save($srcPath);
        }
        $imageAnnotator->close();
    }
}
