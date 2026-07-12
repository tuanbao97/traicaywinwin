<?php

namespace App\Service\impl;

use App\Service\FFMpegService;
use App\Service\InterventionImageService;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\FrameRate;
use FFMpeg\FFMpeg;

class FFMpegServiceImpl extends FFMpegService
{

    /**
     * Create a new class instance.
     */
    public function __construct() {
        // Lazy init — tránh crash storefront khi FFPROBE_PATH chưa cấu hình
    }

    public function initFFMpeg(): self
    {
        if (isset($this->ffmpeg)) {
            return $this;
        }

        $ffmpegPath = env('FFMPEG_PATH');
        $ffprobePath = env('FFPROBE_PATH');
        if (blank($ffmpegPath) || blank($ffprobePath)) {
            throw new \RuntimeException('FFmpeg/FFprobe chưa được cấu hình (FFMPEG_PATH, FFPROBE_PATH).');
        }

        $this->ffmpeg = FFMpeg::create([
            'ffmpeg.binaries'  => $ffmpegPath,
            'ffprobe.binaries' => $ffprobePath,
        ]);
        return $this;
    }

    public function setFrameRate(int $frameRate, int $gop): self
    {
        $this->video->filters()->framerate(new FrameRate($frameRate), $gop);
        return $this;
    }

    public function convertVideoToResolutionHD(): self
    {
        $this->video->filters()->resize(new Dimension(1280, 720));
        return $this;
    }

    public function convertVideoToResolutionFullHD(): self
    {
        $this->video->filters()->resize(new Dimension(1920, 1080));
        return $this;
    }

    public function setKiloBitrate(int $kiloBitrade): self
    {
        $this->format->setKiloBitrate($kiloBitrade);
        return $this;
    }

}
