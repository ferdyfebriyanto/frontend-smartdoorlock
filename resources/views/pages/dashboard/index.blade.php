@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total User</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalUsers ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-5 col-md-12 col-12 col-sm-12">
                    <video id="videoPlayer" controls autoplay></video>
                </div>
                <script>
                    // Ganti URL berikut dengan URL route yang Anda definisikan di web.php
                    const videoUrl = '/video-stream';

                    const videoPlayer = document.getElementById('videoPlayer');

                    async function fetchVideoStream() {
                        try {
                            const response = await fetch(videoUrl);
                            if (!response.ok) {
                                throw new Error('Error fetching video stream.');
                            }

                            const reader = response.body.getReader();
                            const contentLength = +response.headers.get('Content-Length');

                            let bytesRead = 0;
                            while (true) {
                                const { done, value } = await reader.read();
                                if (done) {
                                    break;
                                }

                                bytesRead += value.length;
                                const chunkProgress = (bytesRead / contentLength) * 100;
                                console.log('Download progress:', chunkProgress.toFixed(2) + '%');

                                // Update video player with the received chunk
                                videoPlayer.src = URL.createObjectURL(new Blob([value], { type: 'video/mp4' }));
                            }
                        } catch (error) {
                            console.error('Error fetching video stream:', error);
                        }
                    }

                    // Call the function to start fetching the video stream
                    fetchVideoStream();
                </script>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
