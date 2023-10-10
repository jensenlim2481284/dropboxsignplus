@extends("pages.empty_layout")

@section('head')
<link href="/css/page/report.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/web/pdf_viewer.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/heatmap.js/2.0.0/heatmap.min.js"></script>
@endsection

@section('content')

    <!--Loader section -->
    <div class='page-loader'>
        <div class='loader'>
            <img src="/img/logo/logo.png"/>     
            <p>Loading </p>
        </div>
    </div>

    <div class="pdf-container">
        <div id="pdf-scroll-container">
            <!-- Container for each page -->
        </div>
        <div id="page-controls">
            <button id="prev-page">Previous Page</button>
            <button id="next-page">Next Page</button>
        </div>
    </div>
    <div id="heatmapContainer"></div>


    <div id='timeSection'>
        <h3> Total time spend </h3>
        <p>{{$totalTime /1000}}s</p>
        
        <h3> Total time spend on first page </h3>
        <p>{{$time[0] /1000}}s</p>
        <h3> Total time spend on second page </h3>
        <p>{{$time[1] /1000}}s</p>

    </div>

    <div id='backSection'>
        <a href='/'><button class='btn btn-secondary'> Back </button></a>
    </div>

    <script>

        $(document).ready(function(){


            // Hide loader 
            setTimeout(() => {
                $('.page-loader').fadeOut();
            }, 2000);



            // Load PDF 
            const pdfViewer = document.getElementById('pdf-scroll-container');
            const prevPageButton = document.getElementById('prev-page');
            const nextPageButton = document.getElementById('next-page');
            let currentPage = 1;
            let pageRanges = [];

            // Render all PDF pages 
            function renderAllPages() {
                pdfjsLib.getDocument('mutual-NDA-example.pdf').promise.then(function (pdfDoc) {
                    const totalPageCount = pdfDoc.numPages;
                    for (let i = 1; i <= totalPageCount; i++) {
                        pdfDoc.getPage(i).then(function (page) {
                            const canvas = document.createElement('canvas');
                            const context = canvas.getContext('2d');
                            const viewport = page.getViewport({ scale: 1.5 });
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;
                            page.render({ canvasContext: context, viewport: viewport });
                            pdfViewer.appendChild(canvas);
                        });
                    }
                   
                    setTimeout(() => {
                        let startIndex = 0 ;
                        let endIndex = 0;
                        $('canvas').each(function(){
                            let h = $(this).height()
                            endIndex += h;
                            pageRanges.push({start: startIndex, end: endIndex})
                            startIndex += h + 1;
                        });
                    }, 1000);

                });
            }

            prevPageButton.style.display = 'none';
            nextPageButton.style.display = 'none';

            renderAllPages(); // Render all pages when the page loads


            // Set up a heatmap
            setTimeout(() => {

                let totalHeight = 0;
                $('canvas').each(function(){
                    totalHeight += $(this).height()
                });
                $("#heatmapContainer").height(totalHeight);

                const heatmapContainer = document.getElementById('heatmapContainer');
                const heatmapInstance = h337.create({
                    container: heatmapContainer,
                    radius: 50
                });

                // Sample heatmap data (replace with your real data)
                const heatmapData = {
                    max: 10,
                    data: [
                        @foreach($gaze as $v)
                            { x: {{$v->x}}, y: {{$v->y}}, value: {{rand(1,10)}} },
                        @endforeach
                    ]
                };

                heatmapInstance.setData(heatmapData);
            }, 2000);

        })


    </script>   
    
@stop
