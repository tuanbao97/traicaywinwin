<?php

namespace App\Service;

use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Format\Video\X264;
use FFMpeg\Media\Frame;
use FFMpeg\Media\Video;

abstract class FFMpegService
{
    public FFMpeg $ffmpeg;
    
    public Video $video;

    public X264 $format;

    public function __construct() {
        // Khởi tạo giá trị mặc định
        
    }
    
    abstract public function initFFMpeg() : self;
    
    /**
     * Open video
     * @param string $inputPath
     * @return \App\Service\FFMpegService
     */
    public function openVideo(string $inputPath) : self
    {
        $this->video = $this->ffmpeg->open($inputPath);
        return $this;
    }

    abstract public function setKiloBitrate(int $kiloBitrade) : self;
    /**
     * Giảm Frame Rate: Giảm số lượng khung hình trên giây (fps) cũng có thể giúp giảm dung lượng. \nMặc dù điều này có thể ảnh hưởng đến độ mượt của video, nhưng nếu không quá cần thiết, bạn có thể giảm fps.
     * @param int $frameRate
     * @param int $gop:  là viết tắt của Group of Pictures và là một số nguyên (integer) để chỉ định số lượng khung hình trong một nhóm (Group of Pictures).
     * @return \App\Service\FFMpegService
     */
    abstract public function setFrameRate(int $frameRate, int $gop) : self;
    /**
     * Chuyển đổi độ phân giải video thành HD 1280x720 px
     * @return \App\Service\FFMpegService
     */
    abstract public function convertVideoToResolutionHD() : self;
    /**
     * Chuyển dổi độ phân giải video thành Full HD 1920x1080 px
     * @return \App\Service\FFMpegService
     */
    abstract public function convertVideoToResolutionFullHD() : self;

    // Thiết lập định dạng video với H.264 codec và nén lại
    public function formatVideoMp4() : self
    {
        $this->format = new X264('aac', 'libx264');
        return $this;
    }

    public function generateImageThumnail(int $secondWantToScreenShot = 1, string $directoryFile, string $fileName) : self
    {
        $this->video
             ->frame(TimeCode::fromSeconds($secondWantToScreenShot))
             ->save($directoryFile . '/' .$fileName); // Lưu frame dưới dạng hình ảnh

        return $this;
    }
    
    public function saveVideo(string $directoryFile, string $fileName) {
        $this->video->save($this->format, $directoryFile . '/' . $fileName);
    }

}
