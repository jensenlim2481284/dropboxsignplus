@extends("pages.empty_layout")

@section('head')
<link href="/css/page/sign.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/web/pdf_viewer.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/webgazer@3.2.0/dist/webgazer.min.js"></script>
<script src="https://cdn.hellosign.com/public/js/embedded/v2.11.1/embedded.development.js"></script>

@endsection

@section('content')


    <!--Loader section -->
    <div class='page-loader'>
        <div class='loader'>
            <img src="/img/logo/logo.png"/>            
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

    <div id='signSection'>
        <button class='btn btn-primary' id='signBtn'> Agree and sign document </button>
    </div>

    <div class="modal fade" id="consentModal" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <img src='/img/eye.jpg'/>
                <h2> User Consent for Eye Tracking </h2>
                <p> We use advanced eye-tracking technology in Dropbox SignTrack to enhance your understanding of agreements. By using our service, you consent to the collection and analysis of your eye-tracking data, which helps improve comprehension and overall user experience. Your privacy is our priority, and your data will not be shared without your explicit consent. Please enable camera permission to allow us to utilize this technology. </p>

                <button class='btn btn-primary' data-dismiss="modal" >
                    I Consent to Eye Tracking
                </button>
            </div>
            <div class="modal-footer">
            </div>
            </div>
        </div>
    </div>



        
    <script>

        $(document).ready(function(){

    
            $("#consentModal").modal('show');


            // Hide loader 
            setTimeout(() => {
                $('.page-loader').fadeOut();
            }, 2000);

            

            // Eye tracking 
            let gazeArr = [];
            webgazer.setGazeListener((data, elapsedTime) => {
                if (data == null) {
                    return;
                }
                var xprediction = data.x; //these x coordinates are relative to the viewport
                var yprediction = data.y + window.scrollY - 200; //these y coordinates are relative to the viewport
                gazeArr.push({x: xprediction, y: yprediction});
                console.log(yprediction);
            }).begin();

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


            // Keep track of time spend on each page 
            const pageDurations = []; 
            let pageStartTime = Date.now();
            document.addEventListener('scroll', function () {
                const scrollPosition = $(window).scrollTop();
                let currentPageSection = 1;
                for (let i = 0; i < pageRanges.length; i++) {
                    if (scrollPosition >= pageRanges[i].start && scrollPosition <= pageRanges[i].end) {
                        currentPageSection = i + 1;
                        break;
                    }
                }

                // Update the current page section and calculate the duration
                if (currentPageSection !== currentPage) {
                    const pageEndTime = Date.now();
                    const timeSpentOnPage = pageEndTime - pageStartTime;
                    if(pageDurations[currentPage - 1]) 
                        pageDurations[currentPage - 1] += timeSpentOnPage
                    else 
                        pageDurations[currentPage - 1] = timeSpentOnPage
                    // console.log(`Time spent on page ${currentPage}: ${pageDurations[currentPage - 1] } milliseconds`);
                    currentPage = currentPageSection;
                    pageStartTime = Date.now();
                }
            });

            
            $(document).on('click','#signBtn', function(){

                // Log the duration for the last page when the user leaves the page
                const pageEndTime = Date.now();
                const timeSpentOnPage = pageEndTime - pageStartTime;
                if(pageDurations[currentPage - 1]) 
                    pageDurations[currentPage - 1] += timeSpentOnPage
                else 
                    pageDurations[currentPage - 1] = timeSpentOnPage

                // Send analysis tracking to backend
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/api/track',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, gaze:JSON.stringify(gazeArr), time:JSON.stringify(pageDurations)},
                    dataType: 'JSON',
                    success: function (data) { 
                    }
                }); 

                @if($url !== null)
                    // Open dropbox sign embed
                    const client = new window.HelloSign({
                        clientId: "{{env('CLIENT_ID')}}"
                    });
                    client.open("{!!$url!!}");

                    // On signed - return to homepage
                    client.on('sign', (data) => {
                        swal('Signed','You have successfully signed your document','success').then((value) => {
                            window.location.href ="/";
                        });
                    });
                @else 
                    swal('Signed','API have exceeded the 10 email limit, lets considering you have successfully signed your document','success').then((value) => {
                        window.location.href ="/";
                    });
                @endif

                

            })


        })


    </script>   
    
@stop
